<?php

Route::group(['middleware' => 'web', 'prefix' => 'intranet', 'namespace' => 'Modules\Intranet\Http\Controllers'], function()
{
    Route::get('/media-admin', '\Modules\Intranet\Http\Controllers\Intranet_media@media_all');
    Route::get('/media-admin-delete/{id}', '\Modules\Intranet\Http\Controllers\Intranet_media@media_delete_action');
    Route::get('/media-admin-add', '\Modules\Intranet\Http\Controllers\Intranet_media@media_add');
    Route::post('/media-admin-add-action', '\Modules\Intranet\Http\Controllers\Intranet_media@media_add_action');
    Route::get('/media-admin-edit/{id}', '\Modules\Intranet\Http\Controllers\Intranet_media@media_edit');
    Route::post('/media-admin-edit-action/{id}', '\Modules\Intranet\Http\Controllers\Intranet_media@media_edit_action');

});

