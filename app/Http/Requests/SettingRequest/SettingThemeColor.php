<?php

namespace App\Http\Requests\SettingRequest;

use  App\Http\Requests\globalRequest;
use App\User;
use Illuminate\Support\Facades\Auth;
use  Illuminate\Support\Facades\Gate;

class SettingThemeColor extends globalRequest
{
    /**
     * Determine if the setting is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->role_id == 1;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $theme = 'default,green,red,blue,purple,megna,default-dark,green-dark,red-dark,blue-dark,purple-dark,megna-dark';
        return [
            'theme_color'             =>'string|in:'.$theme,
        ];
    }


}
