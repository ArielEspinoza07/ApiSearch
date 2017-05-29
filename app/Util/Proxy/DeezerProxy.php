<?php
/**
 * Created by PhpStorm.
 * User: Ariel-PC
 * Date: 28/5/2017
 * Time: 5:27 PM
 */

namespace App\Util\Proxy;


use App\Util\GuzzleHelper;

class DeezerProxy
{
    /**
     * @var GuzzleHelper
     */
    private $guzzleHelper;

    /**
     * DeezerProxy constructor.
     * @param GuzzleHelper $guzzleHelper
     */
    public function __construct(GuzzleHelper $guzzleHelper)
    {
        $this->guzzleHelper =   $guzzleHelper;
    }


    public function search($searchParameter)
    {
        $options    =   array(
            'query' => array(
                'q' => $searchParameter
            )
        );

        $response   =   $this->guzzleHelper->request(env('DEEZER_API_URL'),'search','GET',$options);

        if(is_array($response) && array_key_exists('status',$response) && $response['status'] == 'ok')
        {
            return $response['result']->data;
        }

        return array();
    }
}