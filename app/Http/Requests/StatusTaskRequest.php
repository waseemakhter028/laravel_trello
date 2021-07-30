<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Controller;

class StatusTaskRequest extends FormRequest
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
            'id'      => 'required|integer|min:1|exists:tasks,id',
            'status' => 'required|in:To Do,Doing,Done'
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator){
          $response = Controller::sendError($validator->errors()->first());
          throw new \Illuminate\Validation\ValidationException($validator, $response);
        
    }
}
