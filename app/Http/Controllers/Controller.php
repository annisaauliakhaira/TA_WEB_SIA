<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public $CodeSuccess = 200;
    public $CodeFailed = 500;

    
    public function MessageSuccess($success, $kode=null)
    {
        $kode = $kode ? $kode : $this->CodeSuccess;
        if($success){
            return response()->json([
                'success' => true,
                'data'    => $success,
            ], $kode);
        }

        return response()->json([
            'success' => false,
            'errors'    => "Data Not Found",
        ], 404);
    }

    public function MessageError($error, $kode=null)
    {
        $kode = $kode ? $kode : $this->CodeFailed;
        return response()->json([
            'success' => false,
            'errors'    => $error,
        ], $kode);
    }
}
