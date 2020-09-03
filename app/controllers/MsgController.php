<?php


namespace shfretak\controllers;


class MsgController extends AbstractController
{
    public function defaultAction() {
        $this->language->load('template/common');
        $this->_template->swapTemplate([':view' => 'actionView']);
        $this->_view(true);
    }
}