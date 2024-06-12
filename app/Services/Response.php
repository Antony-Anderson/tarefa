<?php
namespace App\Services;

class Response
{
    public static function data($data, $code=200){
        return response()->json([
            'success'=>true,
            'type' => 'success',
            'data' => $data
        ], $code);
    }

    public static function success($message, $code=200, $data=null){
        return response()->json([
            'success'=>true,
            'type' => 'success',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public static function error($message, $code=500){
        return response()->json([
            'success'=>false,
            'type' => 'error',
            'message' => $message,
        ], $code);
    }
}
