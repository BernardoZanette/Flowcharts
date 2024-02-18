<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'reporter_id' => $this->reporter_id,
            'reported_id' => $this->reported_id,
            'moderator_id' => $this->moderator_id,
            'result' => $this->result
        ];
    }
}
