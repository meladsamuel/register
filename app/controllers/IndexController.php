<?php

namespace shfretak\controllers;

use shfretak\lib\Dhru;
use shfretak\lib\validate;

class IndexController extends AbstractController
{
    use validate;
    public array $userTemplate = [
        'header' => TEMPLATE_PATH . 'header.php',
        'nav' => TEMPLATE_PATH . 'UserNav.php',
        'containerStart'  => TEMPLATE_PATH . 'viewBodyStart.php',
        ':view'           => 'actionView',
        'containerEnd'    => TEMPLATE_PATH . 'viewBodyEnd.php',
    ];

    public function defaultAction()
    {
//        phpinfo();
//        $api = new Dhru('imeibot.com/api_check.php' , '');
//        $result = $api->Params([
//            'key' =>'02ed16780f134622decf407f8e59143d',
//            'service' => 'all',
//            'show'=> 'yes'
//        ])->action(null, []);
//var_dump($result);
        $this->setLanguage('ar');
        $this->language->load('template\common');
        $this->language->load('template\user');
        $this->language->load('index\default');
        $this->_template->injectFooterResource('headers', JS . 'headers.js', 'main');
        $this->_template->injectHeaderResource('front', CSS . 'main.css', 'main');
        $this->_template->swapTemplate($this->userTemplate);
        $this->_data['title'] = 'hello';
        $this->_view();
    }
}

//          $this->session->u->user_balance = 20;
//            var_dump($this->session->currency_amount);
//            var_dump($this->session->u);


            // var_dump(json_decode($ar, true));
