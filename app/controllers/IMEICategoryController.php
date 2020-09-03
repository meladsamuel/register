<?php

namespace shfretak\controllers;

use shfretak\lib\Helper;
use shfretak\lib\InputFilter;
use shfretak\lib\Massenger;
use shfretak\lib\validate;
use shfretak\models\IMEICategoryModel;
use shfretak\models\IMEICategoryTranslationModel;
use shfretak\models\IMEIServiceModel;

class IMEICategoryController extends AbstractController
{
    use InputFilter;
    use Helper;
    use validate;
    private $_AddActionRoles = [
        'categoryName_en'           => 'req|alpha|min(4)|max(40)',
        'categoryName_ar'           => 'req|alpha|min(4)|max(40)',
        'categoryDescription_en'    => 'req|alphanum',
        'categoryDescription_ar'    => 'req|alphanum',
        'categoryOrdering'          => 'req|int',
        'visibility'                => 'checked' // TODO fix the warnig message if the users or hacker delete the input form  i'm fixed it by add @ we need better solution
    ];

    public function defaultAction()
    {
        $this->language->load('template\common');
        $this->language->load('FileCategory\default');
        $this->language->load('FileCategory\add');
        $this->_data['category'] = IMEICategoryModel::getAllOne();
        $this->_template->injectFooterResource('dataTable', JS . 'dataTable.js', 'main');
        $this->_view();
    }

    public function addAction()
    {
        $this->language->load('template\common');
        $this->language->load('FileCategory\add');
        $this->language->load('FileCategory\form');
        $this->language->load('FileCategory\messages');
        $this->language->load('validations\errors');
        if (isset($_POST['submit']) && $this->isValid($this->_AddActionRoles, $_POST)) {
            $cat = new IMEICategoryModel();
            $cat->imei_service_cat_ordering = $this->filterInt($_POST['categoryOrdering']);
            $cat->imei_service_cat_visibility = $this->filterInt($_POST['visibility']);
            var_dump($cat);
            if ($cat->save()) {
                $catTranslation = new IMEICategoryTranslationModel();
                foreach ($this->_webLan as $lang) {
                    $catTranslation->imei_service_cat_id            = $cat->imei_service_cat_id;
                    $catTranslation->language_code                  = $lang;
                    $catTranslation->imei_service_cat_name          = $this->filterString($_POST['categoryName_'.$lang]);
                    $catTranslation->imei_service_cat_description   = $this->filterString($_POST['categoryDescription_'.$lang]);
                    var_dump($catTranslation);
                    if ($catTranslation->save(false))
                        $this->massenger->add($this->language->get('message_add_success'));
                }
            } else {
                $this->massenger->add($this->language->get('messages_add_failed'), Massenger::APP_MESSAGE_ERROR);
            }
            $this->redirect('/IMEICategory');
        }
        $this->_view();
    }

    public function editAction()
    {
        $id = $this->filterInt($this->_params[0]);
        $id = IMEICategoryModel::getByPK($id);
        if ($id == null) $this->redirect("/IMEICategory");

        $this->language->load('template\common');
        $this->language->load('FileCategory\add');
        $this->language->load('FileCategory\form');
        $this->language->load('FileCategory\messages');
        $this->language->load('validations\errors');
        $this->_data['catergoy'] = $id;

        if (isset($_POST['submit']) && $this->isValid($this->_AddActionRoles, $_POST)) {
            $cat = new IMEICategoryModel();
            $cat->imei_service_cat_id = $id->imei_service_cat_id;
            $cat->imei_service_cat_name = $this->filterString($_POST['categoryName']);
            $cat->imei_service_cat_description = $this->filterString($_POST['categoryDescription']);
            $cat->imei_service_cat_ordering = $this->filterInt($_POST['categoryOrdering']);
            $cat->imei_service_cat_visibility = $this->filterInt($_POST['visibility']);
            if ($cat->save()) {
                $catTranslation = new IMEICategoryTranslationModel();
                $this->massenger->add($this->language->get('message_edit_success'));
            } else {
                $this->massenger->add($this->language->get('messages_edit_failed'), Massenger::APP_MESSAGE_ERROR);
            }
            $this->redirect('/IMEICategory');
        }
        return $this->_view();
    }

    public function deleteAction()
    {
        $id = $this->filterInt($this->_params[0]);
        $id = IMEICategoryModel::getByPK($id);
        if ($id == null) $this->redirect("/IMEICategory");
        $this->language->load('FileCategory\messages');
        if ($id->delete()) {
            $this->massenger->add($this->language->get('message_delete_success'));
        } else {
            $this->massenger->add($this->language->get('messages_delete_failed'), Massenger::APP_MESSAGE_ERROR);
        }
        $this->redirect('/IMEICategory');
    }
}