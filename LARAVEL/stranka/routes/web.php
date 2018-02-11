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
Route::get('/thesis/anotation', '\Modules\Study\Http\Controllers\Study@getThesisAnot');
Route::get('/thesis/filter', '\Modules\Study\Http\Controllers\Study@getFilterThesis');
Route::get('/thesis/{id}', '\Modules\Study\Http\Controllers\Study@getAvailableThesis');
Route::get('/admission', '\Modules\Study\Http\Controllers\Study@admission');
Route::get('/bachelor', '\Modules\Study\Http\Controllers\Study@bachelor');
Route::get('/master', '\Modules\Study\Http\Controllers\Study@master');
Route::get('/doctoral', '\Modules\Study\Http\Controllers\Study@doctoral');

/* Research */
Route::post('/projects/{id}', '\Modules\Research\Http\Controllers\Research@show');
Route::get('/projects', '\Modules\Research\Http\Controllers\Research@projects');
Route::get('/ekart', '\Modules\Research\Http\Controllers\Research@ekart');
Route::get('/autonom-vehicle', '\Modules\Research\Http\Controllers\Research@autonom_vehicle');
Route::get('/led-cube', '\Modules\Research\Http\Controllers\Research@led_cube');
Route::get('/biomechatronic', '\Modules\Research\Http\Controllers\Research@biomechatronic');

/* Activity */
Route::get('/videos', '\Modules\Activity\Http\Controllers\Activity@videos');
Route::post('/videos/filter', '\Modules\Activity\Http\Controllers\Activity@ajax_get_videos_by_type');
Route::get('/media', '\Modules\Activity\Http\Controllers\Activity@media');
Route::get('/photo-gallery', '\Modules\Activity\Http\Controllers\Activity@photos');

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
Route::get('/news-admin', '\Modules\Intranet\Http\Controllers\Intranet_news@news_all');
Route::get('/news-admin-delete/{id}', '\Modules\Intranet\Http\Controllers\Intranet_news@news_delete_action');
Route::get('/news-admin-add', '\Modules\Intranet\Http\Controllers\Intranet_news@news_add');
Route::post('/news-admin-add-action', '\Modules\Intranet\Http\Controllers\Intranet_news@news_add_action');
Route::get('/news-admin-edit/{id}', '\Modules\Intranet\Http\Controllers\Intranet_news@news_edit');
Route::post('/news-admin-edit-action/{id}', '\Modules\Intranet\Http\Controllers\Intranet_news@news_edit_action');
Route::post('/news-admin/news_image_upload', '\Modules\Intranet\Http\Controllers\Intranet_news@news_images_upload');
Route::post('/news-admin/news_file_upload', '\Modules\Intranet\Http\Controllers\Intranet_news@news_file_upload');
Route::post('/news-admin/news-set-pagination', '\Modules\Intranet\Http\Controllers\Intranet_news@news_set_pagination_action');

/* Intranet projects */
Route::get('/projects-admin', '\Modules\Intranet\Http\Controllers\Intranet_projects@projects_all');
Route::get('/projects-admin-delete/{id}', '\Modules\Intranet\Http\Controllers\Intranet_projects@projects_delete_action');
Route::get('/projects-admin-add', '\Modules\Intranet\Http\Controllers\Intranet_projects@projects_add');
Route::post('/projects-admin-add-action', '\Modules\Intranet\Http\Controllers\Intranet_projects@projects_add_action');
Route::get('/projects-admin-edit/{id}', '\Modules\Intranet\Http\Controllers\Intranet_projects@projects_edit');
Route::post('/projects-admin-edit-action/{id}', '\Modules\Intranet\Http\Controllers\Intranet_projects@projects_edit_action');
Route::get('/photos-admin-activate-project/{id}', '\Modules\Intranet\Http\Controllers\Intranet_projects@project_activate_action');

/* Intranet media */
Route::get('/media-admin', '\Modules\Intranet\Http\Controllers\Intranet_media@media_all');
Route::get('/media-admin-delete/{id}', '\Modules\Intranet\Http\Controllers\Intranet_media@media_delete_action');
Route::get('/media-admin-add', '\Modules\Intranet\Http\Controllers\Intranet_media@media_add');
Route::post('/media-admin-add-action', '\Modules\Intranet\Http\Controllers\Intranet_media@media_add_action');
Route::get('/media-admin-edit/{id}', '\Modules\Intranet\Http\Controllers\Intranet_media@media_edit');
Route::post('/media-admin-edit-action/{id}', '\Modules\Intranet\Http\Controllers\Intranet_media@media_edit_action');

/* Intranet videos */
Route::get('/videos-admin', '\Modules\Intranet\Http\Controllers\Intranet_videos@videos_all');
Route::get('/videos-admin-delete/{id}', '\Modules\Intranet\Http\Controllers\Intranet_videos@videos_delete_action');
Route::get('/videos-admin-add', '\Modules\Intranet\Http\Controllers\Intranet_videos@videos_add');
Route::post('/videos-admin-add-action', '\Modules\Intranet\Http\Controllers\Intranet_videos@videos_add_action');
Route::get('/videos-admin-edit/{id}', '\Modules\Intranet\Http\Controllers\Intranet_videos@videos_edit');
Route::post('/videos-admin-edit-action/{id}', '\Modules\Intranet\Http\Controllers\Intranet_videos@videos_edit_action');

/* Intranet photos */
Route::get('/photos-admin', '\Modules\Intranet\Http\Controllers\Intranet_photos@photos_all');
Route::get('/photos-admin-delete/{id}', '\Modules\Intranet\Http\Controllers\Intranet_photos@photos_delete_action');
Route::get('/photos-admin-delete-item-action/{id}', '\Modules\Intranet\Http\Controllers\Intranet_photos@photos_single_delete_action');
Route::get('/photos-admin-add', '\Modules\Intranet\Http\Controllers\Intranet_photos@photos_add');
Route::post('/photos-admin-add-action', '\Modules\Intranet\Http\Controllers\Intranet_photos@photos_add_action');
Route::get('/photos-admin-edit/{id}', '\Modules\Intranet\Http\Controllers\Intranet_photos@photos_edit');
Route::post('/photos-admin-edit-action/{id}', '\Modules\Intranet\Http\Controllers\Intranet_photos@photos_edit_action');
Route::get('/photos-admin-upload/{id}', '\Modules\Intranet\Http\Controllers\Intranet_photos@photos_upload');
Route::post('/photos-admin-upload-action', '\Modules\Intranet\Http\Controllers\Intranet_photos@photos_upload_action');
Route::get('/photos-admin-activate-gallery/{id}', '\Modules\Intranet\Http\Controllers\Intranet_photos@photos_activate_action');

/* Intranet staff */
Route::get('/staff-admin', '\Modules\Intranet\Http\Controllers\Intranet_staff@staff_all');
Route::get('/staff-admin-delete/{id}', '\Modules\Intranet\Http\Controllers\Intranet_staff@staff_delete_action');
Route::get('/staff-admin-add', '\Modules\Intranet\Http\Controllers\Intranet_staff@staff_add');
Route::post('/staff-admin-add-action', '\Modules\Intranet\Http\Controllers\Intranet_staff@staff_add_action');
Route::get('/staff-admin-edit/{id}', '\Modules\Intranet\Http\Controllers\Intranet_staff@staff_edit');
Route::post('/staff-admin-edit-action/{id}', '\Modules\Intranet\Http\Controllers\Intranet_staff@staff_edit_action');
Route::get('/staff-admin-show-profile/{id}', '\Modules\Intranet\Http\Controllers\Intranet_staff@staff_show_profile');