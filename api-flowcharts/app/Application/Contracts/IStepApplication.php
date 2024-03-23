<?php

namespace App\Application\Contracts;
use App\Models\Step;
use Illuminate\Support\Collection;

interface IStepApplication {

    public function fetchAll(): Collection;

    public function store(Step $step): Step;

    // int = status code
    public function delete(int $stepId): int;
    
    public function findByFlowchartId(int $flowchartId): Collection;

}