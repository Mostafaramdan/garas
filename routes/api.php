<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

route::post('login', 'login\loginController@api');

route::post('getClasses', 'index@index');
route::post('getSubjects ', 'index@index');
route::post('getStages ', 'index@index');
route::post('getTeachers', 'index@index');
route::post('contact', 'index@index');
route::post('addNoteToClass', 'index@index');


route::post('getGrades', 'getGrades\getGradesController@api');
route::post('notifications', 'notifications\notificationsController@api');
route::post('getClassTable', 'getClassTable\getClassTableController@api');
route::post('getTeacherTable', 'getTeacherTable\getTeacherTableController@api');
route::post('unseenNotifications', 'unseenNotifications\unseenNotificationsController@api');
route::post('switchNotification', 'switchNotification\switchNotificationController@api');
route::post('logOut', 'logOut\logOutController@api');
route::post('setFireBaseToken', 'setFireBaseToken\setFireBaseTokenController@api');
route::post('getExamTable', 'getExamTable\getExamTableController@api');
route::post('getSupervisions', 'getSupervisions\getSupervisionsController@api');
route::post('getCommingSoon', 'getCommingSoon\getCommingSoonController@api');
route::post('sendNotification', 'sendNotification\sendNotificationController@api');
route::post('getCalender', 'getCalender\getCalenderController@api');
route::post('appSettings', 'appSettings\appSettingsController@api');
route::post('alert', 'alert\alertController@api');
