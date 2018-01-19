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
Route::post('/news/optin', '\Modules\News\Http\Controllers\News@optin');
Route::get('/news/content/{id}', '\Modules\News\Http\Controllers\News@show_content_news');

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
Route::get('/intranet', '\Modules\Intranet\Http\Controllers\Intranet@intranet');
/* Intranet news */
Route::get('/news-admin', '\Modules\Intranet\Http\Controllers\Intranet@news_all');
Route::get('/news-admin-delete/{id}', '\Modules\Intranet\Http\Controllers\Intranet@news_delete_action');
Route::get('/news-admin-add', '\Modules\Intranet\Http\Controllers\Intranet@news_add');
Route::post('/news-admin-add-action', '\Modules\Intranet\Http\Controllers\Intranet@news_add_action');
Route::get('/news-admin-edit/{id}', '\Modules\Intranet\Http\Controllers\Intranet@news_edit');
Route::post('/news-admin-edit-action/{id}', '\Modules\Intranet\Http\Controllers\Intranet@news_edit_action');
Route::post('/news-admin/news_image_upload', '\Modules\Intranet\Http\Controllers\Intranet@news_images_upload');
Route::post('/news-admin/news_file_upload', '\Modules\Intranet\Http\Controllers\Intranet@news_file_upload');
Route::post('/news-admin/news-set-pagination', '\Modules\Intranet\Http\Controllers\Intranet@news_set_pagination_action');

/* Intranet projects */
Route::get('/projects-admin', '\Modules\Intranet\Http\Controllers\Intranet@projects_all');
Route::get('/projects-admin-delete/{id}', '\Modules\Intranet\Http\Controllers\Intranet@projects_delete_action');
Route::get('/projects-admin-add', '\Modules\Intranet\Http\Controllers\Intranet@projects_add');
Route::post('/projects-admin-add-action', '\Modules\Intranet\Http\Controllers\Intranet@projects_add_action');
Route::get('/projects-admin-edit/{id}', '\Modules\Intranet\Http\Controllers\Intranet@projects_edit');
Route::post('/projects-admin-edit-action/{id}', '\Modules\Intranet\Http\Controllers\Intranet@projects_edit_action');

/* Intranet media */
Route::get('/media-admin', '\Modules\Intranet\Http\Controllers\Intranet@media_all');
Route::get('/media-admin-delete/{id}', '\Modules\Intranet\Http\Controllers\Intranet@media_delete_action');
Route::get('/media-admin-add', '\Modules\Intranet\Http\Controllers\Intranet@media_add');
Route::post('/media-admin-add-action', '\Modules\Intranet\Http\Controllers\Intranet@media_add_action');
Route::get('/media-admin-edit/{id}', '\Modules\Intranet\Http\Controllers\Intranet@media_edit');
Route::post('/media-admin-edit-action/{id}', '\Modules\Intranet\Http\Controllers\Intranet@media_edit_action');

/* Intranet videos */
Route::get('/videos-admin', '\Modules\Intranet\Http\Controllers\Intranet@videos_all');
Route::get('/videos-admin-delete/{id}', '\Modules\Intranet\Http\Controllers\Intranet@videos_delete_action');
Route::get('/videos-admin-add', '\Modules\Intranet\Http\Controllers\Intranet@videos_add');
Route::post('/videos-admin-add-action', '\Modules\Intranet\Http\Controllers\Intranet@videos_add_action');
Route::get('/videos-admin-edit/{id}', '\Modules\Intranet\Http\Controllers\Intranet@videos_edit');
Route::post('/videos-admin-edit-action/{id}', '\Modules\Intranet\Http\Controllers\Intranet@videos_edit_action');