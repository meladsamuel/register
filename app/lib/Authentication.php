<?php

namespace app\lib;

class Authentication
{
    private static $_instance;
    private $_session;
    private $_validUrl = [
        'index/default',
        'Msg/default',
        'Service/default',
        'Service/IMEI',
        'Service/Files',
        'Service/Search',
        'en/FilesServices',
        'ar/FilesServices',
        'en/IMEIServices',
        'ar/IMEIServices',

        'language/default',
        'auth/logout',
        'profile/default',
        'profile/change',
        'profile/changePassword',
        'NotFound/NotFound',
        'FileService/getCategory',
        'FileOrder/default',
        'IMEIOrder/add',
        'IMEIOrder/make',
        'IMEIOrder/getServices',
        'FileOrder/getServices',
        'FileOrder/upload',
        'IMEIService/default',
        'payment/cryptoCurrency',
        'payment/payNow',
        'test/default',
        'payment/push'
    ];
    private $_publicUrl = [
        'en/FilesServices',
        'ar/FilesServices',
        'en/IMEIServices',
        'ar/IMEIServices',
        'Service/Search',
        'Service/default',
        'Service/IMEI',
        'Service/Files',
        'payment/server',
        'language/default',
        'FileOrder/upload',
        'index/default'

    ];

    public function __construct($session)
    {
        $this->_session = $session;
    }

    public static function getInstance(SessionManager $session)
    {
        if (self::$_instance === null) {
            self::$_instance = new self($session);
        }
        return self::$_instance;
    }

    /**
     * @param $requestUrl : the url of the page of the user that he want to enter
     * @return bool
     */
    public function isAuthorized($requestUrl)
    {
        return in_array($requestUrl, $this->_publicUrl) || isset($this->_session->u) ? true : false;
    }

    /**
     * @param $controller <p>
     *  the controller of the page that you request it
     * </p>
     * @param $action <p>
     * the action method that you want to call it from controller class
     * </p>
     * @return bool
     */
    public function hasAccess($controller, $action)
    {
        $url = $controller . '/' . $action;
        if (in_array($url, $this->_validUrl) || @in_array($url, $this->_session->u->privilages)) {
            return true;
        }
        return false;
    }
}