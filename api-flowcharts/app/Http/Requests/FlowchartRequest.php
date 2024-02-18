<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;


class FlowchartRequest extends BaseRequest
{
    protected ?int $id = null;
    protected ?string $title = null;

}
