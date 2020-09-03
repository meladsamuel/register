<?php

namespace shfretak\controllers;

use shfretak\lib\Helper;
use shfretak\lib\InputFilter;
use shfretak\lib\Massenger;
use shfretak\lib\validate;
use shfretak\models\FileCategoryModel;
use shfretak\models\FileServiceModel;
use shfretak\models\IMEICategoryModel;
use shfretak\models\IMEIServiceModel;
use shfretak\models\IMEIServiceTranslationModel;

class IMEIServiceController extends AbstractController
{
    use InputFilter;
    use Helper;
    use validate;
    private $_ActionRoles = [
        'serviceTitle_en' => 'req|alphaNumO|min(4)|max(100)',
        'serviceTitle_ar' => 'req|alphaNumO|min(4)|max(100)',
        'servicePrice' => 'req|float',
        'serviceCostPrice' => 'req|float',
        'serviceTimeVerify' => 'req|int',
        'deliveryTime_en' => 'req|alphanum|max(14)',
        'deliveryTime_ar' => 'req|alphanum|max(14)',
        'ServiceUrl' => 'req|subUri|max(255)',
        'serviceCategories' => 'req|selector',
        'serviceContent' => 'req',
        'verification' => 'checked',
        'return' => 'checked',
        'visibility' => 'checked' // TODO fix the warnig message if the users or hacker delete the input form  i'm fixed it by add @ we need better solution
    ];

    public function defaultAction()
    {
        $this->language->load('template\common');
        $this->language->load('FileService\default');
        $this->language->load('FileService\messages');
        $this->language->load('validations\errors');
        $this->_data['service'] = IMEIServiceModel::getAllService();
        $this->_template->injectFooterResource('commonBacks', JS . 'commonBacks.js', 'main');
        $this->_template->injectFooterResource('dataTable', JS . 'dataTable.js', 'commonBacks');
        $this->_view();
    }

    public function addAction()
    {
        $this->language->load('template\common');
        $this->language->load('IMEIService\add');
        $this->language->load('IMEIService\form');
        $this->language->load('IMEIService\messages');
        $this->language->load('validations\errors');
        $this->_data['categories'] = IMEICategoryModel::getAllOne();
        if (isset($_POST['submit']) && $this->isValid($this->_ActionRoles, $_POST)) {
            $service = new IMEIServiceModel();
            $service->imei_service_price = $this->filterFloat($_POST['servicePrice']);
            $service->imei_service_cost_price = $this->filterFloat($_POST['serviceCostPrice']);
            $service->imei_service_cat_id = $this->filterInt($_POST['serviceCategories']);
            $service->imei_service_time_to_verfiy = $this->filterInt($_POST['serviceTimeVerify']);
            $service->imei_service_orders_verification = $this->filterInt($_POST['verification']);
            $service->imei_service_url = $this->filterString($_POST['ServiceUrl']);
            $service->imei_service_visibility = $this->filterInt($_POST['visibility']);
            $service->imei_service_return = $this->filterString($_POST['return']);
            if ($service->save()) {
                $serviceTranslation = new IMEIServiceTranslationModel();
                foreach ($this->_webLan as $lang) {
                    $serviceTranslation->imei_service_id = $service->imei_service_id;
                    $serviceTranslation->imei_service_title = $this->filterString($_POST['serviceTitle_' . $lang]);
                    $serviceTranslation->imei_service_content = $this->filterString(htmlentities($_POST['serviceContent_' . $lang])); // TODO choise the correct crypt
                    $serviceTranslation->imei_service_delivery_time = $this->filterString($_POST['deliveryTime_' . $lang]);
                    $serviceTranslation->language_code = $lang;
                    if ($serviceTranslation->save(false)) $this->massenger->add($this->language->get('message_add_success'));
                    else $this->massenger->add($this->language->get('message_add_failed'), Massenger::APP_MESSAGE_ERROR);
                }
            } else {
                $this->massenger->add($this->language->get('messages_add_failed'), Massenger::APP_MESSAGE_ERROR);
            }
            $this->redirect('/IMEIService');
        }
        $this->_template->injectFooterResource('selector', JS . 'selector.js', 'main');
        $this->_template->injectFooterResource('ckeditor', '/ckeditor/ckeditor.js', 'main');
        $this->_view();
    }

    public function editAction()
    {
        $id = $this->filterInt($this->_params[0]);
        $id = FileServiceModel::getByPK($id);
        if ($id == null) $this->redirect("/IMEIService");

        $this->language->load('template\common');
        $this->language->load('FileService\edit');
        $this->language->load('FileService\form');
        $this->language->load('FileService\messages');
        $this->language->load('validations\errors');

        $this->_data['services'] = $id;
        $this->_data['categories'] = FileCategoryModel::getAll();

        $service = new IMEIServiceModel(); // TODO fix the imei service
        if (isset($_POST['submit']) && $this->isValid($this->_ActionRoles, $_POST)) {
            $service->imei_service_id = $id->file_service_id;
            $service->imei_service_title = $this->filterString($_POST['serviceTitle']);
            $service->imei_service_price = $this->filterFloat($_POST['servicePrice']);
            $service->imei_service_cost_price = $this->filterFloat($_POST['serviceCostPrice']);
            $service->imei_service_cat_id = $this->filterString($_POST['serviceCategories']);
            $service->imei_service_time_to_verfiy = $this->filterInt($_POST['serviceTimeVerify']);
            $service->imei_service_delivery_time = $this->filterString($_POST['deliveryTime']);
            $service->imei_service_content = $this->filterString(htmlentities($_POST['serviceContent'])); // TODO choise the correct crypt
            $service->imei_service_orders_verification = $this->filterInt($_POST['verification']);
            $service->imei_service_visibility = $this->filterInt($_POST['visibility']);
            $service->imei_service_return = $this->filterString($_POST['return']);

            if ($service->save()) {
                $this->massenger->add($this->language->get('message_edit_success'));
            } else {
                $this->massenger->add($this->language->get('messages_edit_failed'), Massenger::APP_MESSAGE_ERROR);
            }
            $this->redirect('/IMIEService');
        }
        $this->_template->injectFooterResource('selector', JS . 'selector.js', 'main');
        $this->_template->injectFooterResource('ckeditor', '/ckeditor/ckeditor.js', 'main');
        $this->_view();
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
        $this->language->load('template\common');
        $this->language->load('FileService\edit');
        $this->language->load('FileService\form');
        $this->language->load('FileService\messages');
        $this->language->load('validations\errors');
        $this->_template->swapTemplate([
            'header' => TEMPLATE_PATH . 'header.php',
            'nav' => TEMPLATE_PATH . 'U_sideBar.php',
            'containerStart' => TEMPLATE_PATH . 'viewBodyStart.php',
            'containerEnd' => TEMPLATE_PATH . 'viewBodyEnd.php',
        ]);
        $this->_view();
    }

    public function PlaceOrderAction()
    {
        $this->language->load('template\common');
        $this->language->load('FileService\edit');
        $this->language->load('FileService\form');
        $this->language->load('FileService\messages');
        $this->language->load('validations\errors');
        $this->_template->swapTemplate([
            'header' => TEMPLATE_PATH . 'header.php',
            'nav' => TEMPLATE_PATH . 'U_sideBar.php',
            'containerStart' => TEMPLATE_PATH . 'viewBodyStart.php',
            'containerEnd' => TEMPLATE_PATH . 'viewBodyEnd.php',
        ]);

        $this->_view();
    }

}
