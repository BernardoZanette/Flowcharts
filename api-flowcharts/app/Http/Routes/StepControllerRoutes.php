<?php

namespace App\Http\Routes;

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'api/steps'], function () {
    Route::get('', 'StepController@index');
    Route::post('', 'StepController@store');
    Route::delete('/{stepId}', 'StepController@delete');
    Route::get('/flowchart/{flowchartId}', 'StepController@findByFlowchartId');
});