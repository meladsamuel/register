<?php
namespace shfretak\controllers;

use shfretak\lib\Helper;
use shfretak\lib\Massenger;
use shfretak\models\UsersModel;

class AuthController extends AbstractController {
      use Helper;
      public function loginAction(){

            $this->_template->swapTemplate([
                  ":view" => "actionView"
            ]);
            $this->language->load('auth/login');
            if(isset($_POST['login'])) {
                  $isAuthorized = UsersModel::authenticate($_POST['userName'], $_POST['password'], $this->session);
                  if($isAuthorized === false) {
                        $this->massenger->add($this->language->get('message_not_found_user'), Massenger::APP_MESSAGE_ERROR);
                  }elseif($isAuthorized == 1){
                        $this->redirect($_SERVER['HTTP_REFERER']);
                  }elseif($isAuthorized == 2){
                        $this->massenger->add($this->language->get('message_block_user'), Massenger::APP_MESSAGE_ERROR);
                  }
            }
            $this->_view();
      }
      public function logoutAction(){
            $this->session->kill();
            $this->redirect('/auth/login');
      }
}