<?php

namespace App\Models\Bank;

use App\Classes\TochkaBank\BankAPI;
use App\Interfaces\ListBank;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Account
 * @package App\Models\Bank
 *
 * @property $account_id
 * @property $company_id
 * @property $avail
 * @property $current
 * @property $currency
 */
class Account extends Model
{
    use HasFactory;

    const AVAIL = 'avail';
    const CURRENT = 'current';

    protected $fillable = ['account_id', 'avail', 'current'];

    protected $table = 'bank_account';

    public function payment()
    {
        return Payment::where('account_id', $this->account_id);
    }

    public function scopePayments($query)
    {
        $accounts = $query->select('account_id')->get()->pluck('account_id');
        $whereInLike = function ($query) use($accounts) {
            foreach ($accounts as $account){
                $query->orwhere('account_id', 'like', $account .'%');
            }
        };

        return Payment::where($whereInLike);
    }

    public function cards()
    {
        $cards = Card::where('account_code', 'like', $this->account_id .'%');

        return $cards;
    }

    public function scopeCards($query)
    {
        $accounts = $query->select('account_id')->get()->pluck('account_id');

        $whereInLike = function ($query) use($accounts) {
            foreach ($accounts as $account) {
                $query->orWhere('account_code', 'like', $account .'%');
            }
        };

        return Card::where($whereInLike);
    }

    public function getCompanyAttribute()
    {
        return Company::find($this->company_id);
    }

    public function getBankAttribute()
    {
        $bankAr = collect(config('bank_list.info'))->where('bin', $this->bin)->first();
        if(is_null($bankAr)) {
            $bankAr = [
                'title' => '',
                'icon' => '',
                'bin' => ''
            ];
        }

        return (object) $bankAr;
    }

    public function getBinAttribute()
    {
        $number = $this->cards()->select('number')->first()->numberFull ?? null;

        return substr($number, 0, 6);
    }

    public function getCurrencySignAttribute()
    {
        switch ($this->currency) {
            case 'RUB' : $sign = '₽';
                break;
            case 'USD' : $sign = '$';
                break;
        }

        return $sign;
    }

    public static function getCollectApi(BankAPI $api): \Illuminate\Support\Collection
    {
        $data = array();
        $i = 0;
        foreach (Account::get() as $account) {
            $data[$i]['id'] = $account->id;
            $data[$i]['account_id'] = $account->account_id;
            $data[$i]['company_id'] = $account->company_id;

            $accountId = "$account->account_id/044525999";
            try {
                $balanceTypeList = $api->getBalanceInfo($accountId)->Data->Balance;
            }
            catch (\Exception $e) {
                continue;
            }

            foreach ($balanceTypeList as $balance) {
                $data[$i]['currency'] = $balance->Amount->currency;

                if($balance->type == 'OpeningAvailable') {
                    $data[$i]['avail'] = $balance->Amount->amount;
                }
                else if ($balance->type == 'ClosingAvailable') {
                    $data[$i]['current'] = $balance->Amount->amount;
                }
            }

            $i++;
        }

        return collect($data);
    }

    public static function refreshApi()
    {
        foreach (BankToken::all() as $bank)
        {
            $collect = self::getCollectApi(new BankAPI($bank));
            self::upsert(
                $collect->toArray(),
                [
                    'id',
                    'account_id',
                ],
                [
                    'currency', 'avail', 'current'
                ]
            );
        }

        return true;
    }
}
