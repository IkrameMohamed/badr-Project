<?php

namespace App\Http\Requests\UserRequest;
use  App\Http\Requests\globalRequest;
use Illuminate\Support\Facades\Gate;

class UserUpdate extends globalRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('update_users');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'             => 'required|exists:users,id,deleted_at,NULL',
            'UserImage'      =>'mimes:png,jpg,jpeg',
            'UserName'      =>'required|string|min:3|unique:users,name,'.$this->id.',id,deleted_at,NULL',
            'UserEmail'      =>'required|email|unique:users,email,'.$this->id.',id',
            'allRoles'         => 'required|exists:roles,id,deleted_at,NULL|not_in:1',
        ];
    }
}
