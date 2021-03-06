<div class="card card-custom gutter-b">
    <!--begin::Body-->
    <div class="card-body">
        <!--begin::Wrapper-->
        <div class="d-flex justify-content-between flex-column h-100">
            <!--begin::Container-->
            <div class="h-100" id="navbar">
                <!--begin::Header-->
                @include('pages.company.navbar.my-company-preview',[
                        'company' => \Illuminate\Support\Facades\Auth::user()->company ?? null
                    ])
                <!--end::Header-->
                <!--begin::Body-->
                <div class="pt-1">
                <!--begin::Item-->
{{--                @include('pages.company.navbar.list')--}}
                @include('pages.company.navbar.item', [
                    'svg' => 'Text/Bullet-list.svg',
                    'route' => route('company.list'),
                    'title' => 'Компании',
                    'description' => 'Просмотр и Управление всех компаний',
                    'count' => \App\Models\Company::count(),
                    'permission' => \App\Interfaces\OptionsPermissions::ACCESS_TO_ALL_COMPANY,
                    'scripts' => asset('js/pages/custom/profile/profile.js'),
                    ])
                @include('pages.company.navbar.item', [
                    'svg' => 'Navigation/Plus.svg',
                    'route' => route('company.create.show'),
                    'title' => 'Открыть',
                    'description' => 'Открыть новую Компанию',
                    'permission' => \App\Interfaces\OptionsPermissions::ACCESS_TO_CREATE_COMPANY,
                    'scripts' => asset('js/pages/custom/profile/profile.js'),
                    ])
                @include('pages.company.navbar.item', [
                    'svg' => 'General/Settings-2.svg',
                    'route' => route('company.edit'),
                    'title' => 'Моя компания',
                    'description' => 'Изменить данные Компании',
                    'permission' => \App\Interfaces\OptionsPermissions::ADMIN_ROLE_SET,
                    'scripts' => asset('js/pages/custom/profile/profile.js'),
                    ])
                @include('pages.company.navbar.item', [
                    'svg' => 'Files/DownloadedFile.svg',
                    'route' => route('company.download.report.users.xls'),
                    'title' => 'Отчет',
                    'description' => 'Получить отчет компании в XLS',
                    'permission' => \App\Interfaces\OptionsPermissions::ADMIN_ROLE_SET,
                    'scripts' => asset('js/pages/custom/profile/profile.js'),
                    ])
                <!--end::Item-->
                <!--begin::Item-->
{{--                @include('pages.company.navbar.create')--}}
                <!--end::Item-->
                <!--begin::Item-->
{{--                @include('pages.company.navbar.edit')--}}
                <!--end::Item-->
                    <!--begin::Item-->

                    <!--end::Item-->
                    <!--begin::Item-->
                {{--                                    <div class="d-flex align-items-center pb-9">--}}
                {{--                                        <!--begin::Symbol-->--}}
                {{--                                        <div class="symbol symbol-45 symbol-light mr-4">--}}
                {{--                                            <span class="symbol-label">--}}
                {{--                                                <span class="svg-icon svg-icon-2x svg-icon-dark-50">--}}
                {{--                                                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Home/Globe.svg-->--}}
                {{--                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">--}}
                {{--                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
                {{--                                                            <rect x="0" y="0" width="24" height="24"></rect>--}}
                {{--                                                            <path d="M13,18.9450712 L13,20 L14,20 C15.1045695,20 16,20.8954305 16,22 L8,22 C8,20.8954305 8.8954305,20 10,20 L11,20 L11,18.9448245 C9.02872877,18.7261967 7.20827378,17.866394 5.79372555,16.5182701 L4.73856106,17.6741866 C4.36621808,18.0820826 3.73370941,18.110904 3.32581341,17.7385611 C2.9179174,17.3662181 2.88909597,16.7337094 3.26143894,16.3258134 L5.04940685,14.367122 C5.46150313,13.9156769 6.17860937,13.9363085 6.56406875,14.4106998 C7.88623094,16.037907 9.86320756,17 12,17 C15.8659932,17 19,13.8659932 19,10 C19,7.73468744 17.9175842,5.65198725 16.1214335,4.34123851 C15.6753081,4.01567657 15.5775721,3.39010038 15.903134,2.94397499 C16.228696,2.49784959 16.8542722,2.4001136 17.3003976,2.72567554 C19.6071362,4.40902808 21,7.08906798 21,10 C21,14.6325537 17.4999505,18.4476269 13,18.9450712 Z" fill="#000000" fill-rule="nonzero"></path>--}}
                {{--                                                            <circle fill="#000000" opacity="0.3" cx="12" cy="10" r="6"></circle>--}}
                {{--                                                        </g>--}}
                {{--                                                    </svg>--}}
                {{--                                                    <!--end::Svg Icon-->--}}
                {{--                                                </span>--}}
                {{--                                            </span>--}}
                {{--                                        </div>--}}
                {{--                                        <!--end::Symbol-->--}}
                {{--                                        <!--begin::Text-->--}}
                {{--                                        <div class="d-flex flex-column flex-grow-1">--}}
                {{--                                            <a href="#" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">Subjects</a>--}}
                {{--                                            <span class="text-muted font-weight-bold">Successful Fellas</span>--}}
                {{--                                        </div>--}}
                {{--                                        <!--end::Text-->--}}
                {{--                                        <!--begin::label-->--}}
                {{--                                        <span class="font-weight-bolder label label-xl label-light-primary label-inline py-5 min-w-45px">74</span>--}}
                {{--                                        <!--end::label-->--}}
                {{--                                    </div>--}}
                {{--                                    <!--end::Item-->--}}
                {{--                                    <!--begin::Item-->--}}
                {{--                                    <div class="d-flex align-items-center pb-9">--}}
                {{--                                        <!--begin::Symbol-->--}}
                {{--                                        <div class="symbol symbol-45 symbol-light mr-4">--}}
                {{--                                        <span class="symbol-label">--}}
                {{--                                            <span class="svg-icon svg-icon-2x svg-icon-dark-50">--}}
                {{--                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">--}}
                {{--                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
                {{--                                                        <rect x="0" y="0" width="24" height="24"></rect>--}}
                {{--                                                        <rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>--}}
                {{--                                                        <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3"></path>--}}
                {{--                                                    </g>--}}
                {{--                                                </svg>--}}
                {{--                                                <!--end::Svg Icon-->--}}
                {{--                                            </span>--}}
                {{--                                        </span>--}}
                {{--                                        </div>--}}
                {{--                                        <!--end::Symbol-->--}}
                {{--                                        <!--begin::Text-->--}}
                {{--                                        <div class="d-flex flex-column flex-grow-1">--}}
                {{--                                            <a href="#" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">Winners</a>--}}
                {{--                                            <span class="text-muted font-weight-bold">Achievements</span>--}}
                {{--                                        </div>--}}
                {{--                                        <!--end::Text-->--}}
                {{--                                        <!--begin::label-->--}}
                {{--                                        <span class="font-weight-bolder label label-xl label-light-info label-inline px-3 py-5 min-w-45px">209</span>--}}
                {{--                                        <!--end::label-->--}}
                {{--                                    </div>--}}
                <!--end::Item-->
                </div>
                <!--end::Body-->
            </div>
            <!--eng::Container-->
            <!--begin::Footer-->
        {{--                            <div class="d-flex flex-center" id="kt_sticky_toolbar_chat_toggler_2" data-toggle="tooltip" title="" data-placement="right" data-original-title="Chat Example">--}}
        {{--                                <button class="btn btn-primary font-weight-bolder font-size-sm py-3 px-14" data-toggle="modal" data-target="#kt_chat_modal">Contact School</button>--}}
        {{--                            </div>--}}
        <!--end::Footer-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Body-->
</div>
