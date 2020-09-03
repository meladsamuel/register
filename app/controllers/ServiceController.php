<?php


namespace shfretak\controllers;

// service/imei/ar/ICloudService
use shfretak\lib\Helper;
use shfretak\lib\InputFilter;
use shfretak\models\AbstractModel;
use shfretak\models\FileServiceModel;

class ServiceController extends AbstractController
{
    use Helper;
    use InputFilter;
    public array $userTemplate = [
        'nav' => TEMPLATE_PATH . 'UserNav.php',
        ':view' => 'actionView'
    ];

    public function defaultAction()
    {
        $this->language->load('template/common');
        $this->language->load('template/user');

        $this->_view();
    }

    public function IMEIAction()
    {
        $this->language->load('template/common');

        $this->language->load('template/user');

        $this->_view();
    }

    public function FilesAction()
    {
        if (!empty($this->_params)) {
            $language = $this->filterString($this->_params[0]);
            if (!in_array($language, $this->_webLan))
                $this->redirect('/notfound');
            if (isset($this->_params[1])) {
                $serviceUrl = $this->filterString($this->_params[1]);
                $this->_data['services'] = FileServiceModel::getAllServiceBy($language, $serviceUrl);
            } else {
                $all = FileServiceModel::getServices($language);
                $categories = [];
                foreach ($all as $cat)
                    $categories[$cat->file_service_cat_name][] = $cat;
                $this->_data['allServices'] = $categories;

            }
                $this->setLanguage($language);
        }else {
            $this->_data['home'] = true;
        }

        $this->language->load('template/common');
        $this->language->load('template/user');
        $this->_template->swapTemplate($this->userTemplate);
        $this->_view();
    }

    public function SearchAction()
    {
        $search = $this->filterString($this->_params[0]);
        echo \GuzzleHttp\json_encode(AbstractModel::Search($search));
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