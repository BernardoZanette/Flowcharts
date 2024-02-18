<?php

namespace App\Data\Repositories\Concretes;
use App\Data\Repositories\Concretes\BaseRepository;
use App\Data\Repositories\Contracts\IFlowchartRepository;
use App\Models\Flowchart;
use Illuminate\Support\Collection;

class FlowchartRepository extends BaseRepository implements IFlowchartRepository {
    
    protected $table = "flowcharts";

    public function fetchAll() : Collection {
        $query = $this->getBuilder();
        return $query->get();
    }

    public function store(Flowchart $flowchart) : Flowchart {
        $query = $this->getBuilder();
        $flowchartArray = $this->mapModelToArray($flowchart);
        $id = $query->insertGetId($flowchartArray);
        $flowchart->id = $id;
        return $flowchart;
    }

}