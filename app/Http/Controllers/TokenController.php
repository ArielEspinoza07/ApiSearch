<?php

namespace App\Http\Controllers;

use Response;
use App\Util\ApiToken;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HTTP_CODE;

class TokenController extends Controller
{
    use ApiToken;

    public function generateToken(Request $request)
    {
        $token  = $this->generateHash($request->except('_token'));

        $response   =   array(
            'status'    =>  (string)'ok',
            'code'      =>  (int)HTTP_CODE::HTTP_OK,
            'message'   =>  (string)'The generation of token was successfully',
            'data'      =>  $token
        );

        return Response::json($response,HTTP_CODE::HTTP_OK);
    }
}
