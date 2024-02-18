<?php

namespace App\Http\Routes;

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'api/flowcharts'], function () {
    Route::get('', 'FlowchartController@index');
    Route::post('', 'FlowchartController@store');
});