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

/* Homapage OK*/
Route::get('/', '\Modules\Home\Http\Controllers\Home@index');

/* About us OK*/
Route::get('/history', '\Modules\About\Http\Controllers\About@history');
Route::get('/management', '\Modules\About\Http\Controllers\About@management');
Route::get('/institutes', '\Modules\About\Http\Controllers\About@institutes');

/* Staff OK*/
Route::get('/staff', '\Modules\Staff\Http\Controllers\Staff@index');
Route::get('/staff/{id}',['uses' => '\Modules\Staff\Http\Controllers\Staff@getStaffById'] );
Route::post('/staff/ajax_publications', '\Modules\Staff\Http\Controllers\Staff@ajax_get_pubs');

/* News OK */
Route::get('/news', '\Modules\News\Http\Controllers\News@index');
Route::post('/news/optin', '\Modules\News\Http\Controllers\News@optin');
Route::get('/news/content/{id}', '\Modules\News\Http\Controllers\News@show_content_news');

/* Study OK */
Route::get('/thesis/anotation', '\Modules\Study\Http\Controllers\Study@getThesisAnot');
Route::get('/thesis/filter', '\Modules\Study\Http\Controllers\Study@getFilterThesis');
Route::get('/thesis/{id}', '\Modules\Study\Http\Controllers\Study@getAvailableThesis');
Route::get('/admission', '\Modules\Study\Http\Controllers\Study@admission');
Route::get('/bachelor', '\Modules\Study\Http\Controllers\Study@bachelor');
Route::get('/master', '\Modules\Study\Http\Controllers\Study@master');
Route::get('/doctoral', '\Modules\Study\Http\Controllers\Study@doctoral');
Route::get('/subjects/{id}', '\Modules\Study\Http\Controllers\Study@subjects');
Route::get('/subject/{id}', '\Modules\Study\Http\Controllers\Study@subject');

/* Research OK */
Route::get('/projects', '\Modules\Research\Http\Controllers\Research@projects');
Route::get('/ekart', '\Modules\Research\Http\Controllers\Research@ekart');
Route::get('/autonom-vehicle', '\Modules\Research\Http\Controllers\Research@autonom_vehicle');
Route::get('/led-cube', '\Modules\Research\Http\Controllers\Research@led_cube');
Route::get('/biomechatronic', '\Modules\Research\Http\Controllers\Research@biomechatronic');

/* Activity OK */
Route::get('/videos', '\Modules\Activity\Http\Controllers\Activity@videos');
Route::post('/videos/filter', '\Modules\Activity\Http\Controllers\Activity@ajax_get_videos_by_type');
Route::get('/media', '\Modules\Activity\Http\Controllers\Activity@media');
Route::get('/photo-gallery', '\Modules\Activity\Http\Controllers\Activity@photos');

/* Contact OK */
Route::get('/contact', '\Modules\Contact\Http\Controllers\Contact@index');

/* Languages OK */
Route::get('/ml/{lang}', [ 'uses' => 'Languages@switchLanguage']);

/* Login OK TEST treba TODO Logout + profile*/
Route::get('/login', '\Modules\Login\Http\Controllers\Login@index');
Route::post('/login-action', '\Modules\Login\Http\Controllers\Login@login_action');
Route::post('/logout-action', '\Modules\Login\Http\Controllers\Login@logout_action');

Route::get('/developer', '\Modules\Login\Http\Controllers\Login@developer');


/* Intranet ZMENA viewu */
Route::get('/intranet', '\Modules\Intranet\Http\Controllers\Intranet@intranet');

//Reporter
/* Intranet news OK ?? */
Route::get('/news-admin', '\Modules\Intranet\Http\Controllers\Intranet_news@news_all');
Route::get('/news-admin-delete/{id}', '\Modules\Intranet\Http\Controllers\Intranet_news@news_delete_action');
Route::get('/news-admin-add', '\Modules\Intranet\Http\Controllers\Intranet_news@news_add');
Route::post('/news-admin-add-action', '\Modules\Intranet\Http\Controllers\Intranet_news@news_add_action');
Route::get('/news-admin-edit/{id}', '\Modules\Intranet\Http\Controllers\Intranet_news@news_edit');
Route::post('/news-admin-edit-action/{id}', '\Modules\Intranet\Http\Controllers\Intranet_news@news_edit_action');
Route::post('/news-admin/news_image_upload', '\Modules\Intranet\Http\Controllers\Intranet_news@news_images_upload');
Route::post('/news-admin/news_file_upload', '\Modules\Intranet\Http\Controllers\Intranet_news@news_file_upload');
Route::get('/news-admin-delete-added/{id}', '\Modules\Intranet\Http\Controllers\Intranet_news@news_delete_single_action');

