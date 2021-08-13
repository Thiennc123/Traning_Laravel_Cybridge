<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $rules = [
            'name' => 'required|min:10',

        ];

        return $rules;
    }

    /**
     * Change attributes name
     *
     * @return array
     */


    /**
     * Return message if nescesary
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => ' Bạn cần phải điền tên',

        ];
    }
}
