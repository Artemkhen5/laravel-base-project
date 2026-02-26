<?php

namespace App\Http\Requests;

use App\Http\IndexParams;
use Illuminate\Foundation\Http\FormRequest;

class BaseRequestWithFilter extends FormRequest
{
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
        ];
    }

    public function getParams(): IndexParams
    {
        $this->validated();
        return new IndexParams($this->get('range'));
    }
}
