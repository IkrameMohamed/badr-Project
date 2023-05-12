<?php

namespace App\Http\Requests\UserRequest;
use  App\Http\Requests\globalRequest;
use  Illuminate\Support\Facades\Gate;

class UserDelete extends globalRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('delete_users');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'             => 'required|exists:users,id,deleted_at,NULL|not_in:1,2',
        ];
    }

}
