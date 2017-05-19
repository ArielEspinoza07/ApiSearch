<?php
/**
 * Created by PhpStorm.
 * User: aespinoza
 * Date: 5/18/17
 * Time: 7:52 PM
 */

namespace App\Util;

use Log;

trait ApiToken
{
    /**
     * @param $hash
     * @param $params
     * @return bool
     */
    public function validateHash($hash, $params) {
        $generatedHash = self::generateHash($params);
        Log::info("Trying to validate Hash $hash using ". implode(' ',$params) . " got $generatedHash");
        return strtolower($generatedHash) === strtolower($hash);
    }

    /**
     * @param $params
     * @return string
     */
    public function generateHash($params) {
        $string = implode('', $params);
        return hash_hmac('sha256',$string,env('EVP_PASS_KEY'));
    }
}