<?php

namespace App\Http\Requests\UserRequest;

use  App\Http\Requests\globalRequest;
use Illuminate\Support\Facades\Gate;

class UserCreateWithoutLogin extends globalRequest
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
            'UserName'         => 'required|string|min:3|unique:users,name,NULL,id,deleted_at,NULL',
            'UserEmail'        => 'required|email|unique:users,email,NUll',
            'type'           => 'required',
            'UserPassword'=>'required',
        ];
    }


}
