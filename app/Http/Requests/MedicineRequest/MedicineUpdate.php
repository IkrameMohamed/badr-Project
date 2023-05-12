<?php

namespace App\Http\Requests\MedicineRequest;

use  App\Http\Requests\globalRequest;
use Illuminate\Support\Facades\Gate;

class MedicineUpdate extends globalRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('update_medicines');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'                    => 'required|exists:medicines,id',
            'medicine_name'         => 'required|string|min:1|unique:medicines,name,'.$this->id.',id',
        ];
    }


}
