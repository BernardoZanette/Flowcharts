<?php

namespace App\Http\Controllers;

use App\Application\Contracts\IFlowchartStructureApplication;
use App\Models\Flowchart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FlowchartRequest;
use App\Application\Contracts\IFlowchartApplication;

class FlowchartController extends Controller
{

    private IFlowchartApplication $flowchartApplication; 
    private IFlowchartStructureApplication $flowchartStructureApplication;

    public function __construct(
        IFlowchartApplication $flowchartApplication, 
        IFlowchartStructureApplication $flowchartStructureApplication
    ) {
        $this->flowchartApplication = $flowchartApplication;
        $this->flowchartStructureApplication = $flowchartStructureApplication;
    }

    public function index() {
        return $this->flowchartApplication->fetchAll();
    }

    public function store(FlowchartRequest $request) {
        $flowchart = $request->toModel(Flowchart::class);
        return $this->flowchartApplication->store($flowchart);
    }

    public function getStructure(int $id) {
        return $this->flowchartStructureApplication->getStructure($id);
    }

}
