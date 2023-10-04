<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'keywords' => "string|nullable",
            'orderBy'=> "string|nullable",
            'orderDesc' => "boolean|nullable",
            'limit' => "numeric|nullable",
            'filter' => "numeric|nullable",
        ];
    }
}
