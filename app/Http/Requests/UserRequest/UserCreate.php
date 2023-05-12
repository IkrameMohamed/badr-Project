<?php

namespace App\Http\Requests\UserRequest;

use  App\Http\Requests\globalRequest;
use Illuminate\Support\Facades\Gate;

class UserCreate extends globalRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('add_users');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'UserName'         => 'required|string|min:3|unique:users,name,NULL,id,deleted_at,NULL',
            'allRoles'         => 'required|exists:roles,id,deleted_at,NULL|not_in:1',
            'UserEmail'        => 'required|email|unique:users,email,NUll',
            'UserPassword'=>'required',
        ];
    }


}
