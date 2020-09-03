<?php


namespace shfretak\controllers;


use shfretak\lib\Helper;
use shfretak\lib\InputFilter;
use shfretak\models\FileServiceModel;
use shfretak\models\IMEIServiceModel;

class EnController extends AbstractController
{
    use Helper;
    use InputFilter;
    public array $userTemplate = [
        'nav' => TEMPLATE_PATH . 'UserNav.php',
        ':view' => 'actionView'
    ];

    public function userTemplate()
    {
        $this->language->load('template/common');
        $this->language->load('template/user');
        $this->_template->swapTemplate($this->userTemplate);
        $this->_view();
    }

    public function defaultAction()
    {
        $this->userTemplate();
    }

    public function FilesServicesAction()
    {
        if (isset($this->_params[0])) {
            $serviceUrl = $this->filterString($this->_params[0]);
            $this->_data['services'] = FileServiceModel::getAllServiceBy($this->_controller, $serviceUrl);
        } else {
            $all = FileServiceModel::getServices($this->_controller);
            $categories = [];
            foreach ($all as $cat)
                $categories[$cat->file_service_cat_name][] = $cat;
            $this->_data['allServices'] = $categories;

        }
        $this->setLanguage($this->_controller);
        $this->_data['home'] = true;
        $this->userTemplate();
    }

    public function IMEIServicesAction()
    {
        if (isset($this->_params[0])) {
            $serviceUrl = $this->filterString($this->_params[0]);
            $this->_data['services'] = IMEIServiceModel::getAllServiceBy($this->_controller, $serviceUrl);
        } else {
            $all = IMEIServiceModel::getServices($this->_controller);
            $categories = [];
            foreach ($all as $cat)
                $categories[$cat->imei_service_cat_name][] = $cat;
            $this->_data['allServices'] = $categories;

        }
        $this->setLanguage($this->_controller);
        $this->_data['home'] = true;
        $this->userTemplate();
    }

    /**
     * set target page language
     * @param $language
     */
    public function setLanguage($language)
    {
        $this->session->lang = $language;
        if ($language == 'ar')
            $this->_template->injectHeaderResource('rtl', CSS . 'rtl.css', 'main');
        else
            $this->_template->removeKey('rtl');
    }
}