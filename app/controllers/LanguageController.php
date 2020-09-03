<?php
namespace shfretak\controllers;

use shfretak\lib\Helper;

class LanguageController extends AbstractController {
      use Helper;
      public function defaultAction(){
            if(isset($_SESSION['lang']) && isset($_SERVER['HTTP_REFERER'])){
                  $_SESSION['lang'] = ($_SESSION['lang'] == 'ar')? 'en' : 'ar';
                  setcookie('_lang',$_SESSION['lang']);
                  $this->redirect($_SERVER['HTTP_REFERER']);
            }else {
                  $this->redirect('/');
            }
      }
}