<?php
namespace omairtech\laravel\base\requests;

class DefaultRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
        ];
    }
}
