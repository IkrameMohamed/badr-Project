<?php

namespace App\Http\Requests\MedicineRequest;
use  App\Http\Requests\globalRequest;
use  Illuminate\Support\Facades\Gate;

class MedicineGetData extends globalRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('medicines');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'             => 'required|exists:medicines,id',
        ];
    }

}
