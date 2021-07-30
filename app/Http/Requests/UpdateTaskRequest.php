<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Controller;

class UpdateTaskRequest extends FormRequest
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
            'name'        => 'required|max:100'
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator){
          $response = Controller::sendError($validator->errors()->first());
          throw new \Illuminate\Validation\ValidationException($validator, $response);
        
    }
}
