<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Middleware\dashboardAuth;

Route::group(['middleware' => dashboardAuth::class], function () {

    Route::get('changeStatus/{model}/{col_name}/{id}','GeneralSettingController@changeStatus')->name('dashboard.changeStatus');
    Route::get('deleteRecord/','GeneralSettingController@deleteRecord')->name('dashboard.deleteRecord');
    Route::resources([
        'notifications'=>'NotificationController',
        "ResetPassword"=>"ResetPasswordController",
        "school_calendar"=>"SchoolCalendarController"

    ]);
    Route::get('ResetPassword',["App\Http\Controllers\Auth\ResetPasswordController","index"])->name('resetPassword.index');
    Route::put('ResetPassword',["App\Http\Controllers\Auth\ResetPasswordController","updatePassword"])->name('resetPassword');
    
});
Route::post('/logout', ['App\Http\Controllers\Auth\LoginController','logout'])->name('dashboard.logout');

Route::get('/login',["App\Http\Controllers\Auth\LoginController","index"])->name('dashboard.login.index');
Route::post('/login', ['App\Http\Controllers\Auth\LoginController','authenticate'])->name('dashboard.login');

Route::view('/register','auth.register')->name('dashboard.register.index');
Route::post('/register', ['App\Http\Controllers\Auth\RegisterController','register'])->name('dashboard.register');

Route::post('/logout', ['App\Http\Controllers\Auth\LoginController','logout'])->name('dashboard.logout');
Route::get('changeLnag/{lang}','GeneralSettingController@changeLang')->name('dashboard.changeLnag');

include('admin.php');
include('school.php');