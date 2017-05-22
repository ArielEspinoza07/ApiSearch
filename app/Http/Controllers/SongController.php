<?php

namespace App\Http\Controllers;

use Log;
use Illuminate\Http\Request;
use App\Util\Proxy\GoogleProxy;
use Symfony\Component\HttpFoundation\Response as HTTP_CODE;

class SongController extends Controller
{
    private $googleProxy;

    public function __construct(GoogleProxy $googleProxy)
    {
        $this->googleProxy  =   $googleProxy;
    }

    public function search(Request $request)
    {
        $requestParams    =   $request->except('_token');
        if(is_array($requestParams) && !array_key_exists('search',$requestParams) && !array_key_exists('quantity',$requestParams))
        {
            $response   =   array(
                'status'    =>  (string)'error',
                'code'      =>  (int)HTTP_CODE::HTTP_BAD_REQUEST,
                'message'   =>  (string)'Some parameters missing'
            );

            return $this->response($response,HTTP_CODE::HTTP_BAD_REQUEST);
        }
        if(is_null($requestParams['search']) || is_null($requestParams['quantity']) )
        {
            $response   =   array(
                'status'    =>  (string)'error',
                'code'      =>  (int)HTTP_CODE::HTTP_BAD_REQUEST,
                'message'   =>  (string)'empty parameters'
            );

            return $this->response($response,HTTP_CODE::HTTP_BAD_REQUEST);
        }
        $param  = array(
            'q'             =>  $requestParams['search'],
            'maxResults'    =>  $requestParams['quantity']);
        $search = 'id,snippet';
        $responseGoogle = $this->googleProxy->search($search,$param);

        $response   =   array(
            'status'    =>  (string)'ok',
            'code'      =>  (int)HTTP_CODE::HTTP_OK,
            'message'   =>  (string)'The search was successfully',
            'data'      =>  $responseGoogle
        );

        return $this->response($response,HTTP_CODE::HTTP_OK);
    }
}
