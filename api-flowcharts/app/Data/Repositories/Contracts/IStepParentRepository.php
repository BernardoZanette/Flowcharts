<?php

namespace App\Data\Repositories\Contracts;
use App\Models\StepParent;
use Illuminate\Support\Collection;

interface IStepParentRepository {
    
    public function fetchAll(): Collection;

    public function store(int $stepId, ?int $stepParentId): StepParent;

    public function deleteConnections(int $stepId): array;
}