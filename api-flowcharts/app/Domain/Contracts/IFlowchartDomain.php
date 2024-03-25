<?php

namespace App\Domain\Contracts;
use App\Models\Flowchart;
use Illuminate\Support\Collection;

interface IFlowchartDomain {

    public function fetchAll() : Collection;

    public function store(Flowchart $flowchart) : Flowchart;   
    
    public function edit(Flowchart $newFlowchart): Flowchart;

    public function delete(int $id): int;

}