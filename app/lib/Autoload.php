<?php
namespace shfretak\lib;
use shfretak;
class Autoload {
      public static function autoloader(){
            spl_autoload_register(function($class){
                  $class = str_replace('shfretak', '', $class );
                  $class = APP_PATH . $class . '.php';
                  if(file_exists($class)) require $class;
            });
      }
}
Autoload::autoloader();