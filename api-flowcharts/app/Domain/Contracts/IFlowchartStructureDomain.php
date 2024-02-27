<?php

namespace App\Domain\Contracts;
use Illuminate\Support\Collection;

interface IFlowchartStructureDomain {
    public function assembleStructure(Collection $steps, Collection $parents) : Collection;

}