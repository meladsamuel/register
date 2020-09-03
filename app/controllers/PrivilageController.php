<?php
namespace shfretak\controllers;

use shfretak\lib\Back;
use shfretak\lib\Helper;
use shfretak\lib\InputFilter;
use shfretak\models\PrivilageModel;

class PrivilageController extends AbstractController {
      use InputFilter;
      use Helper;
      use Back;
      public function defaultAction()
      {
            $this->language->load('template\common');
            $this->language->load('privilage\default');
            $this->_data['privilage'] = PrivilageModel::getAll();
            $this->backHelper($this);
            $this->_template->injectFooterResource('dataTable', JS.'dataTable.js', 'main');
            $this->_view();
      }
      public function addAction() {
            $this->language->load('template\common');
            $this->language->load('privilage\add');
            $privilage = new PrivilageModel;
            
            if(isset($_POST['submit'])){
                  $privilage->privilage_title = $this->filterString($_POST['privilageName']);
                  $privilage->privilage = $this->filterString($_POST['privilageLink']);
                  if($privilage->save()){
                        $this->redirect('/privilage');
                  }
            }
          $this->backHelper($this);
          $this->_view();
      }
      public function editAction() {
            $id = $this->filterInt($this->_params['0']);
            $privilage = PrivilageModel::getByPK($id);
            if($privilage == null) {
                  $this->redirect('/privilage');
            }
            $this->_data['privilage'] = $privilage;
            $this->language->load('template\common');
            $this->language->load('privilage\add');
            $privilage = new PrivilageModel;
            if(isset($_POST['submit'])){
                  $privilage->privilage_id = $id;
                  $privilage->privilage_title = $this->filterString($_POST['privilageName']);
                  $privilage->privilage = $this->filterString($_POST['privilageLink']);
                  if($privilage->save())
                        $this->redirect("/privilage/default");
            }
          $this->backHelper($this);
          $this->_view();
      }
      public function deleteAction() {
            $id = $this->filterInt($this->_params['0']);
            $privilage = PrivilageModel::getByPK($id);
            if($privilage == null)
                  $this->redirect('/privilage');
            if($privilage->delete())
                  $this->redirect("/privilage");
      }
}