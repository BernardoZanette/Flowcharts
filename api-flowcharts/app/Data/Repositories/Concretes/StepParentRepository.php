<?php

namespace App\Data\Repositories\Concretes;
use App\Data\Repositories\Concretes\BaseRepository;
use App\Data\Repositories\Contracts\IStepParentRepository;
use App\Models\StepParent;
use Illuminate\Support\Collection;

class StepParentRepository extends BaseRepository implements IStepParentRepository {
    
    protected $table = "step_parents";
    protected $excludedFields = [];

    public function fetchAll(): Collection {
        
        $query = $this->getBuilder();
        return $query->get();
    }

    public function store(int $stepId, ?int $stepParentId = null): StepParent {
        
        $query = $this->getBuilder();
        // $stepParent = new StepParent(["stepId" => $stepId, "stepParentId" => $stepParentId]); 
        // $stepParentArray = $this->mapModelToArray($stepParent);
        $id = $query->insertGetId(["step_id" => $stepId, "step_parent_id" => $stepParentId]);
        // $stepParent->id = $id;
        return new StepParent();
    }

    public function deleteConnections(int $stepId): array {

        $query = $this->getBuilder();
        $childrenIds = $query->select('step_id')->where('step_parent_id', '=', $stepId)->get();
        $childrenIds = $this->getIdsFromCollection($childrenIds);

        $query->where('step_parent_id', '=', $stepId)
        ->orWhere('step_id', '=', $stepId)
        ->delete();

        return $childrenIds;
    }

    public function findStepParentsByStepParentIds(array $stepIds): Collection {
        
        $query = $this->getBuilder();
        $query->whereIn("step_parent_id", $stepIds);
        return $query->get();
    }
}