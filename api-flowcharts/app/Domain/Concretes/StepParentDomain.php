<?php

namespace App\Domain\Concretes;
use App\Models\StepParent;
use Illuminate\Support\Collection;
use App\Domain\Contracts\IStepParentDomain;
use App\Data\Repositories\Contracts\IStepParentRepository;

class StepParentDomain implements IStepParentDomain {

    protected IStepParentRepository $stepParentRepository;

    public function __construct(IStepParentRepository $stepParentRepository) {
        $this->stepParentRepository = $stepParentRepository;
    }
    
    public function fetchAll() : Collection {

        return $this->stepParentRepository->fetchAll();

    }
    
    public function store(int $stepId, int $stepParentId) : StepParent {

        return $this->stepParentRepository->store($stepId, $stepParentId);

    }

    public function findStepParentsBySteps(Collection $steps) : Collection {

        $stepIds = [];
        foreach ($steps as $step) {
            $stepIds[] = $step->id;
        }
        return $this->stepParentRepository->findStepParentsByStepParentIds($stepIds);

    }

}