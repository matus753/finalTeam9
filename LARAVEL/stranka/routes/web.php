<?php

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

/*
|---------------------------------------------------------------------------
| Examples (' Martin Trocha ')
|---------------------------------------------------------------------------
| Just simple view return:
| 	Route:get('/URI'), function() { return view('PATH_TO_VIEW') });	
|	
| Route to controller and his method:
|	Route::get('/URI', '\Modules\MODULENAME\Http\Controllers\CONTROLLERNAME@METHODNAME');
|
*/

/* Homapage */
Route::get('/', '\Modules\Home\Http\Controllers\Home@index');

/* About us */
Route::get('/history', '\Modules\About\Http\Controllers\About@history');
Route::get('/management', '\Modules\About\Http\Controllers\About@management');
Route::get('/institutes', '\Modules\About\Http\Controllers\About@institutes');

/* Staff */
Route::get('/staff', '\Modules\Staff\Http\Controllers\Staff@index');
Route::get('/staff/{id}',['uses' => '\Modules\Staff\Http\Controllers\Staff@getStaffById'] );
Route::post('/staff/ajax_publications', '\Modules\Staff\Http\Controllers\Staff@ajax_get_pubs');

/* News */
Route::get('/news', '\Modules\News\Http\Controllers\News@index');
Route::get('/news/{id}', '\Modules\News\Http\Controllers\News@concrete_new');
Route::post('/news/filter', '\Modules\News\Http\Controllers\News@ajax_news_filter');
Route::post('/news/optin', '\Modules\News\Http\Controllers\News@optin');

/* Study */
Route::get('/admission', '\Modules\Study\Http\Controllers\Study@admission');
Route::get('/bachelor', '\Modules\Study\Http\Controllers\Study@bachelor');
Route::get('/master', '\Modules\Study\Http\Controllers\Study@master');
Route::get('/doctoral', '\Modules\Study\Http\Controllers\Study@doctoral');

/* Research */
Route::get('/projects', '\Modules\Research\Http\Controllers\Research@projects');
Route::get('/ekart', '\Modules\Research\Http\Controllers\Research@ekart');
Route::get('/autonom-vehicle', '\Modules\Research\Http\Controllers\Research@autonom_vehicle');
Route::get('/led-cube', '\Modules\Research\Http\Controllers\Research@led_cube');
Route::get('/biomechatronic', '\Modules\Research\Http\Controllers\Research@biomechatronic');

/* Activity */
Route::get('/videos', '\Modules\Activity\Http\Controllers\Activity@videos');
Route::post('/videos/filter', '\Modules\Activity\Http\Controllers\Activity@ajax_get_videos_by_type');
Route::get('/media', '\Modules\Activity\Http\Controllers\Activity@media');
Route::get('/photo-gallery', '\Modules\Activity\Http\Controllers\Activity@photos_previews');

/* Contact */
Route::get('/contact', '\Modules\Contact\Http\Controllers\Contact@index');

/* Languages */
Route::get('/ml/{lang}', [ 'uses' => 'Languages@switchLanguage']);

/* Login */
Route::get('/login', '\Modules\Login\Http\Controllers\Login@index');
Route::post('/login-action', '\Modules\Login\Http\Controllers\Login@login_action');

/* Intranet */
Route::get('/intranet', '\Modules\Intranet\Http\Controllers\Intranet@index');