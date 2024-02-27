<?php

namespace App\Domain\Contracts;
use App\Models\StepParent;
use Illuminate\Support\Collection;

interface IStepParentDomain {

    public function fetchAll() : Collection;

    public function store(int $stepId, int $stepParentId) : StepParent;

    public function findStepParentsBySteps(Collection $steps) : Collection;

}