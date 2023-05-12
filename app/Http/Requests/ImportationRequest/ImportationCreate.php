<?php

namespace App\Http\Requests\ImportationRequest;

use  App\Http\Requests\globalRequest;
use Illuminate\Support\Facades\Gate;

class ImportationCreate extends globalRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('import_medicines');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

        ];
    }


}
