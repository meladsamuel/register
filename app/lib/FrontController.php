<?php
namespace app\lib;

use app\lib\template\Template;


/**
 * @property Template $_template;
 * @property Registry $_registry;
 * @property Authentication $_authentication;;
 *
 */
class FrontController {
      use Helper;
      const CONTROLLER_NOT_FOUND = 'app\controllers\NotFoundController';
      const ACTION_NOT_FOUND = 'NotFoundAction';
      private $_controller = 'index';
      private $_action = 'default';
      private $_params;
      private $_template;
      private $_registry;
      private $_authentication;
      public function __construct(Template $template, Registry $registry, Authentication $auth){
            $this->_parse();
            $this->_template        = $template;
            $this->_registry        = $registry;
            $this->_authentication  = $auth;
      }
      private function _parse(){
            $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $url = str_replace('/app', '',$url);
            $url = explode('/' , trim($url, '/'), 3);
            if(isset($url[0]) && $url[0] !='') $this->_controller = $url[0];
            if(isset($url[1]) && $url[1] !='') $this->_action = $url[1];
            if(isset($url[2]) && $url[2] !='') $this->_params = explode('/' , $url[2]);
      }
      public function dispatch(){
            $className = 'app\\controllers\\'. ucfirst($this->_controller) . 'Controller';
            $actionName = $this->_action . 'Action'; 

            if(!$this->_authentication->isAuthorized($this->_controller . '/' . $this->_action)){
                  $className = 'app\controllers\AuthController';
                  $actionName = 'loginAction'; 
                  $this->_controller = 'Auth';
                  $this->_action = 'login'; 
            }else{
                  if($this->_controller == 'auth' && $this->_action == 'login'){
                        $this->redirect('/');
                  }
                  if(!$this->_authentication->hasAccess($this->_controller, $this->_action)){
                        $this->_controller = 'app\controllers\NotFoundController';
                        $this->_action = 'NotFoundAction';
                  }
            }
            if(!class_exists($className) || !method_exists($className, $actionName)){
                  $className =  SELF::CONTROLLER_NOT_FOUND;
                  $this->_action = $actionName = SELF::ACTION_NOT_FOUND;
            }
            $controller = new $className();
            $controller->setController($this->_controller, $this->_action, $this->_params);
            $controller->setTemplate($this->_template);
            $controller->setRegistry($this->_registry);
            $controller->$actionName();
      }
}
