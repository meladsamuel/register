<?php


namespace shfretak\lib;


use shfretak\controllers\AbstractController;

trait Back
{
    public function backHelper(AbstractController $controller){
        $controller->language->load('template\common');
        $controller->language->load('validations\errors');
        $controller->_template->injectHeaderResource('back', CSS.'back.css', 'main');
        $controller->_template->injectFooterResource('back', JS.'commonBacks.js', 'main');
    }
}