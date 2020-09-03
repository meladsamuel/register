<?php

namespace shfretak\controllers;

use shfretak\lib\Helper;
use shfretak\lib\InputFilter;
use shfretak\lib\validate;
use shfretak\models\IMEIOrderModel;
use shfretak\models\IMEIServiceModel;
use shfretak\models\IMEIServiceOrderModel;

class IMEIOrderController extends AbstractController
{
    use InputFilter;
    use Helper;
    use validate;
    private $_ActionRoles = [
        'IMEI' => 'imei',
        'note' => 'alphaNumO',
    ];


    public function defaultAction(){

        $this->language->load('template\common');
        $this->language->load('IMEIOrder\form');
        $this->language->load('validations\errors');

        $imei = IMEIServiceModel::getAlls();
        $catService = [];
        foreach ($imei as $value) {
            if($value->imei_service_title != null) {
                $catService[$value->imei_service_cat_name][] = explode(',' , $value->imei_service_id);
                $catService[$value->imei_service_cat_name][] = explode(',' , $value->imei_service_title);
            }
        }
//        var_dump($imei);
        $this->_data['catService'] = $catService;

        if(isset($_POST['makeOrder']) && $this->isValid($this->_ActionRoles, $_POST)) {
            $IMEI_order = new IMEIOrderModel();
            $order = new IMEIServiceOrderModel();

            $order->imei_order_user_id      = $this->session->u->user_id;
            $order->imei_order_service_id   = $this->filterString($_POST['service']);
            $order->imei_order_note         = $this->filterString($_POST['note']);
            $order->imei_order_status       = 0;
            $order->imei_order_created_date = date('Y-m-d h:i:s');
            $service = IMEIServiceModel::getByPK($order->imei_order_service_id);
            if($service->imei_service_return == 1)
                $order->imei_order_status = 3;
            $imeiNumber  =(int) count($_POST['IMEI']);
            $order->orderPrice($service->imei_service_price, $imeiNumber);
            if($order->save()){
                foreach($_POST['IMEI'] as $imei_code) {
                    $IMEI_order->imei_order_id = $order->imei_order_id;  // enter the id of the order
                    $imei_code = (string)  $imei_code;
                    $imei_code .=  $IMEI_order->imei_check_number($imei_code);
                    $IMEI_order->imei_order = $imei_code; // enter the imei for the order wit id for the order
                    if($IMEI_order->save(false)) {
                        $this->massenger->add('the order is make successfully');
                    }
                }

            }
        }

        $this->_template->injectFooterResource('selector', JS.'selector.js', 'main');
        $this->_template->injectFooterResource('ajaxSelector', JS.'ajaxSelector.js', 'selector');
        $this->_view();
    }


    public function getServicesAction(){
        $this->language->load('FileService\form');
        $id = $this->filterInt($this->_params[0]);
        $service = IMEIServiceModel::getByPK($id);
        $this->_data['service'] = $service;
        $this->_template->swapTemplate([':view' => 'actionView']);
        $this->_view(true);
    }




}