//Editor
/* Intranet projects OK treba test */
Route::get('/projects-admin', '\Modules\Intranet\Http\Controllers\Intranet_projects@projects_all');
Route::get('/projects-admin-delete/{id}', '\Modules\Intranet\Http\Controllers\Intranet_projects@projects_delete_action');
Route::get('/projects-admin-add', '\Modules\Intranet\Http\Controllers\Intranet_projects@projects_add');
Route::post('/projects-admin-add-action', '\Modules\Intranet\Http\Controllers\Intranet_projects@projects_add_action');
Route::get('/projects-admin-edit/{id}', '\Modules\Intranet\Http\Controllers\Intranet_projects@projects_edit');
Route::post('/projects-admin-edit-action/{id}', '\Modules\Intranet\Http\Controllers\Intranet_projects@projects_edit_action');
Route::get('/photos-admin-activate-project/{id}', '\Modules\Intranet\Http\Controllers\Intranet_projects@project_activate_action');

//HR
/* Intranet media OK treba test */
Route::get('/media-admin', '\Modules\Intranet\Http\Controllers\Intranet_media@media_all');
Route::get('/media-admin-delete/{id}', '\Modules\Intranet\Http\Controllers\Intranet_media@media_delete_action');
Route::get('/media-admin-add', '\Modules\Intranet\Http\Controllers\Intranet_media@media_add');
Route::post('/media-admin-add-action', '\Modules\Intranet\Http\Controllers\Intranet_media@media_add_action');
Route::get('/media-admin-edit/{id}', '\Modules\Intranet\Http\Controllers\Intranet_media@media_edit');
Route::post('/media-admin-edit-action/{id}', '\Modules\Intranet\Http\Controllers\Intranet_media@media_edit_action');

//Reporter
/* Intranet videos OK treba test plus otazka */
Route::get('/videos-admin', '\Modules\Intranet\Http\Controllers\Intranet_videos@videos_all');
Route::get('/videos-admin-delete/{id}', '\Modules\Intranet\Http\Controllers\Intranet_videos@videos_delete_action');
Route::get('/videos-admin-add', '\Modules\Intranet\Http\Controllers\Intranet_videos@videos_add');
Route::post('/videos-admin-add-action', '\Modules\Intranet\Http\Controllers\Intranet_videos@videos_add_action');
Route::get('/videos-admin-edit/{id}', '\Modules\Intranet\Http\Controllers\Intranet_videos@videos_edit');
Route::post('/videos-admin-edit-action/{id}', '\Modules\Intranet\Http\Controllers\Intranet_videos@videos_edit_action');

//Reporter
/* Intranet photos OK treba test + dropzone */
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

//admin
/* Intranet staff OK treba test*/
Route::get('/staff-admin', '\Modules\Intranet\Http\Controllers\Intranet_staff@staff_all');
Route::get('/staff-admin-delete/{id}', '\Modules\Intranet\Http\Controllers\Intranet_staff@staff_delete_action');
Route::get('/staff-admin-add', '\Modules\Intranet\Http\Controllers\Intranet_staff@staff_add');
Route::post('/staff-admin-add-action', '\Modules\Intranet\Http\Controllers\Intranet_staff@staff_add_action');
Route::get('/staff-admin-edit/{id}', '\Modules\Intranet\Http\Controllers\Intranet_staff@staff_edit');
Route::post('/staff-admin-edit-action/{id}', '\Modules\Intranet\Http\Controllers\Intranet_staff@staff_edit_action');
Route::get('/staff-admin-show-profile/{id}', '\Modules\Intranet\Http\Controllers\Intranet_staff@staff_show_profile');
Route::get('/staff-admin-activate-user/{id}', '\Modules\Intranet\Http\Controllers\Intranet_staff@staff_activate_user');

//HR pre vsetkych
/* Intranet attendance OK */ 
Route::get('/attendance-admin/{year?}/{month?}', '\Modules\Intranet\Http\Controllers\Intranet_attendance@attendance');
Route::get('/attendance-admin-ajax', '\Modules\Intranet\Http\Controllers\Intranet_attendance@attendance_ajax');
Route::post('/attendance-pdf-admin-ajax', '\Modules\Intranet\Http\Controllers\Intranet_attendance@attendance_pdf_ajax');
Route::get('/attendance-pdf-download', '\Modules\Intranet\Http\Controllers\Intranet_attendance@download_pdf');


