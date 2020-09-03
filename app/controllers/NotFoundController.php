<?php
namespace shfretak\controllers;
class NotFoundController extends AbstractController{
      public function NotFoundAction(){
            $this->language->load('notFound\default');
            $this->language->load('template\common');
            $this->_view();
      }
}