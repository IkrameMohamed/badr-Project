<?php

namespace App\Http\Requests\AppointmentRequest;

use  App\Http\Requests\globalRequest;
use Illuminate\Support\Facades\Gate;

class CheckedAppointment extends globalRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('checked_appointments');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'             => 'required|exists:appointments,id',
        ];
    }


}
