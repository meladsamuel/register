<?php


namespace shfretak\controllers;


use shfretak\lib\Back;
use shfretak\lib\FileDownload;
use shfretak\lib\Helper;
use shfretak\lib\InputFilter;
use shfretak\lib\Massenger;
use shfretak\lib\validate;
use shfretak\models\FileServiceModel;
use shfretak\models\FileServiceOrderModel;
use shfretak\models\IMEIOrderModel;
use shfretak\models\IMEIServiceModel;
use shfretak\models\IMEIServiceOrderModel;
use shfretak\models\UsersModel;


class InvoicesOrderController extends AbstractController
{

    use Helper;
    use InputFilter;
    use validate;
    use Back;

//    public function defaultAction() {
//        $this->language->load('Invoices/default');
//        $orders = IMEIServiceOrderModel::getAll();
//        $this->_data['orders'] = $orders;
//        $this->backHelper($this);
//        $this->_template->injectFooterResource('dataTable', JS.'dataTable.js', 'main');
//        $this->_view();
//    }
    public function IMEIAction()
    {
        $this->language->load('Invoices/default');
        $this->_data['orders'] = IMEIServiceOrderModel::getAll();
        $this->backHelper($this);
        $this->_template->injectFooterResource('dataTable', JS . 'dataTable.js', 'main');
        $this->_view();
    }

    public function FileAction()
    {
        $this->language->load('Invoices/default');
        $this->_data['orders'] = FileServiceOrderModel::getAll();
        $this->backHelper($this);
        $this->_template->injectFooterResource('dataTable', JS . 'dataTable.js', 'main');
        $this->_view();
    }

    public function showAction()
    {
        if (!isset($this->_params[0]) || !isset($_POST['body'])) $this->redirect('/invoicesOrder');
        $type = $this->filterString($this->_params[0]);
        $orderId = $this->filterInt($_POST['body']);

        if ($type == 'IMEI') {
            $order = IMEIServiceOrderModel::getByPK($orderId);
            if ($order !== false) {
                $user = UsersModel::getByPK($order->imei_order_user_id);
                $service = IMEIServiceModel::getByPKOne($order->imei_order_service_id);
                $imei = IMEIOrderModel::getBy(['imei_order_id' => $order->imei_order_id]);
                $this->_data['order'] = $order;
                $this->_data['user'] = $user;
                $this->_data['service'] = $service;
                $this->_data['imei'] = $imei;
            }
        } elseif ($type == 'File') {
            $order = FileServiceOrderModel::getByPK($orderId);
            if ($order !== false) {
                $user = UsersModel::getByPK($order->file_order_user_id);
                $service = FileServiceModel::getByPKOne($order->file_order_service_id);
                $this->_data['order'] = $order;
                $this->_data['user'] = $user;
                $this->_data['service'] = $service;
            }
        }
        $this->_data['type'] = $type;
        $this->language->load('invoices/default');
        $this->_template->swapTemplate([':view' => 'actionView']);
        $this->_view(true);
    }

    public function statusAction()
    {
        if (!isset($this->_params[0]) || ($this->_params[0] != 'File' && $this->_params[0] != 'IMEI') || isset($_POST['status']) == false || isset($_POST['body']) == false)
            $this->redirect('/invoicesOrder');
        $Model = $this->filterString($this->_params[0]);
        $status = $this->filterInt($_POST['status']);
        if ($Model == 'File') {
            $order = FileServiceOrderModel::getByPK($this->filterInt($_POST['body']));
            if ($order) {
                if ($status == 1)
                    $order->file_order_status = 1; // the order in process
                elseif ($status == 3)
                    $order->file_order_status = 3; // success order
                elseif ($status == 4) // TODO reject the order and must return the money to the client
                    $order->file_order_status = 4; // reject the order
                elseif ($status == 5)
                    $order->file_order_status = 5; // the order is failed and money not return to the client
                $response = $this->filterString($_POST['response']);
                if (isset($_POST['response']) && $response !== '')
                    $order->file_order_return_code = $response;
                $order->save();
            }
        } else {
            $order = IMEIServiceOrderModel::getByPK($this->filterInt($_POST['body']));
            if ($order) {
                if ($status == 1)
                    $order->imei_order_status = 1; // the order in process
                elseif ($status == 3)
                    $order->imei_order_status = 3; // success order
                elseif ($status == 4) // TODO reject the order and must return the money to the client
                    $order->imei_order_status = 4; // reject the order
                elseif ($status == 5)
                    $order->imei_order_status = 5; // the order is failed and money not return to the client
                $order->save();
            }
        }
        $this->_data['order'] = $order;
        $this->_data['service'] = $Model;

        $this->language->load('invoices/default');
        $this->_template->swapTemplate([':view' => 'actionView']);
        $this->_view(true);

    }

    public function returnAction()
    {
        if (isset($_POST['submit']) && $this->isValid($this->_returnRole, $_POST)) {
            $order = IMEIServiceOrderModel::getByPK($this->filterInt($_POST['id']));
            $order->imei_order_return_code = $this->filterString($_POST['response']);
            $order->imei_order_status = 4;
            if ($order->save()) {
                $this->redirect('/invoicesOrder/show/' . $order->imei_order_id);
            } else {
                $this->massenger->add('their is error in code that you enter', Massenger::APP_MESSAGE_ERROR);
                $this->redirect('/');
            }
        }
        $this->redirect('/invoicesOrder/default/');
    }

    public function DownloadAction()
    {
        $download = new FileDownload($this->_params[0], IMAGES_UPLOAD_PATH);
    }
}


//background-color: #4CAF50;
//    color: white;
//    padding: 3px 7px;
//    border-radius: 4px;
//    font-size: 0.8rem;
//    display: inline-block;
//    cursor: pointer;