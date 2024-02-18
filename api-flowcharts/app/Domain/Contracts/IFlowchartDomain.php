<?php

namespace App\Domain\Contracts;
use App\Models\Flowchart;
use Illuminate\Support\Collection;

interface IFlowchartDomain {

    public function fetchAll() : Collection;

    public function store(Flowchart $flowchart) : Flowchart;

}