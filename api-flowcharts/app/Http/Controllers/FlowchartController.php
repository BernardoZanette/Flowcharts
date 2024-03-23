<?php

namespace App\Http\Controllers;

use App\Application\Contracts\IFlowchartStructureApplication;
use App\Models\Flowchart;
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

    public function edit(int $id, FlowchartRequest $request) {

        $newFlowchart = $request->toModel(Flowchart::class);
        $newFlowchart->id = $id;
        return $this->flowchartApplication->edit($newFlowchart);
    }

    public function delete(int $id) {

        return $this->flowchartApplication->delete($id);
    }

    public function getStructure(int $id) {
        return $this->flowchartStructureApplication->getStructure($id);
    }

}
