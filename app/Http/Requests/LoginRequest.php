<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Controller;

class LoginRequest extends FormRequest
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
            'email'    => 'required|email|max:50', 
            'password' => 'required|min:6|max:18', 
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator){
        $response = Controller::sendError($validator->errors()->first());
        throw new \Illuminate\Validation\ValidationException($validator, $response);
      
  }
}
