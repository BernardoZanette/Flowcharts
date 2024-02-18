<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;


class StepRequest extends BaseRequest
{
    protected ?int $id = null;
    protected ?int $flowchart_id = null;
    protected ?string $title = null;

}
