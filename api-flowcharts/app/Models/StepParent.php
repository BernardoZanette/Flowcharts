<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class StepParent extends Model
{
    protected ?int $id = null;
    protected ?int $stepId = null;
    protected ?int $stepParentId = null;
    protected ?Carbon $createdAt = null;
    protected ?Carbon $updatedAt = null;
    protected ?Carbon $deletedAt = null;
    
}
