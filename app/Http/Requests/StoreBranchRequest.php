<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBranchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'type' => 'required',
            'parent_id' => 'required_if:type,sub',
            'city_id' => 'required|exists:cities,id',
            'country_id' => 'required|exists:countries,id',
            'latitude' => 'required',
            'longitude' => 'required',

            'shift_branch' => 'nullable',
            'shift_id' => 'nullable',
            'shifts' => 'required|array',
            'distance' => 'required|numeric',
//             'address' => 'required',
            // 'active' => 'required',
            'meta_name' => 'nullable|string',
            'date_finish' => 'nullable|required_with:meta_name|date|date_format:Y-m-d',
            'date_notification' => 'nullable|required_with:meta_name|date|date_format:Y-m-d|before_or_equal:date_finish',
            'meta_attachment' => 'nullable|required_with:meta_name',
        ];
    }

//    public function getValidatorInstance()
//    {
//        $this->cleanPhoneNumber();
//        return parent::getValidatorInstance();
//    }

}
