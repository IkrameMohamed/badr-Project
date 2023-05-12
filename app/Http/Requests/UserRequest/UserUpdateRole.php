<?php

namespace App\Http\Requests\UserRequest;
use  App\Http\Requests\globalRequest;
use Illuminate\Support\Facades\Gate;

class UserUpdateRole extends globalRequest
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
            'role_id'             => 'required|exists:roles,id,deleted_at,NULL|not_in:1',
            'user_id'             => 'required|exists:users,id,deleted_at,NULL|not_in:1,2',
        ];
    }

}
