<?php
namespace App\Http\Requests\Traits;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait ResponseAsJson
{
    /**
     * catch validation failed.
     *
     * @param Validator $validator
     * 
     * @throws HttpResponseException
     * @return void
     */
    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json([
            'errors'        => $validator->errors(), 
            'error_code'    => 'UNPROCCESSABLE_ENTITY'
        ], 422));
    }
}