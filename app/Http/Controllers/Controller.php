<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //Success status response
    public function success($message)
    {
        $response = [
            "message" => "success",
            "data" =>  $message
        ];
        return response()->json($response, 200);
    }

    //Created status response
    public function created($message)
    {
        $response = [
            "message" => "created",
            "data" =>  $message
        ];
        return response()->json($response, 201);
    }

    //Fail resquest status response
    public function badrequest($message)
    {
        $response = [
            "message" => "bad request",
            "data" => ['error' => $message]
        ];
        return response()->json($response, 400);
    }

    //Not found status response
    public function notfound($message)
    {
        $response = [
            "message" => "not found",
            "data" => ['error' => $message]
        ];
        return response()->json($response, 404);
    }

    //Severerror status request
    public function severerror($message)
    {
        return response()->json(['error' => $message], 500);
    }
}
