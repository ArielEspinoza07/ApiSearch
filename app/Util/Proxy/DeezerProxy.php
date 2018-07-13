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

    private $guzzleHelper;


    public function __construct()
    {
        $this->guzzleHelper = new GuzzleHelper();
        $this->guzzleHelper->setBaseUrl(env('DEEZER_API_URL'));
    }


    /**
     * @param $searchParameter
     *
     * @return array
     */
    public function search($searchParameter)
    {
        $options = [
            'query' => [
                'q' => $searchParameter
            ]
        ];

        $response = collect($this->guzzleHelper->execRequest(  'search','GET', $options));
        if ($response->get('success')  == true) {
            return $response->get('data')->data;
        }

        return [];
    }
}