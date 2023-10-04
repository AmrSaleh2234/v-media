<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
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
            'type' => 'required|in:individual,company',
            'name' => 'required_if:type,individual|string',
            'card_id' => 'required_if:type,individual|numeric',
            'card_image' => 'nullable|image',
            'company_name' => 'required_if:type,company|string',
            'register_number' => 'nullable|numeric',
            'agent_name' => 'nullable|string',
            'register_image' => 'nullable|image',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'branch_id' => 'required|exists:branches,id',
            'broker_id' => 'nullable|exists:brokers,id',
            'letter_head' => 'nullable|string'
        ];
    }
}
