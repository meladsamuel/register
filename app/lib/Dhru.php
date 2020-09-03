<?php

namespace shfretak\lib;

use DOMDocument;

//if (!extension_loaded('curl')) {
//    trigger_error('cURL extension not installed', E_USER_ERROR);
//}

/**
 * Class Dhru
 * @package shfretak\lib
 */
class Dhru
{
    /**
     * @var DOMDocument
     */
    public DOMDocument $xmlData;
    /**
     * @var string
     */
    public string $xmlResult;
    /**
     * @var string
     */
    public string $debug;
    /**
     * @var string
     */
    public string $action;
    /**
     * @var string
     */
    public string $url;
    /**
     * @var string|null
     */
    public ?string $username;
    /**
     * @var string
     */
    public string $apiAccessKey;
    /**
     * @var string
     */
    public string $param;
    /**
     * @var string
     */
    public string $page;

    /**
     * Dhru constructor.
     * @param string $url
     * @param string $apiAccessKey
     * @param array $param
     * @param string $username
     */
    public function __construct(string $url, string $apiAccessKey, string $username = '')
    {
        $this->url = $url;
        $this->username = $username;
        $this->apiAccessKey = $apiAccessKey;
        $this->xmlData = new DOMDocument();
    }

    /**
     * @return string
     */
    public function getResult()
    {
        return $this->xmlResult;
    }

    /**
     * @param string $action
     * @param array $arr
     * @return bool|string
     */
    public function action(?string $action, ?array $arr = [])
    {
        if (!is_string($action) && !is_array($arr)) return false;
        if (count($arr)) {
            $request = $this->xmlData->createElement("PARAMETERS");
            $this->xmlData->appendChild($request);
            foreach ($arr as $key => $val) {
                $key = strtoupper($key);
                $request->appendChild($this->xmlData->createElement($key, $val));
            }
        }
        $posted = array(
            'username' => $this->username,
            'apiAccessKey' => $this->apiAccessKey,
            'action' => $action,
            'requestFormat' => "JSON",
            'parameters' => $this->xmlData->saveHTML());
        $crul = \curl_init();
        \curl_setopt($crul, CURLOPT_HEADER, false);
        \curl_setopt($crul, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        \curl_setopt($crul, CURLOPT_RETURNTRANSFER, true);
        \curl_setopt($crul, CURLOPT_URL, "https://{$this->url}{$this->param}");
        \curl_setopt($crul, CURLOPT_POST, true);
        \curl_setopt($crul, CURLOPT_SSL_VERIFYPEER, false);
        if (count($arr))
            \curl_setopt($crul, CURLOPT_POSTFIELDS, $posted);
        $response = \curl_exec($crul);
        if (\curl_errno($crul) != CURLE_OK) {
            echo \curl_error($crul);
            \curl_close($crul);
        } else {
            \curl_close($crul);
            return (json_decode($response, true));
        }

        return false;
    }
    /**
     * the parameters of the page
     * @param array $param
     * @return Dhru
     */
    public function Params(array $param)
    {
        $result = '?';
        foreach ($param as $key => $value)
            $result .= "${key}=${value}&";
        $this->param = $result;
        echo $this->param;
        return $this;
    }
}
