<?php

namespace shfretak\controllers;

use shfretak\lib\Frontcontroller;
use shfretak\lib\Language;
use shfretak\lib\Massenger;
use shfretak\lib\Registry;
use shfretak\lib\SessionManager;
use shfretak\lib\template\Template;

/**
 * @property  Template $_template
 * @property  Registry $__registry;
 * @property  Language language
 * @property  Massenger massenger
 * @property mixed|\shfretak\lib\Language|Massenger|\shfretak\lib\SessionManager session
 */
abstract class AbstractController
{
    protected $_controller;
    protected $_action;
    protected $_params;
    protected $_webLan = ['en', 'ar'];
    protected $_template;
    protected $_data = [];
    protected $_registry;

    /**
     * @param $name
     * @return SessionManager|Language|Massenger|SessionManager|mixed
     */
    public function __get($name)
    {
        return $this->_registry->$name;
    }

    public function NotFoundAction()
    {
        $this->_view();
    }

    public function setController($controller, $action, $params)
    {
        $this->_controller = $controller;
        $this->_action = $action;
        $this->_params = $params;
    }

    public function setTemplate(Template $template)
    {
        $this->_template = $template;
    }

    public function setRegistry(Registry $registry)
    {
        $this->_registry = $registry;
    }

    protected function _view($isAJAX = false)
    {
        $view = VIEWS_PATH . DS . $this->_controller . DS . $this->_action . '.view.php';
        if ($this->_action == Frontcontroller::ACTION_NOT_FOUND || !file_exists($view)) {
            $view = VIEWS_PATH . DS . 'notfound' . DS . 'notfound.view.php';
        }

        $this->_data = array_merge($this->_data, $this->language->getDictionary());
        $this->_template->setActionView($view);
        $this->_template->setData($this->_data);
        $this->_template->setRegistry($this->_registry);
        $this->_template->appRender($isAJAX);
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