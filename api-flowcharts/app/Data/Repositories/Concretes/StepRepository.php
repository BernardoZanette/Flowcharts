<?php

namespace App\Data\Repositories\Concretes;
use App\Data\Repositories\Concretes\BaseRepository;
use App\Data\Repositories\Contracts\IStepRepository;
use App\Models\Step;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class StepRepository extends BaseRepository implements IStepRepository {
    
    protected $table = "steps";
    protected $excludedFields = ['stepParentId'];

    public function fetchAll(): Collection {

        $query = $this->getBuilder();
        return $query->get();
    }

    public function store(Step $step): Step {

        $query = $this->getBuilder();
        $stepArray = $this->mapModelToArray($step);
        
        $now = Carbon::parse($step->createdAt)
            ->setTimezone(config('app.timezone'))
            ->format('Y-m-d H:i:s');
        $stepArray['created_at'] = $now;
        $stepArray['updated_at'] = $now;

        $id = $query->insertGetId($stepArray);
        $step->id = $id;
        return $step;
    }

    public function delete(array $stepsIds): int {

        $query = $this->getBuilder();
        $query->whereIn("id", $stepsIds)->delete();
        return http_response_code(202);
    }

    public function fetchByFlowchartId(int $id): Collection {

        $query = $this->getBuilder();
        $query->where("flowchart_id", $id);
        return $query->get();
    }

}