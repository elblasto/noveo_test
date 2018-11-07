<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**\
 * Class StoreUser
 */
class StoreUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'name' => 'required|max:255',
            'last_name' => 'required|max:255',
        ];
    }

    /**
     * Validation messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.email' => 'Please enter a valid email address',
            'email.required' => 'Email address is required',
            'name.required' => 'Your name is required',
            'last_name.required' => 'Your last name is required',
        ];
    }

}
