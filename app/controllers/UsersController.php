<?php
namespace shfretak\controllers;

use shfretak\lib\Helper;
use shfretak\lib\InputFilter;
use shfretak\lib\Massenger;
use shfretak\lib\validate;
use shfretak\models\UsersGroupModel;
use shfretak\models\UsersModel;
use shfretak\models\UsersProfilesModel;

class UsersController extends AbstractController {
      use InputFilter;
      use validate;
      use Helper;
      private $_AddActionRoles = [
            'userName'   => 'req|userName|min(4)|max(14)',
            'email'      => 'req|email',
            'password'   => 'req',
            'firstName'  => 'req|alpha',
            'lastName'   => 'req|alpha',
            'phoneNumber'=> 'req|int'

      ];
      private $_EditActionRoles = [
            'usersGroup'=> 'req|selector'
      ];

      public function defaultAction()
      {
            $this->language->load('template\common');
            $this->language->load('users\default');
            $this->language->load('users\messages');

            $this->_data['users'] = UsersModel::getUsers($this->session->u->user_id);
            $this->_template->injectFooterResource('dataTable', JS.'dataTable.js', 'main');
            $this->_view();
      }
      public function addAction() {
            $this->language->load('template\common');
            $this->language->load('users\messages');
            $this->language->load('users\form');
            $this->language->load('users\add');
            $this->language->load('validations\errors');
            $this->_data['usersGroup'] = UsersGroupModel::getAll();
            if(isset($_POST['submit']) && $this->isValid($this->_AddActionRoles, $_POST)){

                  $user = new UsersModel();
                  $user->user_name        = $this->filterString($_POST['userName']);
                  $user->user_email       = $this->filterString($_POST['email']);
                  $user->cryptPassword($_POST['password']);
                  $user->user_group_id    = $this->filterInt($_POST['usersGroup']);
                  $user->user_reg_stat    = 0;
                  $user->user_reg_date    = date('Y-m-d');
                  $user->user_last_login  = date('Y-m-d H:i:s');
                  if(UsersModel::userExisting($user->user_name)) {
                      $this->massenger->add($this->language->get('message_add_success'), Massenger::APP_MESSAGE_ERROR);
                      $this->redirect('/users');
                  }

                  if($user->save()){
                        $userProfile = new UsersProfilesModel();
                        $userProfile->user_profile_id = $user->user_id;
                        $userProfile->user_profile_first_name = $this->filterString($_POST['firstName']);
                        $userProfile->user_profile_last_name  = $this->filterString($_POST['lastName']);
                        $userProfile->user_profile_phone_number = $this->filterInt($_POST['phoneNumber']);
                        $userProfile->save(false);
                        $this->massenger->add($this->language->get('message_add_success'));
                  }else {
                        $this->massenger->add($this->language->get('messages_add_failed'), Massenger::APP_MESSAGE_ERROR);
                  }
                  $this->redirect('/users');
            }
            $this->_view();
      }
      public function editAction() {
            $id = $this->filterInt($this->_params[0]);
            $user = UsersModel::getByPK($id);
            if($user == false || $user->user_id == $this->session->u->user_id) $this->redirect('/users');

            $this->language->load('template\common');
            $this->language->load('users\messages');
            $this->language->load('users\form');
            $this->language->load('users\edit');
            $this->language->load('validations\errors');
            $this->_data['user'] = $user;
            $this->_data['userProfile'] = UsersProfilesModel::getByPK($id);
            $this->_data['usersGroup'] = UsersGroupModel::getAll();
            if(isset($_POST['submit']) && $this->isValid($this->_EditActionRoles, $_POST)){
                  $user->user_group_id    = $this->filterInt($_POST['usersGroup']);
                  if($user->save()){
                        $this->massenger->add($this->language->get('message_edit_success'));
                  }else {
                        $this->massenger->add($this->language->get('message_edit_failed'), Massenger::APP_MESSAGE_ERROR);
                  }
                  $this->redirect('/users');
            }
            $this->_view();
      }
      public function deleteAction() {
            $id = $this->filterInt($this->_params[0]);
            $user = UsersModel::getByPK($id);
            if($user == null || $user->user_id == $this->session->u->user_id) $this->redirect('/users');
            $this->language->load('users\messages');
            if($user->delete()){
                  $this->massenger->add($this->language->get('message_delete_success'));
            }else {
                  $this->massenger->add($this->language->get('message_delete_failed'), Massenger::APP_MESSAGE_ERROR);
            }
            $this->redirect('/users');

      }
      public function cheackUserAction(){
            if(isset($_POST['userName']) && !empty($_POST['userName'])){
                  header('Content-type: text/plain');
                  if(UsersModel::userExits($this->filterString($_POST['userName']))){
                        echo 'exits';
                  }else{
                        echo 'notExits';
                  }
            }
      }



}