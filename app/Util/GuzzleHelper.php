<?php

namespace App\Util;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Exception\RequestException;

/**
 * Created by PhpStorm.
 * User: aespinoza
 * Date: 2/27/2018
 * Time: 9:13 AM
 */
class GuzzleHelper
{

    private $client;
    private $baseUrl;
    private $timeOut;
    private $allowRedirects;


    /**
     * GuzzleHelper constructor.
     */
    public function __construct()
    {
        $this->timeOut        = 15.0;
        $this->allowRedirects = true;
    }


    /**
     * @return mixed
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }


    /**
     * @param mixed $baseUrl
     */
    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }


    /**
     * @return float
     */
    public function getTimeOut()
    {
        return $this->timeOut;
    }


    /**
     * @param float $timeOut
     */
    public function setTimeOut($timeOut)
    {
        $this->timeOut = $timeOut;
    }


    /**
     * @return bool
     */
    public function isAllowRedirects()
    {
        return $this->allowRedirects;
    }


    /**
     * @param bool $allowRedirects
     */
    public function setAllowRedirects($allowRedirects)
    {
        $this->allowRedirects = $allowRedirects;
    }


    /**
     *
     */
    private function createClient()
    {
        $this->client = new Client([
            'base_uri'        => $this->getBaseUrl(),
            'timeout'         => $this->getTimeOut(),
            'allow_redirects' => $this->isAllowRedirects()
        ]);

    }


    /**
     * @param $method
     * @param $url
     * @param $options
     *
     * @return array
     */
    public function execRequest($url, $method = 'GET', $options = [])
    {
        Log::info('Begin process: Send request to '.$this->getBaseUrl().$url.' with this options '.json_encode($options).' at '.date('l jS \of F Y h:i:s A'));
        try {
            $this->createClient();
            $response = $this->getResponse($this->client->request($method, $url, $options));
            Log::info('The request '.$this->getBaseUrl().$url.' was successful '.date('l jS \of F Y h:i:s A'));
            Log::info('End process: Send request to '.$this->getBaseUrl().$url.' at '.date('l jS \of F Y h:i:s A'));

            return ResponseUtil::makeResponse('Data retrieved successfully', $response);

        } catch (RequestException $request_exception) {
            $response = $this->getExceptionResponse($request_exception, $url, $options);
            Log::error('RequestException: An error happened at moment of request to '.$this->getBaseUrl().$url.' at '.date('l jS \of F Y h:i:s A'));
            Log::error('RequestException: Error '.json_encode($response));
            Log::info('End process: Send request to '.$this->getBaseUrl().$url.' at '.date('l jS \of F Y h:i:s A'));

            return ResponseUtil::makeErrorResponse('Error '.get_class($request_exception), $response);
        } catch (\Exception $exception) {
            $response = $this->getExceptionResponse($exception, $url, $options);
            Log::error('Exception: An error  happened at moment of request to '.$this->getBaseUrl().$url.' at '.date('l jS \of F Y h:i:s A'));
            Log::error('Exception: Error '.json_encode($response));
            Log::info('End process: Send request to '.$this->getBaseUrl().$url.' at '.date('l jS \of F Y h:i:s A'));

            return ResponseUtil::makeErrorResponse('Error '.get_class($exception), $response);
        }
    }


    /**
     * @param $response
     *
     * @return mixed|\SimpleXMLElement
     */
    private function getResponse($response)
    {
        if (method_exists($response, 'getBody')) {
            $response = $response->getBody()
                                 ->getContents();
            if (json_decode($response)) {
                return json_decode($response);
            }
            if (simplexml_load_string($response) === false && (new \DOMDocument('1.0', 'utf-8'))->loadHTML($response) == true) {
                return simplexml_load_string($response);
            }

            return $response;
        }

        return null;
    }


    /**
     * @param $exception
     * @param $url
     * @param $options
     *
     * @return array
     */
    private function getExceptionResponse(\Exception $exception, $url, $options)
    {
        $response = [
            'error_code'     => $exception->getCode(),
            'error_message'  => $exception->getMessage(),
            'error_response' => $this->getResponse($exception),
            'url'            => $this->getBaseUrl().$url,
            'options'        => $options
        ];

        return $response;
    }
}