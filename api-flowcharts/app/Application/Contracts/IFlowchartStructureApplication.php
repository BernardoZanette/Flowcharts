<?php

namespace App\Application\Contracts;
use Illuminate\Support\Collection;

interface IFlowchartStructureApplication {

    public function getStructure(int $id) : Collection;

}