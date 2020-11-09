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
        ];
    }
}
