<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Config;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * return response success as json or array
     *
     * @param [string] $message
     * @param [array] $data
     * @param [integer] $code
     * @param [bool] $isArray
     *
     * @return [json | array]
     */
    public function returnSuccess($message=NULL, $data = NULL, $code = NULL,$isArray = FALSE)
    {
        $respence = [
            'STATUS'    => 'SUCCESS',
            'MESSAGE'   =>  __($message),
            'DATA'      => $data,
            'CODE'      => ($code) ?? config('constants.STATUS_CODE.SUCCESS')
        ];

        if($isArray)
            return $respence;

        return response()->json($respence);
    }

    /**
     * return response error as json or array
     *
     * @param [string] $message
     * @param [array] $data
     * @param [integer] $code
     * @param [bool] $isArray
     *
     * @return [json | array]
     */
    public function returnError($message=NULL,$data = NULL,$code = NULL,$isArray = FALSE)
    {
        $respence = [
            'STATUS'    => 'ERROR',
            'MESSAGE'   =>  __($message),
            'DATA'      => $data,
            'CODE'      => ($code) ?? config('constants.STATUS_CODE.SUCCESS')
        ];

        if($isArray)
            return $respence;

        return response()->json($respence);
    }

    /**
     * return response warnning as json or array
     *
     * @param [string] $message
     * @param [array] $data
     * @param [integer] $code
     * @param [bool] $isArray
     *
     * @return [json | array]
     */
    public function returnWarning($message=NULL,$data = NULL,$code = NULL,$isArray = FALSE)
    {
        $respence = [
            'STATUS'    => 'WARNING',
            'MESSAGE'   =>  __($message),
            'DATA'      => $data,
            'CODE'      => ($code) ?? config('constants.STATUS_CODE.SUCCESS')
        ];

        if($isArray)
            return $respence;

        return response()->json($respence);
    }
}
