<?php

namespace App\Http\Requests\RoleRequest;

use  App\Http\Requests\globalRequest;
use Illuminate\Support\Facades\Gate;

class RoleUpdatePermissionForAllUsers extends globalRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('update_roles');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'roleId'             => 'required|exists:roles,id,deleted_at,NULL',
        ];
    }


}
