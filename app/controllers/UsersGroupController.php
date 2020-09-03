<?php
namespace shfretak\controllers;

use shfretak\lib\Back;
use shfretak\lib\Helper;
use shfretak\lib\InputFilter;
use shfretak\models\GroupPrivilageModel;
use shfretak\models\PrivilageModel;
use shfretak\models\UsersGroupModel;

class UsersGroupController extends AbstractController {
      use InputFilter;
      use Helper;
      use Back;
      public function defaultAction()
      {
            $this->language->load('template\common');
            $this->language->load('usersGroup\default');
            $this->_data['usersGroup'] = UsersGroupModel::getAll();
            $this->_template->injectFooterResource('dataTable', JS.'dataTable.js', 'main');
            $this->backHelper($this);
            $this->_view();
      }
      public function addAction() {
            $this->language->load('template\common');
            $this->_data['privilage'] = PrivilageModel::getAll();
            if(isset($_POST['submit'])){ // TODO make validation for users groups arrary
                  $usersGroup = new UsersGroupModel();
                  $usersGroup->group_name = $this->filterString($_POST['groupName']);
                  if($usersGroup->save()){
                        if(isset($_POST['privilages']) && is_array($_POST['privilages'])){
                              foreach($_POST['privilages'] as $privilage){
                                    $groupPrivilage = new GroupPrivilageModel();
                                    $groupPrivilage->group_id = $usersGroup->group_id;
                                    $groupPrivilage->privilage_id = $privilage;
                                    $groupPrivilage->save();
                              }
                        }
                        $this->redirect('/usersGroup');
                  }
            }
            $this->backHelper($this);
            $this->_view();
      }
      public function editAction() {
            $id = $this->filterInt($this->_params['0']);
            $usersGroup = UsersGroupModel::getByPK($id);
            if($usersGroup === null) $this->redirect('/privilage');
            
            $this->language->load('template\common');
            $this->_data['usersGroup'] = $usersGroup;
            $this->_data['privilage'] = PrivilageModel::getAll();

            $groupPrivilages = GroupPrivilageModel::getby(['group_id' => $usersGroup->group_id]);
            $extractPrivilageId = [];
            if($groupPrivilages != false)
            foreach($groupPrivilages as $privilage)
                  $extractPrivilageId[] = $privilage->privilage_id;
            
            $this->_data['groupPrivilages'] = $extractPrivilageId;
            if(isset($_POST['submit'])){  
                  $usersGroup->group_name = $this->filterString($_POST['groupName']);
                  if($usersGroup->save()){
                        if(isset($_POST['privilages']) && is_array($_POST['privilages'])){
                              $privilageToBeAdd = array_diff($_POST['privilages'],$extractPrivilageId);
                              $privilageToBeDeleted = array_diff($extractPrivilageId, $_POST['privilages']);
      
                              foreach ($privilageToBeDeleted as $deletedPrivilege) {
                                    $unWantedPrivilege = GroupPrivilageModel::getby(['privilage_id' => $deletedPrivilege, 'group_id' => $usersGroup->group_id]);
                                    $unWantedPrivilege->current()->delete();
                              }

                              foreach($privilageToBeAdd as $privilage){
                                    $groupPrivilage = new GroupPrivilageModel();
                                    $groupPrivilage->group_id = $usersGroup->group_id;
                                    $groupPrivilage->privilage_id = $privilage;
                                    $groupPrivilage->save();
                              }
                        }
                        $this->redirect('/usersGroup');
                  }
            }
            $this->backHelper($this);
            $this->_view();
      }
      public function deleteAction() {
            $id = $this->filterInt($this->_params['0']);
            $usersGroup = UsersGroupModel::getByPK($id);
            if($usersGroup === null) $this->redirect('/privilage');

            $groupPrivilages = GroupPrivilageModel::getby(['group_id' => $usersGroup->group_id]);
            
            if($groupPrivilages != false){
                  foreach ($groupPrivilages as $privilage) {
                        $privilage->delete();
                  }
            }
            if($usersGroup->delete()){
                  $this->redirect('/usersGroup');
            }

      }

}