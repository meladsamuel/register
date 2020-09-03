<?php
namespace shfretak\controllers;

use shfretak\lib\Helper;
use shfretak\lib\InputFilter;
use shfretak\lib\Massenger;
use shfretak\lib\validate;
use shfretak\models\CurrencyModel;
use shfretak\models\UsersModel;
use shfretak\models\UsersProfilesModel;

class ProfileController extends AbstractController {
      use InputFilter;
      use validate;
      use Helper;
      private $_AddActionRoles = [
            'firstName'  => 'req|alpha',
            'lastName'   => 'req|alpha',
            'phoneNumber'=> 'req|int',
            'currency'   => 'req|alpha|equal(3)'

      ];
      private $_ChangePasswordActionRoles = [
            'oldPassword'  => 'req',
            'newPassword'   => 'req',

      ];

      public function defaultAction()
      {
            $this->language->load('template\common');
            $this->language->load('profile\default');
            $this->language->load('users\messages');
            $this->_view();
      }
      public function changeAction() {
            $this->language->load('template\common');
            $this->language->load('profile\messages');
            $this->language->load('profile\form');
            $this->language->load('users\add');
            $this->language->load('validations\errors');
            $this->_data['user'] = $this->session->u;
            $this->_data['userProfile'] = $this->session->u->profile;
            $this->_data['currencies'] =  CurrencyModel::getAllOne();
            if(isset($_POST['submit']) && $this->isValid($this->_AddActionRoles, $_POST)){
                  $filterCurrency = $this->filterString($_POST['currency']);
                  $this->session->u->user_currency = $filterCurrency;
                  $changed = UsersModel::changeCurrency($this->session->u->user_id, $filterCurrency);
                  $userProfile = new UsersProfilesModel();
                  $userProfile->user_profile_id = $this->session->u->user_id;
                  $userProfile->user_profile_first_name = $this->session->u->profile->user_profile_first_name = $this->filterString($_POST['firstName']);
                  $userProfile->user_profile_last_name  = $this->session->u->profile->user_profile_last_name = $this->filterString($_POST['lastName']);
                  $userProfile->user_profile_phone_number = $this->session->u->profile->user_profile_phone_number =  $this->filterInt($_POST['phoneNumber']);
                  if($userProfile->save() && $changed)
                        $this->massenger->add($this->language->get('message_add_success'));
                  else 
                        $this->massenger->add($this->language->get('messages_add_failed'), Massenger::APP_MESSAGE_ERROR);
                  $this->redirect('/users');
            }
            $this->_template->injectFooterResource('selector', JS.'selector.js', 'main');
            $this->_view();
      }
      public function changePasswordAction() {
            $this->language->load('template\common');
            $this->language->load('profile\messages');
            $this->language->load('profile\form');
            $this->language->load('users\add');
            $this->language->load('validations\errors');
            if(isset($_POST['submit']) && $this->isValid($this->_ChangePasswordActionRoles, $_POST)){
                  $password =  crypt($_POST['oldPassword'], APP_SALT);
                  if($this->session->u->user_password == $password){
                        $user = new UsersModel();
                        $user = $this->session->u;
                        $user->cryptPassword($_POST['newPassword']);
                        if($user->save())
                              $this->massenger->add($this->language->get('message_add_success'));
                        else 
                              $this->massenger->add($this->language->get('messages_add_failed'), Massenger::APP_MESSAGE_ERROR);
                        $this->redirect('/profile');
                  }else {
                        $this->massenger->add($this->language->get('messages_add_failed'), Massenger::APP_MESSAGE_ERROR);
                  }
            }
            $this->_view();
      }

}