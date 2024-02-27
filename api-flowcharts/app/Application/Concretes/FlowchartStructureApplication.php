<?php

namespace App\Application\Concretes;
use App\Domain\Contracts\IFlowchartStructureDomain;
use App\Domain\Contracts\IStepDomain;
use App\Domain\Contracts\IStepParentDomain;
use App\Models\Flowchart;
use Illuminate\Support\Collection;
use App\Application\Contracts\IFlowchartStructureApplication;

class FlowchartStructureApplication extends BaseApplication implements IFlowchartStructureApplication {

    protected IStepDomain $stepDomain;
    protected IStepParentDomain $stepParentDomain;
    protected IFlowchartStructureDomain $flowchartStructureDomain;

    public function __construct(
        IStepDomain $stepDomain,
        IStepParentDomain $stepParentDomain, 
        IFlowchartStructureDomain $flowchartStructureDomain
    ) {
        $this->stepDomain = $stepDomain;
        $this->stepParentDomain = $stepParentDomain;
        $this->flowchartStructureDomain = $flowchartStructureDomain;
    }

    public function getStructure(int $id) : Collection {
        $steps = $this->stepDomain->fetchByFlowchartId($id);
        $parents = $this->stepParentDomain->findStepParentsBySteps($steps);
        $structure = $this->flowchartStructureDomain->assembleStructure($steps, $parents);
        return $structure;
    }

}