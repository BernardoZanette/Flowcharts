<?php

namespace App\Domain\Concretes;
use App\Data\Repositories\Contracts\IFlowchartRepository;
use App\Models\Flowchart;
use Illuminate\Support\Collection;
use App\Domain\Contracts\IFlowchartDomain;

class FlowchartDomain implements IFlowchartDomain {

    protected IFlowchartRepository $flowchartRepository;

    public function __construct(IFlowchartRepository $flowchartRepository) {
        $this->flowchartRepository = $flowchartRepository;
    }
    
    public function fetchAll() : Collection {

        return $this->flowchartRepository->fetchAll();

    }
    
    public function store(Flowchart $flowchart) : Flowchart {

        return $this->flowchartRepository->store($flowchart);

    }

}