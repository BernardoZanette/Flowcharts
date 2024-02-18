<?php

namespace App\Data\Repositories\Contracts;
use App\Models\Flowchart;
use Illuminate\Support\Collection;

interface IFlowchartRepository {
    
    public function fetchAll() : Collection;

    public function store(Flowchart $flowchart) : Flowchart;

}