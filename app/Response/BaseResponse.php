<?php

namespace App\Response;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class BaseResponse
{
    public static function success($data = null, $message = "Success", $item= null, $statuscode = 200)
    {
        return response()->json([
            "Message" => $message,
            "Success" => true,
            "Data" => $data,
            "Item" => $item
        ], $statuscode);
    }

    public static function error($message = "Error", $statusCode = 400)
    {
        return response()->json([
            "Message" => $message,
            "Success" => false
        ], $statusCode);
    }
}
