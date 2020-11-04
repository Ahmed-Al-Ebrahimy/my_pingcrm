<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientData extends FormRequest
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
            'name'                  => ['required', 'unique:patients', 'max:22', 'min:10'],
            'birth_date'            => ['required'],
            'gender'                => ['required'],
            'marital'               => ['required'],
            'smoking'               => ['required'],
            'occupation_id'         => ['required'],
            'educationlevel_id'     => ['required'],
            'address_id'            => ['required'],
            'type_id'               => ['required'],
            'fh_of_dm'              => ['required'],

            'systolic_bp'           => ['required',  'max:3', 'min:2'],
            'diastolic_bp'          => ['required',  'max:3', 'min:2'],
            'height'                => ['required',  'max:3', 'min:2'],
            'weight'                => ['required',  'max:3', 'min:2'],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'بشرفك تريد تظيف مريض بدون اسم؟'
        ];
    }

}
