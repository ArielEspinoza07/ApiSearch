<?php
/**
 * Created by PhpStorm.
 * User: aespinoza
 * Date: 5/18/17
 * Time: 2:06 PM
 */

namespace App\Util\Proxy;

use Google_Client;
use Google_Service_YouTube;

class GoogleProxy
{

    private $googleClient;


    public function __construct()
    {
        $this->googleClient = new Google_Client();
        $this->googleClient->setDeveloperKey(env('GOOGLE_API_KEY'));
    }


    /**
     * @param       $searchString
     * @param array $optParams
     *
     * @return array|\Google_Service_YouTube_SearchListResponse
     */
    public function search($searchString, $optParams = ['q' => '', 'maxResults' => '10'])
    {
        try {
            $youtubeService = new Google_Service_YouTube($this->googleClient);
            $response       = $youtubeService->search->listSearch($searchString, $optParams);

            return $this->modifyResponseSearch($response['items']);
        } catch (\Google_Service_Exception $gooEx) {
            $response = [
                'status'  => 'error',
                'code'    => $gooEx->getCode(),
                'message' => json_decode($gooEx->getMessage())
            ];

            return $response;
        }
    }


    /**
     * @param array $response
     *
     * @return array
     */
    private function modifyResponseSearch(array $response)
    {
        $lstVideos = [];
        foreach ($response as $searchResult) {
            if ($searchResult['id']['kind'] == 'youtube#video') {
                $video              = new \stdClass();
                $video->channel     = (string)$searchResult['snippet']['channelTitle'];
                $video->tittle      = (string)$searchResult['snippet']['title'];
                $video->description = (string)$searchResult['snippet']['description'];
                $video->link        = (string)'http://www.youtube.com/watch?v='.$searchResult['id']['videoId'];
                $video->iframe      = (string)'https://www.youtube.com/embed/'.$searchResult['id']['videoId'];
                $video->thumbnails  = [
                    'default' => [
                        'url'    => (string)$searchResult['snippet']['thumbnails']['default']['url'],
                        'width'  => (int)$searchResult['snippet']['thumbnails']['default']['width'],
                        'height' => (int)$searchResult['snippet']['thumbnails']['default']['height'],
                    ],
                    'medium'  => [
                        'url'    => (string)$searchResult['snippet']['thumbnails']['medium']['url'],
                        'width'  => (int)$searchResult['snippet']['thumbnails']['medium']['width'],
                        'height' => (int)$searchResult['snippet']['thumbnails']['medium']['height'],
                    ],
                    'high'    => [
                        'url'    => (string)$searchResult['snippet']['thumbnails']['high']['url'],
                        'width'  => (int)$searchResult['snippet']['thumbnails']['high']['width'],
                        'height' => (int)$searchResult['snippet']['thumbnails']['high']['height'],
                    ]
                ];
                array_push($lstVideos, $video);
            }
        }

        return $lstVideos;
    }
}