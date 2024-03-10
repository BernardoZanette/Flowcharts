<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Application\Contracts\IStepParentApplication;

class StepParentController extends Controller
{

    private IStepParentApplication $stepParentApplication; 

    public function __construct(IStepParentApplication $stepParentApplication) {
        $this->stepParentApplication = $stepParentApplication;
    }

    public function index() {
        return $this->stepParentApplication->fetchAll();
    }

    public function findByFlowchartId(int $flowchartId) {
        return $this->stepParentApplication->findByFlowchartId($flowchartId);
    }

}
