<?php

namespace Bundles\Models;

class FBConnection
{

    /**
     * Method to send Get request to url
     *
     * @param $url
     * @return mixed
     */
    public static function doCurl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = json_decode(curl_exec($ch), true);
        curl_close($ch);
        return $data;
    }

    /**
     * Validate response fb for massage 'error'
     * @param $data
     * @return bool
     */
    public static function validateResponse($data)
    {
        if(isset($data['error'])){
            header("Location: error?msg=" . json_encode($data['error']));
        }
        return true;
    }

}