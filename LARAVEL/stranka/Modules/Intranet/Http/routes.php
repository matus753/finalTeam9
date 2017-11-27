<?php

Route::group(['middleware' => 'web', 'prefix' => 'intranet', 'namespace' => 'Modules\Intranet\Http\Controllers'], function()
{
    Route::get('/', 'IntranetController@index');
});
