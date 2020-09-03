<?php

namespace shfretak\controllers;

use shfretak\lib\Back;
use shfretak\lib\Helper;
use shfretak\lib\InputFilter;
use shfretak\lib\Massenger;
use shfretak\lib\validate;
use shfretak\models\FileCategoryModel;
use shfretak\models\FileServiceModel;
use shfretak\models\FileServiceTranslationModel;

class FileServiceController extends AbstractController
{
    use InputFilter;
    use Helper;
    use validate;
    use Back;
    private array $_ActionRoles = [
        'serviceTitle_en' => 'req|alpha|min(4)|max(100)',
        'serviceTitle_ar' => 'req|alpha|min(4)|max(100)',
        'servicePrice' => 'req|float',
        'serviceCostPrice' => 'req|float',
        'serviceReceivedTime' => 'req|int',
        'deliveryTime_en' => 'req|alphanum|max(40)',
        'deliveryTime_ar' => 'req|alphanum|max(40)',
        'serviceCategories' => 'req|selector',
        'serviceContent_en' => 'req',
        'serviceContent_ar' => 'req',
        'ServiceUrl' => 'req|subUri',
        'verification' => 'checked',
        'visibility' => 'checked' // TODO fix the warnig message if the users or hacker delete the input form  i'm fixed it by add @ we need better solution
    ];
    private array $_EditActionRoles = [
        'serviceTitle' => 'req|alpha|min(4)|max(100)',
        'servicePrice' => 'req|float',
        'serviceCostPrice' => 'req|float',
        'serviceReceivedTime' => 'req|int',
        'deliveryTime' => 'req|alphanum|max(40)',
        'serviceCategories' => 'req|selector',
        'serviceContent' => 'req',
        'verification' => 'checked',
        'visibility' => 'checked' // T
    ];

    public function defaultAction()
    {
        $this->language->load('FileService\default');
        $this->language->load('FileService\messages');
        $this->_data['service'] = FileServiceModel::getAllService();
        $this->_template->injectFooterResource('dataTable', JS . 'dataTable.js', 'main');
        $this->backHelper($this);
    }

    public function addAction()
    {
        $this->language->load('FileService\add');
        $this->language->load('FileService\form');
        $this->language->load('FileService\messages');
        $this->_data['categories'] = FileCategoryModel::getAllOne();
        if (isset($_POST['submit']) && $this->isValid($this->_ActionRoles, $_POST)) {
            $service = new FileServiceModel();
            $service->file_service_price = $this->filterFloat($_POST['servicePrice']);
            $service->file_service_cost_price = $this->filterFloat($_POST['serviceCostPrice']);
            $service->file_service_cat_id = $this->filterString($_POST['serviceCategories']);
            $service->file_service_orders_received = $this->filterInt($_POST['serviceReceivedTime']);
            $service->file_service_orders_verification = $this->filterInt($_POST['verification']);
            $service->file_service_visibility = $this->filterInt($_POST['visibility']);
            $service->file_service_url = $this->filterString($_POST['serviceUrl']);
            if ($service->save()) {
                $serviceTranslation = new FileServiceTranslationModel();
                foreach ($this->_webLan as $lang) {
                    $serviceTranslation->file_service_id = $service->file_service_id;
                    $serviceTranslation->language_code = $lang;
                    $serviceTranslation->file_service_title = $this->filterString($_POST['serviceTitle_' . $lang]);
                    $serviceTranslation->file_service_content = htmlentities($_POST['serviceContent_' . $lang]);
                    $serviceTranslation->file_service_delivery_time = $this->filterString($_POST['deliveryTime_' . $lang]);

                    if ($serviceTranslation->save(false)) $this->massenger->add($this->language->get('message_add_success'));
                    else $this->massenger->add($this->language->get('message_add_failed'), Massenger::APP_MESSAGE_ERROR);
                }
            } else {
                $this->massenger->add($this->language->get('messages_add_failed'), Massenger::APP_MESSAGE_ERROR);
            }
            $this->redirect('/FileService');
        }
        $this->_template->injectFooterResource('selector', JS . 'selector.js', 'main');
        $this->_template->injectFooterResource('ckeditor', '/ckeditor/ckeditor.js', 'main');
        $this->backHelper($this);
    }

