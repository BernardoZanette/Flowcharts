<?php

namespace App\Application\Contracts;
use Illuminate\Support\Collection;

interface IStepParentApplication {

    public function fetchAll() : Collection;

    public function findByFlowchartId(int $flowchartId) : Collection;

}