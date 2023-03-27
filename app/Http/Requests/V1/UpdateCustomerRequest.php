<?php

namespace App\Http\Requests\V1;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $method = $this->method();

        if ($method == 'PUT')
        {
            return [
                "name" => ["required"],
                "type" => ["required", Rule::in(["B", "I", "b", "i"])],
                "email" => ["required", "email"],
                "address" => ["required"],
                "city" => ["required"],
                "province" => ["required"],
                "state" => ["required"],
                "postal_code" => ["required"],
            ];
        }
        else
        {
            return [
                "name" => ["sometimes","required"],
                "type" => ["sometimes","required", Rule::in(["B", "I", "b", "i"])],
                "email" => ["sometimes", "required", "email"],
                "address" => ["sometimes", "required"],
                "city" => ["sometimes", "required"],
                "province" => ["sometimes", "required"],
                "state" => ["sometimes", "required"],
                "postal_code" => ["sometimes", "required"],
            ];
        }

    }

    protected function prepareForValidation()
    {
        if ($this->postalCode)
        {
            $this->merge([
                "postal_code" => $this->postalCode
            ]);
        }
    }
}
