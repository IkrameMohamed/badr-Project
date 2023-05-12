<?php

namespace App\Http\Requests\GlobalRequests;

use  App\Http\Requests\globalRequest;

class GetEnumValues extends globalRequest
{
    /**
     * Determine if the setting is authorized to make this request.
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
        ];
    }


}
