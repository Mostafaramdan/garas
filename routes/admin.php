<?php

use  App\Http\Middleware\adminAuth;

Route::group(['middleware' => adminAuth::class], function () {

    Route::resources([
        'roles'=>'RoleController',
        'admins'=>'AdminController',
        'schools'=>'SchoolController',
        'app_settings'=>'AppSettingController',
        'updates_dashboard'=>'UpdatesDashboardController',
        'packages'=>'PackagesController',
        'subscriptions'=>'SubscriptionsController',
    ]);
    
    Route::get('loginToSchool/{school}','GeneralSettingController@loginToSchool')->name('dashboard.loginToSchool');
    Route::get('/statistics',"StatisticsController@index")->name('dashboard.statistics');
});
