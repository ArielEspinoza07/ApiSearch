<?php
/**
 * Created by PhpStorm.
 * User: aespinoza
 * Date: 10/07/18
 * Time: 10:19 PM
 */

namespace App\Util;

class ResponseUtil
{

    public function __construct()
    {
    }


    /**
     * @param $message
     * @param $data
     *
     * @return array
     */
    public static function makeResponse($message, $data)
    {
        $res = [
            'success' => true,
            'data'    => $data,
            'message' => $message,
        ];

        self::utf8_encode_deep($res);

        return $res;
    }


    /**
     * @param       $message
     * @param array $data
     *
     * @return array
     */
    public static function makeError($message, array $data = [])
    {
        $res = [
            'success' => false,
            'message' => $message,
        ];
        if ( ! empty($data)) {
            $res['data'] = $data;
        }
        self::utf8_encode_deep($res);

        return $res;
    }

    public static function utf8_encode_deep(&$input)
    {
        if (is_string($input)) {
            $input = utf8_encode($input);
        } else {
            if (is_array($input)) {
                foreach ($input as &$value) {
                    self::utf8_encode_deep($value);
                }

                unset($value);
            } else {
                if (is_object($input)) {
                    $vars = array_keys(get_object_vars($input));

                    foreach ($vars as $var) {
                        self::utf8_encode_deep($input->$var);
                    }
                }
            }
        }
    }
}