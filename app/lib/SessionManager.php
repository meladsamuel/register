<?php
namespace shfretak\lib;

class SessionManager extends \SessionHandler{
      private $sessionName = 'shfretak';
      private $sessionMaxLifeTime = 0;
      private $sessionSSL = false; //TODO change to turn https have SSL
      private $sessionHTTPOnly = true;
      private $sessionPath = '/';
      private $sessionDomain = null; //TODO change to .shfretak.com
      private $sessionSavePath = SESSION_PATH;
      private $sessionCipherAlgo = 'AES-128-ECB';
      private $sessionCipherKey = 'WYCRYPT0K3Y@2016';
      private $sessionTTL = 1;

      public function __construct() {
            ini_set('session.use_cookies', 1);
            ini_set('session.use_only_cookies', 1);
            ini_set('session.use_trans_sid', 0);
            ini_set('session.save_handler', 'files');

            session_name($this->sessionName);
            session_save_path($this->sessionSavePath);
            session_set_cookie_params(
                  $this->sessionMaxLifeTime,
                  $this->sessionPath,
                  $this->sessionDomain,
                  $this->sessionSSL,
                  $this->sessionHTTPOnly
            );
            
      }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    /**
     * @param $name
     * @return bool|mixed
     */
    public function __get($name)
    {
        return $_SESSION[$name] !== false ? $_SESSION[$name] : false;
    }
    public function __isset($name)
    {
        return isset($_SESSION[$name]);
    }
    public function __unset($name)
    {
        unset($_SESSION[$name]);
    }
    public function start()
    {
        if(session_id() == '') {
            if(session_start()){
                $this->setSessionStartTime();
                $this->checkSessionValidity();
            }
        }
    }
      private function setSessionStartTime()
      {
          if(!isset($this->sessionStartTime)) {
              $this->sessionStartTime = time();
          }
          return true;
      } 
      public function checkSessionValidity()
      {
            if((time() - $this->sessionStartTime) > ($this->sessionTTL * 60) ) {
                  $this->renewSession();
                  $this->generateFingerPrint();
            }
      }
      public function renewSession()
      {
            $this->sessionStartTime = time();
            return session_regenerate_id(true);
      }

      public function write($session_id, $session_data) // TODO encryption not work
      {
            return parent::write($session_id, openssl_encrypt(
                  $session_data,
                  $this->sessionCipherAlgo,
                  $this->sessionCipherKey    
            ));
      } 
      public function read($session_id) // TODO decryption not work
      {
            return openssl_decrypt(
                  parent::read($session_id),
                  $this->sessionCipherAlgo,
                  $this->sessionCipherKey
            );
      }
      public function kill()
      {
            session_unset();
            setcookie(
                  $this->sessionName,
                  '',
                  time()-500,
                  $this->sessionPath,
                  $this->sessionDomain,
                  $this->sessionSSL,
                  $this->sessionHTTPOnly
            );
            session_destroy();
      }
      public function generateFingerPrint()
      {
            $userAgentId = $_SERVER['HTTP_USER_AGENT'];
            $this->cipherKey = openssl_random_pseudo_bytes(16);
            $sessionId = session_id();
            $this->fingerPrint = md5($userAgentId . $this->cipherKey . $sessionId);
      }
      public function isValidFingerPrint()
      {
          if(!isset($this->fingerPrint)) {
              $this->generateFingerPrint();
          }
          $fingerPrint = md5($_SERVER['HTTP_USER_AGENT'] . $this->cipherKey . session_id());
          if($fingerPrint === $this->fingerPrint) {
              return true;
          }
          return false;
      }
      public function dump(){
            return var_dump($_SESSION);
      }

}