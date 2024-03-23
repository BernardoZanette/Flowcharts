<?php

namespace App\Http\Controllers;

use App\Application\Contracts\IStepApplication;
use App\Http\Controllers\Controller;
use App\Http\Requests\StepRequest;
use App\Models\Step;

class StepController extends Controller
{

    private IStepApplication $stepApplication; 

    public function __construct(IStepApplication $stepApplication) {
        $this->stepApplication = $stepApplication;
    }

    public function index() {
        return $this->stepApplication->fetchAll();
    }

    public function store(StepRequest $request) {
        $step = $request->toModel(Step::class);
        return $this->stepApplication->store($step);
    }

    public function delete(int $stepId) {
        return $this->stepApplication->delete($stepId);
    }

    public function findByFlowchartId(int $flowchartId) {
        return $this->stepApplication->findByFlowchartId($flowchartId);
    }

}
