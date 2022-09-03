<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',['App\Http\Controllers\Auth\HomeController','redirectAfterLogin'] )->name('home');



route::view('testSocket','testSocket');
route::get('testSocketFire',function(){
    event(new App\Events\ordersEvent());
});


route::get('test/{id}',function($id){
    return $id;
})->where('id','/1/g');

use App\Models\admins;
use Illuminate\Support\Str;

route::get('/optimize',function(){
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');
    Artisan::call('php artisan optimize');
    
});

require('backupdb.php');
route::get('/insertSubject',function(){
    $arr=[];
    foreach(\App\Models\grades::all() as $grade){
        $grade_subject  = \App\Models\grade_subject::where('grades_id',18)->get(['grades_id','subjects_id','matrimonial_portions','individual_portions']);
        foreach($grade_subject as $grade_s){
            $grade_s->grades_id= $grade->id;
            $grade_s=$grade_s->toArray();
            unset($grade_s['totalClassRooms']);
            unset($grade_s['id']);
                \App\Models\grade_subject::create([...$grade_s]);
        }
    }
});
