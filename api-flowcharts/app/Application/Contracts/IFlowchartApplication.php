<?php

namespace App\Application\Contracts;
use App\Models\Flowchart;
use Illuminate\Support\Collection;

interface IFlowchartApplication {

    public function fetchAll() : Collection;

    public function store(Flowchart $flowchart): Flowchart;

    public function edit(Flowchart $newFlowchart): Flowchart;

    public function delete(int $id): int;
}