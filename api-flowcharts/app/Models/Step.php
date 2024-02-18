<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    protected ?int $id = null;
    protected ?string $title = null;
    protected ?int $flowchatId = null;
    protected ?int $parentStepId = null;
    protected ?Carbon $createdAt = null;
    protected ?Carbon $updatedAt = null;
    protected ?Carbon $deletedAt = null;
    
}
