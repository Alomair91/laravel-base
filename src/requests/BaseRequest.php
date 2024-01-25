<?php
namespace omairtech\laravel\base\requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseRequest extends FormRequest
{
    use RequestValidator;

    public function authorize()
    {
    }

    public function rules(): array
    {
        return [];
    }

    public function messages(): array
    {
        return [];
    }

//    public function validateResolved()
//    {
//        // Empty data and rules
//        $validator = validator($this->all(), $this->rules());
//
//        throw new \Illuminate\Validation\ValidationException($validator);
//    }
}
