<?php

namespace App\Http\Requests\ReservationRequest;

use  App\Http\Requests\globalRequest;
use Illuminate\Support\Facades\Gate;

class ReservationCreate extends globalRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('add_reservations');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'house' => 'required|exists:houses,id',
            'beds_number' => 'required',
        ];
    }

}
