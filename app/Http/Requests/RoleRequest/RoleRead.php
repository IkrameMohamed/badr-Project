<?php

namespace App\Http\Requests\RoleRequest;

use  App\Http\Requests\globalRequest;
use Illuminate\Support\Facades\Gate;

class RoleRead extends globalRequest
{
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
            'id'             => 'exists:roles,id,deleted_at,NULL',
        ];
    }


}
