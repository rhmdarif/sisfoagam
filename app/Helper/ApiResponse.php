<?php

namespace App\Helper;

use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

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

    public static function Error($data, $code = 200, $message = "Ok")
    {
        return array(
            "status" => false,
            "message" => $message,
            "code" => $code,
            "data" => $data
        );
    }

    public static function NotFound($message)
    {
        return self::Error(null, 404, $message);
    }

    public static function NotAllowed($message)
    {
        return self::Error(null, 401, $message);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
