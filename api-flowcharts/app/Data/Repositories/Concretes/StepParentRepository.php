<?php

namespace App\Data\Repositories\Concretes;
use App\Data\Repositories\Concretes\BaseRepository;
use App\Data\Repositories\Contracts\IStepParentRepository;
use App\Models\StepParent;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class StepParentRepository extends BaseRepository implements IStepParentRepository {
    
    protected $table = "step_parents";
    protected $excludedFields = [];

    public function fetchAll(): Collection {
        
        $query = $this->getBuilder();
        return $query->get();
    }

    public function store(int $stepId, ?int $stepParentId): StepParent {
        
        $query = $this->getBuilder();
        // $stepParent = new StepParent(["stepId" => $stepId, "stepParentId" => $stepParentId]); 
        // $stepParentArray = $this->mapModelToArray($stepParent);
        $now = Carbon::parse()->setTimezone(config('app.timezone'))->format('Y-m-d H:i:s');
        $id = $query->insertGetId([
            "step_id" => $stepId,
            "step_parent_id" => $stepParentId,
            "created_at" => $now,
            "updated_at" => $now
        ]);
        // $stepParent->id = $id;
        return new StepParent();
    }

    public function deleteConnections(int $stepId): array {

        $query = $this->getBuilder();
        $childrenIds = $query->select('step_id')->where('step_parent_id', '=', $stepId)->pluck('step_id')->toArray();

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