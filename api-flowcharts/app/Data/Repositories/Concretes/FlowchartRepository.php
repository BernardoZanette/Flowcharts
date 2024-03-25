<?php

namespace App\Data\Repositories\Concretes;
use App\Data\Repositories\Concretes\BaseRepository;
use App\Data\Repositories\Contracts\IFlowchartRepository;
use App\Models\Flowchart;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class FlowchartRepository extends BaseRepository implements IFlowchartRepository {
    
    protected $table = "flowcharts";

    public function fetchAll(): Collection {
        
        $query = $this->getBuilder();
        return $query->get();
    }

    public function store(Flowchart $flowchart): Flowchart {
       
        $query = $this->getBuilder();
        $flowchartArray = $this->mapModelToArray($flowchart);
        
        $now = Carbon::parse($flowchart->createdAt)
            ->setTimezone(config('app.timezone'))
            ->format('Y-m-d H:i:s');
        $flowchartArray['created_at'] = $now;
        $flowchartArray['updated_at'] = $now;

        $id = $query->insertGetId($flowchartArray);
        $flowchart->id = $id;

        return $flowchart;
    }

    public function edit(Flowchart $newFlowchart): Flowchart {
        
        $query = $this->getBuilder();
        $newFlowchartArray = $this->mapModelToArray($newFlowchart);
        
        $now = Carbon::parse($newFlowchart->createdAt)
        ->setTimezone(config('app.timezone'))
        ->format('Y-m-d H:i:s');
        $newFlowchartArray['updated_at'] = $now;

        $id = $newFlowchartArray['id'];
        unset($newFlowchartArray['id']);
        $query->where('id', $id)->update($newFlowchartArray);
        return $newFlowchart;
    }

    public function delete(int $id): int {
        
        $query = $this->getBuilder();
        $stepsQuery = $this->getBuilder('steps');
        $stepsIds = $this->getBuilder('steps')->where('flowchart_id', $id)->pluck('id')->toArray();
        
        $stepsParentsQuery = $this->getBuilder('step_parents')->whereIn("step_id", $stepsIds)->delete();
        $stepsQuery->whereIn("id", $stepsIds)->delete();
        $query->where("id", $id)->delete();

        return http_response_code(202);
    }
}