<?php

namespace App\Http\Requests;

class PostIndexRequest extends BaseRequestWithFilter
{
    public function rules(): array
    {
        return array_merge(parent::rules(), []);
    }
}
