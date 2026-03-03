<?php

namespace App\Http\Requests;

use App\Http\IndexParams;
use Illuminate\Foundation\Http\FormRequest;

class BaseRequestWithFilter extends FormRequest
{
    protected array $sortableFields = [];
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $range = json_decode($this->input('range', '[]'));
        if ($range !== []) {
            $this->merge(['range' => $range]);
        }
        $sort = json_decode($this->input('sort', '[]'));
        if ($sort !== [] && is_array($sort)) {
            $field = $sort[0];
            if (!in_array($field, $this->sortableFields)) {
                throw new \Exception("Invalid sort field '$field'.");
            }
            $dir = strtolower($sort[1]);
            if (!in_array($dir, ['asc', 'desc'])) {
                throw new \Exception("Invalid sort direction '$dir'.");
            }
            $this->merge(['sort' => $sort]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'range' => 'sometimes|array|size:2',
            'range.*' => 'integer|min:0',
            'sort' => 'sometimes|array|size:2',
            'sort.*' => 'string',
        ];
    }

    public function getParams(): IndexParams
    {
        $this->validated();
        return new IndexParams(range: $this->get('range'), sort: $this->get('sort'));
    }
}
