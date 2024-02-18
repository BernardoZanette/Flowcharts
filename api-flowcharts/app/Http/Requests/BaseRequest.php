<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use ReflectionClass;

use Illuminate\Database\Eloquent\Model;

class BaseRequest {

    public function __construct(Request $request) {
        $parameters = $request->all();

        foreach ($parameters as $key => $value) {
            $this->$key = $value;
        }
    }

    public function toModel(string $modelClass) : Model {
        $model = (new ReflectionClass($modelClass))->newInstance();
        foreach ($this as $key => $value) {
            $model->$key = $value;
        }
        return $model;
    }
}