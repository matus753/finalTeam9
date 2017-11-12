<?php

Route::group(['middleware' => 'web', 'prefix' => 'research', 'namespace' => 'Modules\Research\Http\Controllers'], function()
{
    Route::get('/', 'ResearchController@index');
});
