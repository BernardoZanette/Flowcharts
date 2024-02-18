<?php

namespace App\Http\Controllers;

use App\Application\Contracts\IFlowchartApplication;
use App\Http\Controllers\Controller;
use App\Http\Requests\FlowchartRequest;
use App\Models\Flowchart;



class FlowchartController extends Controller
{

    private IFlowchartApplication $flowchartApplication; 

    public function __construct(IFlowchartApplication $flowchartApplication) {
        $this->flowchartApplication = $flowchartApplication;
    }

    public function index() {
        return $this->flowchartApplication->fetchAll();
    }

    public function store(FlowchartRequest $request) {
        $flowchart = $request->toModel(Flowchart::class);
        return $this->flowchartApplication->store($flowchart);
    }

}
