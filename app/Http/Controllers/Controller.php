<?php

namespace App\Http\Controllers;

use App\Util\ResponseUtil;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{

    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;


    protected function sendResponse($result, $message, $code)
    {
        return response()->json(ResponseUtil::makeResponse($message, $result), $code);
    }


    protected function sendError($result, $message, $code)
    {
        return response()->json(ResponseUtil::makeError($message, $result), $code);
    }
}
