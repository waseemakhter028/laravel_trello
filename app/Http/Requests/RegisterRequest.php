<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Controller;

class RegisterRequest extends FormRequest
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
            'name'       => 'required|max:30', 
            'email'      => 'required|email|unique:users|max:60', 
            'password'   => 'required|min:6|max:18', 
            'c_password' => 'required|same:password',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator){
        $response = Controller::sendError($validator->errors()->first());
        throw new \Illuminate\Validation\ValidationException($validator, $response);
      
  }
}
