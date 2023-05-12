<?php

namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
class globalRequest extends FormRequest
{
    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'DATA' => $validator->errors(),
            'MESSAGE' => __('validation.you_have_validation_error'),
            'STATUS' => 'ERROR',
            'CODE' => '422',
        ]));
    }

    protected function failedAuthorization()
    {
        throw new HttpResponseException(response()->json([
            'STATUS' => 'WARNING',
            'MESSAGE' => __('validation.This_action_is_unauthorized'),
            'CODE' => '403',
        ]));
    }
}
