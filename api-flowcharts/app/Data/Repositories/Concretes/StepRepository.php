<?php

namespace App\Data\Repositories\Concretes;
use App\Data\Repositories\Concretes\BaseRepository;
use App\Data\Repositories\Contracts\IStepRepository;
use App\Models\Step;
use Illuminate\Support\Collection;

class StepRepository extends BaseRepository implements IStepRepository {
    
    protected $table = "steps";
    protected $excludedFields = [];

    public function fetchAll() : Collection {
        $query = $this->getBuilder();
        return $query->get();
    }

    public function store(Step $step) : Step {
        $query = $this->getBuilder();
        $stepArray = $this->mapModelToArray($step);
        $id = $query->insertGetId($stepArray);
        $step->id = $id;
        return $step;
    }

    public function fetchByFlowchartId(int $id) : Collection {
        $query = $this->getBuilder();
        $query->where("flowchart_id", $id);
        return $query->get();
    }

}