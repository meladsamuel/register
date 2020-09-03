<?php
namespace shfretak\lib;

/**
 * @property Language $language
 * @property Massenger $massenger
 * @property SessionManager $session
 */
class Registry {
    /**
     * @var Language
     */
    public $language;
    /**
     * @var Massenger
     */
    public $massenger;
    /**
     * @var SessionManager
     */
    public $session;

    private static $_instance;

    public function __construct(){}
    public function __clone(){}

    public static function getInstance () {
        if(self::$_instance === null){
              self::$_instance = new self();
        }
        return self::$_instance;
    }
    public function __set($name, $value) {
        $this->$name = $value;
    }
    public function __get($name) {
        return $this->$name;
    }
}