<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Util\Proxy\GoogleProxy;
use Symfony\Component\HttpFoundation\Response as HTTP_CODE;

class TestController extends Controller
{
    private $googleProxy;

    public function __construct(GoogleProxy $googleProxy)
    {
        $this->googleProxy  =   $googleProxy;
    }

    public function search($param,$quantity)
    {
        $param  = array('q'=>$param,'maxResults'=>$quantity);
        $search = 'id,snippet';//,statistics,status,suggestions,topicDetails';
        //id,snippet,contentDetails,fileDetails,player,processingDetails,recordingDetails,statistics,status,suggestions,topicDetails
        $responseGoogle = $this->googleProxy->search($search,$param);

        return $this->response($responseGoogle,HTTP_CODE::HTTP_OK);
    }
}
