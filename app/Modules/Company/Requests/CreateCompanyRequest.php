<?php

namespace App\Modules\Company\Requests;

use App\Helpers\CommonRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CreateCompanyRequest extends FormRequest
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
            'address' => 'required|string|max:30',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'username is required',
            'name.string'   => 'name will be a string',
            'address.required' => 'address is required',
            'address.string'   => 'address will be a string',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $this->commonRequest->validateCommonBadRequest($validator);
        
    }
}
