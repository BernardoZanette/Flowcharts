<?php

namespace App\Application\Concretes;
use App\Models\Step;
use Illuminate\Support\Collection;
use App\Domain\Contracts\IStepDomain;
use App\Domain\Contracts\IStepParentDomain;
use App\Application\Contracts\IStepApplication;

class StepApplication extends BaseApplication implements IStepApplication {

    protected IStepDomain $stepDomain;
    protected IStepParentDomain $stepParentDomain;

    public function __construct(IStepDomain $stepDomain, IStepParentDomain $stepParentDomain) {
        $this->stepDomain = $stepDomain;
        $this->stepParentDomain = $stepParentDomain;
    }

    public function fetchAll(): Collection {
        
        return $this->stepDomain->fetchAll();
    }

    public function store(Step $step): Step {

        $step = $this->stepDomain->store($step);
        $this->stepParentDomain->store($step->id, $step->stepParentId);
        return $step;
    }

    public function delete(int $stepId): int {

        $childrenIds = $this->stepParentDomain->deleteConnections($stepId);
        $childrenIds[] = $stepId;
        $stepsIds = $childrenIds;
        return $this->stepDomain->delete($stepsIds);
    }

    public function findByFlowchartId(int $flowchartId): Collection {
        return $this->stepDomain->fetchByFlowchartId($flowchartId);
    }

}