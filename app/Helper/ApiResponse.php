<?php

namespace App\Helper;

class ApiResponse
{
    public static function Ok($data, $code = 200, $message = "Ok")
    {
        return array(
            "status" => true,
            "message" => $message,
            "code" => $code,
            "data" => $data
        );
    }
}
