<?php

namespace App\Models\ViewModels;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class FlowchartStructure extends Model
{
    protected ?int $id = null;
    protected ?string $title = null;
    protected ?int $flowchartId = null;
    protected ?Collection $stepParentIds = null;
    protected ?Carbon $createdAt = null;
    protected ?Carbon $updatedAt = null;
    protected ?Carbon $deletedAt = null;
    
}