//Reporter
/* Intranet events OK */
Route::get('/events-admin', '\Modules\Intranet\Http\Controllers\Intranet_events@events_all');
Route::get('/events-admin-delete/{id}', '\Modules\Intranet\Http\Controllers\Intranet_events@events_delete_action');
Route::get('/events-admin-add', '\Modules\Intranet\Http\Controllers\Intranet_events@events_add');
Route::post('/events-admin-add-action', '\Modules\Intranet\Http\Controllers\Intranet_events@events_add_action');
Route::get('/events-admin-edit/{id}', '\Modules\Intranet\Http\Controllers\Intranet_events@events_edit');
Route::post('/events-admin-edit-action/{id}', '\Modules\Intranet\Http\Controllers\Intranet_events@events_edit_action');

//HR
/* Intranet documents OK */ 
Route::get('/documents-admin', '\Modules\Intranet\Http\Controllers\Intranet_documents@documents_all');
Route::get('/documents-admin-show/{id}', '\Modules\Intranet\Http\Controllers\Intranet_documents@show_document');
Route::post('/documents-admin-get-content', '\Modules\Intranet\Http\Controllers\Intranet_documents@ajax_get_category_content');
Route::get('/documents-admin-add-category', '\Modules\Intranet\Http\Controllers\Intranet_documents@documents_add_category');
Route::post('/documents-admin-add-category-action', '\Modules\Intranet\Http\Controllers\Intranet_documents@documents_add_category_action');
Route::get('/documents-admin-add-item/{id}', '\Modules\Intranet\Http\Controllers\Intranet_documents@documents_add_item');
Route::post('/documents-admin-add-item-action', '\Modules\Intranet\Http\Controllers\Intranet_documents@documents_add_item_action');
Route::post('/documents-admin/documents_image_upload', '\Modules\Intranet\Http\Controllers\Intranet_documents@documents_image_upload');
Route::post('/documents-files-admin-upload-action', '\Modules\Intranet\Http\Controllers\Intranet_documents@documents_file_upload');
Route::get('/documents-admin-edit-category/{id}', '\Modules\Intranet\Http\Controllers\Intranet_documents@documents_edit_category');
Route::post('/documents-admin-edit-category-action/{id}', '\Modules\Intranet\Http\Controllers\Intranet_documents@documents_edit_category_action');
Route::get('/documents-admin-edit-category-item/{id}', '\Modules\Intranet\Http\Controllers\Intranet_documents@documents_edit_category_item');
Route::post('/documents-admin-edit-category-item-action/{id}', '\Modules\Intranet\Http\Controllers\Intranet_documents@documents_edit_category_item_action');
Route::get('/documents-admin-delete-category/{id}', '\Modules\Intranet\Http\Controllers\Intranet_documents@documents_delete_category_action');
Route::get('//documents-admin-delete-item/{id}', '\Modules\Intranet\Http\Controllers\Intranet_documents@documents_delete_single_action');
Route::get('/delete-file-in-item/{id}', '\Modules\Intranet\Http\Controllers\Intranet_documents@documents_delete_single_file_action');

// TODO prepojit subjects s ucitelmi
/* Intranet Subjects OK */
Route::get('/subjects-admin', '\Modules\Intranet\Http\Controllers\Intranet_subjects@subjects_all');
Route::get('/subjects-admin-add-item/{id}', '\Modules\Intranet\Http\Controllers\Intranet_subjects@subjects_add_item');
Route::post('/subjects-admin-add-item-action', '\Modules\Intranet\Http\Controllers\Intranet_subjects@subjects_add_item_action');
Route::post('/subjects-admin/subjects_image_upload', '\Modules\Intranet\Http\Controllers\Intranet_subjects@subjects_image_upload');
Route::post('/subjects-files-admin-upload-action', '\Modules\Intranet\Http\Controllers\Intranet_subjects@subjects_file_upload');
Route::get('/subjects-admin-edit-item/{id}', '\Modules\Intranet\Http\Controllers\Intranet_subjects@subjects_edit_item');
Route::post('/subjects-admin-edit-item-action/{id}', '\Modules\Intranet\Http\Controllers\Intranet_subjects@subjects_edit_item_action');
Route::get('/delete-subject-file-in-item/{id}', '\Modules\Intranet\Http\Controllers\Intranet_subjects@subjects_delete_single_file_action');
Route::get('/subjects-admin-delete-item/{id}', '\Modules\Intranet\Http\Controllers\Intranet_subjects@subjects_delete_single_action');
