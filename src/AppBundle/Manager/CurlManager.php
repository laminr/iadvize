<?php
/**
 * Created by PhpStorm.
 * User: tweety
 * Date: 23/03/15
 * Time: 20:57
 */

namespace AppBundle\Manager;


class CurlManager {

    public static function getData($url = "") {

        $ch = curl_init();
        $timeout=5;

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

        // Get URL content
        $lines_string=curl_exec($ch);
        // close handle to release resources
        curl_close($ch);
        //output, you can also save it locally on the server
        return $lines_string;
    }
}