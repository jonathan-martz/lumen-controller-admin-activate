<?php

use Illuminate\Support\Facades\Route;

Route::post('/admin/user/activate', [
    'middleware' => ['auth', 'xss', 'https'],
    'uses' => 'App\Http\Controllers\AdminActivateController@activate'
]);

Route::post('/admin/user/select', [
    'middleware' => ['auth', 'xss', 'https'],
    'uses' => 'App\Http\Controllers\AdminActivateController@select'
]);
