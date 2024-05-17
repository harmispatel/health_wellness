<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendResponse($result,$message,$success)
    {
        $response = [
            'data' => $result,
            'message' => $message,
            'success' => $success, 
        ];

        return response()->json($response, 200);
    }
}
