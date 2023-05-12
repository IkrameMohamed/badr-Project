<?php

namespace App\Http\Requests\AppointmentRequest;

use  App\Http\Requests\globalRequest;
use Illuminate\Support\Facades\Gate;

class AppointmentCreate extends globalRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('add_appointments');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'doctor'           =>  'required|exists:doctors,id',
            'visit_type'       =>  'required|exists:visit_types,id',
            'appointment_date'             =>  'required|date',
        ];
    }


}
