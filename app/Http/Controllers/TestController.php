<?php

namespace App\Http\Controllers;

use App\Util\Proxy\DeezerProxy;
use Illuminate\Http\Request;
use App\Util\Proxy\GoogleProxy;
use Symfony\Component\HttpFoundation\Response as HTTP_CODE;

class TestController extends Controller
{
    private $googleProxy;
    private $deezerProxy;

    public function __construct(GoogleProxy $googleProxy, DeezerProxy $deezerProxy)
    {
        $this->googleProxy  =   $googleProxy;
        $this->deezerProxy  =   $deezerProxy;
    }

    public function index(Request $request)
    {
        if($request->session()->has(array('search','videos')))
        {
            $songs      = $request->session()->get('songs');
            $videos     = $request->session()->get('videos');
            $search     = $request->session()->get('search');
            $response   = compact('videos','search','songs');

            return view('video-search')->with($response);
        }
        return view('video-search');
    }

    public function search(Request $request)
    {
        $requestParams    =   $request->except('_token');
        if(is_array($requestParams) && !array_key_exists('search',$requestParams) && !array_key_exists('quantity',$requestParams))
        {
            return view('video-search');
        }
        if(is_null($requestParams['search']) || is_null($requestParams['quantity']) )
        {
            return view('video-search');
        }
        $param  = array(
            'q'             =>  $requestParams['search'],
            'maxResults'    =>  $requestParams['quantity']);
        $part       = 'id,snippet';
        $videos     = $this->googleProxy->search($part,$param);
        $search     = $requestParams['search'];
        $songs      = $this->deezerProxy->search($requestParams['search']);
        $response   = compact('videos','search','songs');

        return redirect()->route('testIndex')->with($response);
    }
}
