<?php

$version = config('generic-rest-api.api-version');

Route::group(['prefix' => 'api/'.$version], function () {
    Route::get('{model}', 'Wilgucki\GenericRestApi\Controllers\ApiController@index');
    Route::get('{model}/{id}', 'Wilgucki\GenericRestApi\Controllers\ApiController@show');
    Route::post('{model}', 'Wilgucki\GenericRestApi\Controllers\ApiController@create');
    Route::put('{model}/{id}', 'Wilgucki\GenericRestApi\Controllers\ApiController@update');
    Route::delete('{model}/{id}', 'Wilgucki\GenericRestApi\Controllers\ApiController@delete');
});
