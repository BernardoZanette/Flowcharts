<?php

namespace App\Application\Concretes;
use App\Application\Contracts\IFlowchartApplication;
use App\Domain\Contracts\IFlowchartDomain;
use App\Models\Flowchart;
use Illuminate\Support\Collection;

class FlowchartApplication extends BaseApplication implements IFlowchartApplication {

    protected IFlowchartDomain $flowchartDomain;

    public function __construct(IFlowchartDomain $flowchartDomain) {
        $this->flowchartDomain = $flowchartDomain;
    }

    public function fetchAll() : Collection {
        return $this->flowchartDomain->fetchAll();
    }

    public function store(Flowchart $flowchart) : Flowchart {
        return $this->flowchartDomain->store($flowchart);
    }

}