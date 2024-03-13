<?php

namespace App\Domain\Contracts;
use App\Models\Step;
use Illuminate\Support\Collection;

interface IStepDomain {

    public function fetchAll() : Collection;

    public function store(Step $step) : Step;

    public function fetchByFlowchartId(int $id) : Collection;

}