<?php

use App\Http\Controllers\ManagerController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ManagerController::class, 'dashboard'])->name('dashboard');

Route::get('/user/{id}/cards', [ManagerController::class, 'user'])->name('user_cards');

Route::get('/user/add', [ManagerController::class, 'addUser'])->name('add_user');

Route::get('/cards/closing_list', [ManagerController::class, 'closingList'])
    ->name('cards_closing_list');

Route::post('/permission_edit', [ManagerController::class, 'updatePermission'])
    ->name('permission_update')
    ->middleware('auth.demo');

Route::post('/permission_edit', [ManagerController::class, 'updateRole'])
    ->name('role_update')
    ->middleware('auth.demo');

Route::post('/user_delete', [ManagerController::class, 'deleteUser'])
    ->name('user_delete')
    ->middleware('auth.demo');

Route::post('/cards/closing', [ManagerController::class, 'closingCard'])
    ->name('cards_closing')
    ->middleware('auth.demo');

Route::post('/cards/closing-all', [ManagerController::class, 'closingCardAll'])
    ->name('cards_closing_all')
    ->middleware('auth.demo');
