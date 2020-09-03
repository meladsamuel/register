<?php

namespace shfretak\controllers;

use shfretak\lib\Back;
use shfretak\lib\FileUpload;
use shfretak\lib\Helper;
use shfretak\lib\InputFilter;
use shfretak\lib\Massenger;
use shfretak\lib\validate;
use shfretak\models\FileServiceModel;
use shfretak\models\FileServiceOrderModel;


class FileOrderController extends AbstractController
{
    use InputFilter;
    use Helper;
    use validate;
    use Back;
    private array $_ActionRoles = [
        'serviceCategories' => 'req|selector', //TODO this selector contain number from 1 to 99
        'note' => 'alphaNumO'
    ];

    public function defaultAction()
    {
        $this->language->load('FileService\form');
        $file = FileServiceModel::getAllService();
        $catService = [];
        foreach ($file as $value) {
            if ($value->file_service_title != null) {
                $catService[$value->file_service_cat_name][] = explode(',', $value->file_service_id);
                $catService[$value->file_service_cat_name][] = explode(',', $value->file_service_title);
            }
        }
        $this->_data['catService'] = $catService;

        $this->backHelper($this);
        $this->_template->injectHeaderResource('selector', CSS . 'selector.css', 'main');
        $this->_template->injectFooterResource('selector', JS . 'selector.js', 'main');
        $this->_view();
    }

    public function getServicesAction()
    {
        $this->language->load('FileService\form');

        $id = $this->filterInt($this->_params[0]);
        $service = FileServiceModel::getByPK($id);
        $this->_data['service'] = $service;
        $this->_template->swapTemplate([':view' => 'actionView']);
        $this->_view(true);
    }

    public function uploadAction()
    {
        $this->language->load('FileService\form');
        $this->language->load('fileOrder\messages');
        $hasError = 0;
        if (isset($_POST['serviceCategories']) && isset($_FILES['file'])  && $this->isValid($this->_ActionRoles, $_POST)) {
            $file = new FileUpload($_FILES['file']);
            $order = new FileServiceOrderModel();
            $order->file_order_user_id = $this->session->u->user_id;
            $order->file_order_service_id = $this->filterString($_POST['serviceCategories']);
            $order->file_order_note = $this->filterString($_POST['note']);
            $order->file_order_status = 0;
            $order->file_order_created_date = date('Y-m-d h:i:s');
            $service = FileServiceModel::getByPK($order->file_order_service_id);
            $order->receivedDate((int) $service->file_service_orders_received);
            $order->file_order_price = $service->file_service_price;
            try {
                $order->file_order_file_path = $file->upload()->getFileName();
            } catch (\Exception $e) {
                $hasError = 1;
                $this->massenger->add($this->language->get($e->getMessage()), Massenger::APP_MESSAGE_ERROR);
            }
            if (!$hasError && $order->save()) {
                $this->massenger->add($this->language->get('message_add_success'));
            } else {
                $hasError = 1;
                $this->massenger->add($this->language->get('message_add_failed'), Massenger::APP_MESSAGE_ERROR);
            }

        }
        echo $hasError;
        $this->_template->swapTemplate([':view' => 'actionView']);
        $this->backHelper($this);
    }


}
