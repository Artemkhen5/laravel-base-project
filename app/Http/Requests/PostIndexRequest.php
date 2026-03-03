<?php

namespace App\Http\Requests;

class PostIndexRequest extends BaseRequestWithFilter
{
    protected array $sortableFields = ['id'];
    public function rules(): array
    {
        return array_merge(parent::rules(), []);
    }
}
