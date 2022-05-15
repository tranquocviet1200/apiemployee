<?php

namespace App\Modules\User\Requests;

use App\Helpers\CommonRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class UserRegisterRequest extends FormRequest
{
    private $commonRequest;

    public function __construct(CommonRequest $commonRequest)
    {
        $this->commonRequest = $commonRequest;
    }
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
            'username' => 'required|string|max:30',
            'email' => 'required|email|max:50|unique:users',
            'password' => 'required|string|max:30|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'username is required',
            'email.required' => 'email is required',
            'email.email' => 'email is wrong',
            'password.required' => 'password is required',
            'password.string'   => 'password will be a string',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $this->commonRequest->validateCommonBadRequest($validator);
        
    }
}
