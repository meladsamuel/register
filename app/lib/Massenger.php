<?php
namespace shfretak\lib;
/**
 * @proparty SessionManager $_session
 * */
class Massenger{
      const APP_MESSAGE_SUCCESS       = 'success';
      const APP_MESSAGE_ERROR         = 'error';
      const APP_MESSAGE_WARNING       = 'warning';
      const APP_MESSAGE_INFO          = 'info';

    /**
     * @var Massenger
     */
    private static $_instance;
    /**
     * @var SessionManager
     */
    private $_session;
    /**
     * @var
     */
    private $_messages;

    public function __construct(SessionManager $session) {
        $this->_session = $session;
    }
    public function __clone() {}

    public static function getInstance(SessionManager $session) {
        if(self::$_instance === null) {
              self::$_instance = new self($session);
        }
        return self::$_instance;
    }
    public function __set($name, $value) {
        $this->$name = $value;
    }
    public function __get($name) {
        return $this->$name;
    }
    public function add($messages, $type = SELF::APP_MESSAGE_SUCCESS){
        if(!$this->existsMassenger()){
              $this->_session->messages = [];
        }
        $msg = $this->_session->messages;
        $msg[] = [$messages , $type];
        $this->_session->messages = $msg;
    }


    public function getMessages()
    {
        if($this->existsMassenger()) {
            $this->_messages = $this->_session->messages;
            unset($this->_session->messages);
            return $this->_messages;
        }
        return [];
    }
    public function existsMassenger(){
        return isset($this->_session->messages);
    }
}