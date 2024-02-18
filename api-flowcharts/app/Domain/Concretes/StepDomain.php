<?php

namespace App\Domain\Concretes;
use App\Data\Repositories\Contracts\IStepRepository;
use App\Models\Step;
use Illuminate\Support\Collection;
use App\Domain\Contracts\IStepDomain;

class StepDomain implements IStepDomain {

    protected IStepRepository $stepRepository;

    public function __construct(IStepRepository $stepRepository) {
        $this->stepRepository = $stepRepository;
    }
    
    public function fetchAll() : Collection {

        return $this->stepRepository->fetchAll();

    }
    
    public function store(Step $step) : Step {

        return $this->stepRepository->store($step);

    }

}