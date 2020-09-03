<?php

namespace shfretak\controllers;

use shfretak\lib\Back;
use shfretak\lib\Helper;
use shfretak\lib\InputFilter;
use shfretak\lib\Massenger;
use shfretak\lib\validate;
use shfretak\models\FileCategoryModel;
use shfretak\models\FileCategoryTranslationModel;

class FileCategoryController extends AbstractController
{
    use InputFilter;
    use Helper;
    use validate;
    use Back;
    private array $_AddActionRoles = [
        'categoryName_en' => 'req|alpha|min(4)|max(40)',
        'categoryName_ar' => 'req|alpha|min(4)|max(40)',
        'categoryDescription_en' => 'req|alphanum',
        'categoryDescription_ar' => 'req|alphanum',
        'categoryOrdering' => 'req|int',
        'visibility' => 'checked' // TODO fix the warning message if the users or hacker delete the input form  i'm fixed it by add @ we need better solution
    ];
    private array $_editActionRoles = [
        'categoryName' => 'req|alpha|min(4)|max(40)',
        'categoryDescription' => 'req|alphanum',
        'categoryOrdering' => 'req|int',
        'visibility' => 'checked'
    ];

    public function defaultAction()
    {
        $this->language->load('FileCategory\default');
        $this->language->load('FileCategory\add');
        $this->_data['category'] = FileCategoryModel::getAllOne();
        $this->_template->injectFooterResource('dataTable', JS . 'dataTable.js', 'main');
        $this->backHelper($this);
    }

    public function addAction()
    {
        $this->language->load('FileCategory\add');
        $this->language->load('FileCategory\form');
        $this->language->load('FileCategory\messages');
        if (isset($_POST['submit']) && $this->isValid($this->_AddActionRoles, $_POST)) {
            $cat = new FileCategoryModel();
            $cat->file_service_cat_ordering = $this->filterInt($_POST['categoryOrdering']);
            $cat->file_service_cat_visibility = $this->filterInt($_POST['visibility']);
            if ($cat->save()) {
                $catTranslation = new FileCategoryTranslationModel();
                foreach ($this->_webLan as $lang) {
                    $catTranslation->file_service_cat_id = $cat->file_service_cat_id;
                    $catTranslation->language_code = $lang;
                    $catTranslation->file_service_cat_name = $this->filterString($_POST['categoryName_' . $lang]);
                    $catTranslation->file_service_cat_description = $this->filterString($_POST['categoryDescription_' . $lang]);
                    if ($catTranslation->save(false))
                        $this->massenger->add($this->language->get('message_add_success'));
                }
            } else {
                $this->massenger->add($this->language->get('messages_add_failed'), Massenger::APP_MESSAGE_ERROR);
            }
            $this->redirect('/FileCategory');
        }
        $this->backHelper($this);
    }

    public function editAction()
    {
        $id = $this->filterInt($this->_params[0]);
        $id = FileCategoryModel::getByPKOne($id);
        if ($id == null) $this->redirect("/FileCategory");

        $this->language->load('FileCategory\add');
        $this->language->load('FileCategory\form');
        $this->language->load('FileCategory\messages');
        $this->_data['category'] = $id;

        $cat = new FileCategoryModel();
        if (isset($_POST['submit']) && $this->isValid($this->_editActionRoles, $_POST)) {
            $cat->file_service_cat_id = $id->file_service_cat_id;
            $cat->file_service_cat_ordering = $this->filterInt($_POST['categoryOrdering']);
            $cat->file_service_cat_visibility = $this->filterInt($_POST['visibility']);
            if ($cat->save()) {
                $catTranslation = new FileCategoryTranslationModel();
                if ($this->session->lang == $id->language_code) {
                    $catTranslation->translation_id = $id->translation_id;
                    $catTranslation->file_service_cat_id = $id->file_service_cat_id;
                    $catTranslation->language_code = $id->language_code;
                    $catTranslation->file_service_cat_name = $this->filterString($_POST['categoryName']);
                    $catTranslation->file_service_cat_description = $this->filterString($_POST['categoryDescription']);
                    if ($catTranslation->save())
                        $this->massenger->add($this->language->get('message_edit_success'));
                }
            } else {
                $this->massenger->add($this->language->get('messages_edit_failed'), Massenger::APP_MESSAGE_ERROR);
            }
            $this->redirect('/FileCategory');
        }
        $this->backHelper($this);
    }

    public function deleteAction()
    {
        $id = $this->filterInt($this->_params[0]);
        $id = FileCategoryModel::getByPK($id);
        if ($id == null) $this->redirect("/FileCategory");
        $this->language->load('FileCategory\messages');
        if ($id->delete()) {
            $this->massenger->add($this->language->get('message_delete_success'));
        } else {
            $this->massenger->add($this->language->get('messages_delete_failed'), Massenger::APP_MESSAGE_ERROR);
        }
        $this->redirect('/FileCategory');
    }
}