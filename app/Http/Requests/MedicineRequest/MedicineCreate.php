<?php

namespace App\Http\Requests\MedicineRequest;

use  App\Http\Requests\globalRequest;
use Illuminate\Support\Facades\Gate;

class MedicineCreate extends globalRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('add_medicines');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'medicine_name'         => 'required|string|min:1|unique:medicines,name,NULL,id',
        ];
    }


}
