<?php

namespace App\Domain\Concretes;

use App\Domain\Contracts\IFlowchartStructureDomain;
use App\Models\ViewModels\FlowchartStructure;
use App\Models\Step;
use App\Models\StepParent;
use Illuminate\Support\Collection;
use stdClass;

class FlowchartStructureDomain implements IFlowchartStructureDomain {
    
    public function assembleStructure(Collection $steps, Collection $parents) : Collection {
        $flowchartStructure = new Collection();
        foreach ($steps as $step) {
            $connections = $parents->filter(function ($parent, $key) use ($step) {
                return $parent->step_id === $step->id;
            });
            $flowchartStructureComponent = $this->createStructureConnection($step, $connections);
            $flowchartStructure->push($flowchartStructureComponent);
        }
        return $flowchartStructure;
    }

    private function createStructureConnection(stdClass $step, Collection $connections) : stdClass {
        $flowchartStructure = new stdClass();
        $flowchartStructure->id = $step->id;
        $flowchartStructure->title = $step->title;
        $flowchartStructure->flowchartId = $step->flowchart_id;
        $flowchartStructure->stepParentIds = $connections;
        return $flowchartStructure;
    }

}