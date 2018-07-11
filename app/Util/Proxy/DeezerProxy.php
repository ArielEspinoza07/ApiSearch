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

        $response = $this->guzzleHelper->request(env('DEEZER_API_URL'), 'search', 'GET', $options);
        $response = collect($response);
        if ($response->get('status')  == 'ok') {
            return $response->get('result')->data;
        }

        return [];
    }
}