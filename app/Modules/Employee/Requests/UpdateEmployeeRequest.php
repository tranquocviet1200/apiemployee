<?php

namespace App\Modules\Employee\Requests;

use App\Helpers\CommonRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
            'name' => 'required|string|max:30',
            'email' => 'required|email|max:50', //email
            'position' =>'required|string|max:30',
            'company_id' => 'required|integer|exists:companies,id', //check id company
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'username is required',
            'name.string'   => 'name will be a string',
            'email.required' => 'email is required',
            'email.email' => 'email is wrong',
            'position.required' => 'position is required',
            'position.string'   => 'position will be a string',
            'company_id.required' => 'company_id is required',
            'company_id.integer' => 'company_id is integer',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $this->commonRequest->validateCommonBadRequest($validator);
        
    }
}
