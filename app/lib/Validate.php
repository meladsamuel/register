<?php
namespace app\lib;
trait validate {
    public array $regex = [
        'int' => '/^[0-9]+$/',
        'num' => '/^[0-9]+(?:\.[0-9]+)?$/',
        'imei' => '/^[0-9]{14}$/',
        'float' => '/^[0-9]+\.[0-9]+$/',
        'alpha' => '/^[A-Za-z\p{Arabic} ]+$/u',
        'alphanum' => '/^[0-9A-Za-z\p{Arabic} ]+$/u',
        'subUri' => '/^[0-9A-Za-z\-]+$/',
        'alphaNumO' => '/[0-9A-Za-z\p{Arabic} ]*/u',
        'vDate' => '/^[1-2][0-9][0-9][0-9]-(?:(?:0[0-9])|(?:1[0-2]))-(?:(?:0[1-9])|(?:(?:1|2)[0-9])|(?:3[0-1]))$/',
        'email' => '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
        'url' => '', //TODO make this regex you can download it from the internet
        'selector' => '/^[1-9][0-9]*$/',
        'checked' => '/^[0|1]*$/',
        'userName' => '/^[0-9A-Za-z@]+$/',

    ];

      public function int($value) {
            return (bool) preg_match($this->regex['int'], $value);
      }
      public function float($value) {
            return (bool) preg_match($this->regex['float'], $value);
      }
      public function num($value) {
            return (bool) preg_match($this->regex['num'], $value);
      }
      public function alpha($value) {
            return (bool) preg_match($this->regex['alpha'], $value);
      }
      public function alphanum($value) {
            return (bool) preg_match($this->regex['alphanum'], $value);
      }
      public function alphaNumO($value){
          return (bool) preg_match($this->regex['alphaNumO'], $value);
      }
      public function subUri($value){
          return (bool) preg_match($this->regex['subUri'], $value);
      }
      public function vDate($value) {
            return (bool) preg_match($this->regex['vDate'], $value);
      }
      public function username($value) {
            return (bool) preg_match($this->regex['userName'], $value);
      }
      public function email($value) {
            return (bool) preg_match($this->regex['email'], $value);
      }
      public function selector($value) {
            return (bool) preg_match($this->regex['selector'], $value);
      }
      public function checked($value) {
            return (bool) preg_match($this->regex['checked'], $value);
      }
      public function imei($values) {
          if(is_array($values)){
              foreach($values as $value ){
                  if(preg_match($this->regex['imei'], $value) == false) {
                      return false;
                  }
              }
              return true;
          }else {
              return false;
          }

      }
      public function req($value) {
            return $value !== '' || !empty($value);
      }
      public function max($value , $max) {
            if (is_string($value))
                  return mb_strlen($value) <= $max;
            elseif (is_numeric($value))
                  return $value <= $max;
            return false;
      }
      public function min($value , $min) {
            if (is_string($value))
                  return mb_strlen($value) >= $min;
            elseif (is_numeric($value))
                  return $value >= $min;
            return false;
      }
      public function equal($value, $equal){
          if (is_string($value))
              return mb_strlen($value) == $equal;
          elseif (is_numeric($value))
              return $value == $equal;
          return false;
      }
      public function isValid($roles, $input) {
            $errors = [];
            if(!empty($roles)){
                  foreach($roles as $fieldName => $validationRoles){
                        @$value = $input[$fieldName];
                        $validationRoles = explode('|', $validationRoles);
                        foreach($validationRoles as $validationRole){
                              if(array_key_exists($fieldName, $errors)) continue;
                              if(preg_match_all('/(min)\((\d+)\)/', $validationRole, $resulte)){
                                    if($this->min($value, $resulte[2][0]) === false) {
                                          $this->massenger->add(
                                                $this->language->feedKey('text_error_'.$resulte[1][0], [$this->language->get('text_form_'.$fieldName),$resulte[2][0]]),
                                                Massenger::APP_MESSAGE_ERROR
                                          );
                                          $errors[$fieldName] = true;
                                    }
                              }elseif(preg_match_all('/(max)\((\d+)\)/', $validationRole, $resulte)){
                                    if($this->max($value, $resulte[2][0]) === false) {
                                          $this->massenger->add(
                                                $this->language->feedKey('text_error_'.$resulte[1][0], [$this->language->get('text_form_'.$fieldName),$resulte[2][0]]),
                                                Massenger::APP_MESSAGE_ERROR
                                          );
                                          $errors[$fieldName] = true;
                                    }
                              }elseif(preg_match_all('/(equal)\((\d+)\)/', $validationRole, $resulte)){
                                    if($this->equal($value, $resulte[2][0]) === false) {
                                          $this->massenger->add(
                                                $this->language->feedKey('text_error_'.$resulte[1][0], [$this->language->get('text_form_'.$fieldName),$resulte[2][0]]),
                                                Massenger::APP_MESSAGE_ERROR
                                          );
                                          $errors[$fieldName] = true;
                                    }
                              }else{
                                    if($this->$validationRole($value) === false) {
                                          $this->massenger->add(
                                                $this->language->feedKey('text_error_'.$validationRole, [$this->language->get('text_form_'.$fieldName)]),
                                                Massenger::APP_MESSAGE_ERROR
                                          );
                                          $errors[$fieldName] = true;
                                    }            
                              }
                        }
                  }
            }
            return empty($errors)? true : false;
      }
}