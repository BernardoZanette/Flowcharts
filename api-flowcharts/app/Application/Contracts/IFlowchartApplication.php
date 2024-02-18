<?php

namespace App\Application\Contracts;
use App\Models\Flowchart;
use Illuminate\Support\Collection;

interface IFlowchartApplication {

    public function fetchAll() : Collection;

    public function store(Flowchart $flowchart) : Flowchart;

}