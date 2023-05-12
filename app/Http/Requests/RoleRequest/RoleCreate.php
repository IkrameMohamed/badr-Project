<?php

namespace App\Http\Requests\RoleRequest;

use  App\Http\Requests\globalRequest;
use Illuminate\Support\Facades\Gate;

class RoleCreate extends globalRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('add_roles');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'         => 'required|string|min:3|unique:roles,name,NULL,id,deleted_at,NULL'
        ];
    }


}
