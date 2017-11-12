<?php

Route::group(['middleware' => 'web', 'prefix' => 'staff', 'namespace' => 'Modules\Staff\Http\Controllers'], function()
{
    Route::get('/', 'StaffController@index');
});
