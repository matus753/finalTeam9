<?php

Route::group(['middleware' => 'web', 'prefix' => 'study', 'namespace' => 'Modules\Study\Http\Controllers'], function()
{
    Route::get('/', 'StudyController@index');
});
