<?php

namespace App\Http\Requests\SettingRequest;

use  App\Http\Requests\globalRequest;
use  Illuminate\Support\Facades\Gate;

class SettingUpdate extends globalRequest
{
    /**
     * Determine if the setting is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('update_settings');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'logo'             =>'mimes:png,jpg,jpeg',
            'company_name'     => 'required',
            'company_number'     => 'required',
        ];
    }


}
