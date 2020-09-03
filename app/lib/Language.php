<?php
namespace shfretak\lib;
class Language  {
      private $_dictionary = [];
      public function load($path){
            $languageToLoad = LANGUAGE_PATH . $_SESSION['lang'] . DS . $path . '.lang.php';
            if (file_exists($languageToLoad)) {
                  require $languageToLoad;
                  foreach($_ as $textLabel => $textValue){
                        $this->_dictionary[$textLabel] = $textValue;
                  }
            } 
      }
      public function getDictionary(){
            return $this->_dictionary;
      }
      public function get($key) {
            if (array_key_exists($key, $this->_dictionary))
                  return $this->_dictionary[$key];
      }
      public function feedKey($key , $data) {
            if (array_key_exists($key, $this->_dictionary)){
                  array_unshift($data, $this->_dictionary[$key]);
                  return call_user_func_array('sprintf', $data);
            }
      }
}