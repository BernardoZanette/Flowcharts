<?php

namespace App\Http\Routes;

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'api/stepParents'], function () {
    Route::get('', 'StepParentController@index');
    Route::get('/flowchart/{flowchartId}', 'StepParentController@findByFlowchartId');
});