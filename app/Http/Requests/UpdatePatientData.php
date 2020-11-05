<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdatePatientData extends FormRequest
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

    // public function rules() {
    //     $id = $this->input('wlId');

    //     return [
    //         'id' => ['sometimes ', 'integer'],
    //         'domain_name' => ['required', 'string', Rule::unique('white_label', 'domain_name')->ignore($id) ],
    //         'disabled' => ['required', 'boolean']
    //     ];
    // }

    public function rules()
    {
        return [
            'name'                 => ['required', Rule::unique('patients')->ignore($request->id), ],
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
}