    public function editAction()
    {
        $id = $this->filterInt($this->_params[0]);
        $id = FileServiceModel::getByPKOne($id);
        if ($id == null) $this->redirect("/FileService");

        $this->language->load('FileService\edit');
        $this->language->load('FileService\form');
        $this->language->load('FileService\messages');

        $this->_data['services'] = $id;
        $this->_data['categories'] = FileCategoryModel::getAllOne();
        if (isset($_POST['submit']) && $this->isValid($this->_EditActionRoles, $_POST)) {
            $service = new FileServiceModel();
            $service->file_service_id = $id->file_service_id;
            $service->file_service_cat_id = $this->filterString($_POST['serviceCategories']);
            $service->file_service_price = $this->filterFloat($_POST['servicePrice']);
            $service->file_service_cost_price = $this->filterFloat($_POST['serviceCostPrice']);
            $service->file_service_orders_received = $this->filterInt($_POST['serviceReceivedTime']);
            $service->file_service_orders_verification = $this->filterInt($_POST['verification']);
            $service->file_service_visibility = $this->filterInt($_POST['visibility']);
            $service->file_service_url = $this->filterString($_POST['serviceUri']);
            if ($service->save()) {
                $serviceTranslation = new FileServiceTranslationModel();
                $serviceTranslation->translation_id = $id->translation_id;
                $serviceTranslation->file_service_id = $id->file_service_id;
                $serviceTranslation->file_service_title = $this->filterString($_POST['serviceTitle']);
                $serviceTranslation->file_service_content = htmlentities($_POST['serviceContent']);
                $serviceTranslation->file_service_delivery_time = $this->filterString($_POST['deliveryTime']);
                $serviceTranslation->language_code = $this->session->lang;
                if ($serviceTranslation->save()) $this->massenger->add($this->language->get('message_add_success'));
                else $this->massenger->add($this->language->get('message_add_failed'), Massenger::APP_MESSAGE_ERROR);
            } else {
                $this->massenger->add($this->language->get('messages_edit_failed'), Massenger::APP_MESSAGE_ERROR);
            }
            $this->redirect('/FileService');
        }
        $this->_template->injectFooterResource('selector', JS . 'selector.js', 'main');
        $this->_template->injectFooterResource('ckeditor', '/ckeditor/ckeditor.js', 'main');
        $this->backHelper($this);
    }

    public function deleteAction()
    {
        $id = $this->filterInt($this->_params[0]);
        $id = FileServiceModel::getByPK($id);
        if ($id == null) $this->redirect("/FileService");
        $this->language->load('FileService\messages');
        if ($id->delete()) {
            $this->massenger->add($this->language->get('message_delete_success'));
        } else {
            $this->massenger->add($this->language->get('messages_delete_failed'), Massenger::APP_MESSAGE_ERROR);
        }
        $this->redirect('/FileService');
    }

    public function viewAction()
    {
        $this->language->load('FileService\edit');
        $this->language->load('FileService\form');
        $this->language->load('FileService\messages');
        $this->_template->swapTemplate([
            'header' => TEMPLATE_PATH . 'header.php',
            'nav' => TEMPLATE_PATH . 'U_sideBar.php',
            'containerStart' => TEMPLATE_PATH . 'viewBodyStart.php',
            ':view' => 'actionView',
            'containerEnd' => TEMPLATE_PATH . 'viewBodyEnd.php',
        ]);
        $this->_data['category'] = FileCategoryModel::getAllOne();
        $this->backHelper($this);
    }

    public function getCategoryAction()
    { // TODO move to api controlller
        if (isset($_POST['category']) && !empty($_POST['category'])) {
            header('Content-type: text/plain');
            if ($cat = FileCategoryModel::getby(['file_service_cat_name' => $this->filterString($_POST['category'])])) {
                $fileServices = FileServiceModel::getby(['file_service_cat_id' => $cat->current()->file_service_cat_id]);
                $extractData = [];
                if ($fileServices != false) {
                    foreach ($fileServices as $privilage) {
                        $extractData['title'][] = $privilage->file_service_title;
                        $extractData['price'][] = $privilage->file_service_price;
                        $extractData['time'][] = $privilage->file_service_delivery_time;
                    }
                }
                $extractData = json_encode($extractData);
                echo $extractData;
            }
        }
    }
}
