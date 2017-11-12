<?php

Route::group(['middleware' => 'web', 'prefix' => 'about', 'namespace' => 'Modules\About\Http\Controllers'], function()
{
    Route::get('/', 'AboutController@index');
});
