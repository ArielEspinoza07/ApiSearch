<?php

namespace App\Http\Controllers;

use App\Util\Proxy\DeezerProxy;
use Log;
use Illuminate\Http\Request;
use App\Util\Proxy\GoogleProxy;
use Symfony\Component\HttpFoundation\Response as HTTP_CODE;

class SongController extends Controller
{

    private $googleProxy;
    private $deezerProxy;


    public function __construct()
    {
        $this->googleProxy = new GoogleProxy();
        $this->deezerProxy = new DeezerProxy();
    }


    public function song(Request $request)
    {
        $requestParams = collect($request->except('_token'));
        if ( ! $requestParams->has('search')) {
            return $this->sendError([], 'Some parameters missing', HTTP_CODE::HTTP_BAD_REQUEST);
        }
        if ($requestParams->get('search')) {
            $deezer = $this->deezerProxy->search($requestParams->get('search'));

            return $this->sendResponse($deezer, 'The search was successfully', HTTP_CODE::HTTP_OK);
        }

        return $this->sendError([], 'empty parameters', HTTP_CODE::HTTP_BAD_REQUEST);

    }


    public function video(Request $request)
    {
        $requestParams = collect($request->except('_token'));
        if ( ! $requestParams->has('search')) {
            return $this->sendError([], 'Some parameters missing', HTTP_CODE::HTTP_BAD_REQUEST);
        }
        if ($requestParams->get('search')) {
            $param  = [
                'q'          => $requestParams->get('search'),
                'maxResults' => $requestParams->get('quantity', 15)
            ];
            $google = $this->googleProxy->search('id,snippet', $param);

            return $this->sendResponse($google, 'The search was successfully', HTTP_CODE::HTTP_OK);
        }

        return $this->sendError([], 'empty parameters', HTTP_CODE::HTTP_BAD_REQUEST);
    }


    public function search(Request $request)
    {
        $requestParams = collect($request->except('_token'));
        if ( ! $requestParams->has('search')) {
            return $this->sendError([], 'Some parameters missing', HTTP_CODE::HTTP_BAD_REQUEST);
        }
        if ($requestParams->get('search')) {
            $deezer = $this->deezerProxy->search($requestParams->get('search'));
            $param  = [
                'q'          => $requestParams->get('search'),
                'maxResults' => $requestParams->get('quantity', 15)
            ];
            $google = $this->googleProxy->search('id,snippet', $param);
            $data   = [
                'song'  => $deezer,
                'video' => $google
            ];

            return $this->sendResponse($data, 'The search was successfully', HTTP_CODE::HTTP_OK);
        }

        return $this->sendError([], 'empty parameters', HTTP_CODE::HTTP_BAD_REQUEST);
    }
}
