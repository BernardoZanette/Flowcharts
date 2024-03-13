<?php

namespace App\Application\Concretes;
use App\Domain\Contracts\IStepDomain;
use Illuminate\Support\Collection;
use App\Domain\Contracts\IStepParentDomain;
use App\Application\Contracts\IStepParentApplication;

class StepParentApplication extends BaseApplication implements IStepParentApplication {

    protected IStepParentDomain $stepParentDomain;
    protected IStepDomain $stepDomain;

    public function __construct(IStepParentDomain $stepParentDomain, IStepDomain $stepDomain) {
        $this->stepParentDomain = $stepParentDomain;
        $this->stepDomain = $stepDomain;
    }

    public function fetchAll() : Collection {
        return $this->stepParentDomain->fetchAll();
    }

    public function findByFlowchartId(int $flowchartId) : Collection {   
        $steps = $this->stepDomain->fetchByFlowchartId($flowchartId);
        return $this->stepParentDomain->findStepParentsBySteps($steps);
    }

}