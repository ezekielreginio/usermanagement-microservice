<?php

namespace App\Http\Requests;

use App\Http\Requests\Traits\ResponseAsJson;
use Illuminate\Foundation\Http\FormRequest;

class ClientRegistrationRequest extends FormRequest
{
    use ResponseAsJson;
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user.name' => 'required|string',
            'user.email' => 'required|email:rfc,dns|unique:users,email',
            'user.password' => 'required|string|min:8',

            'client.contact_number' => 'required|string',
            'client.address' => 'required|string',

            "business.name" => "required_with:business|string",
            "business.address" => "required_with:business|string",
            "business.contact_number" => "required_with:business|string",
            "business.nature_of_business" => "required_with:business|string",
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'user.name' => 'full name',
            'user.email' => 'email address',
            'user.password' => 'password',

            'client.contact_number' => 'client contact number',
            'client.address' => 'client address',

            "business.name" => "business name",
            "business.address" => "business address",
            "business.contact_number" => "business contact number",
            "business.nature_of_business" => "nature of business",
        ];
    }
}
