<?php

namespace app\lib\template;

use Exception;

class Template
{
    use TemplateHelper;
    private $_template;
    private $_actionView;
    private $_data = [];
    private $_registry;

    public function __construct($templateParts)
    {
        $this->_template = $templateParts;
    }

    public function setActionView($view)
    {
        $this->_actionView = $view;
    }

    public function setData($data)
    {
        $this->_data = $data;
    }

    public function __get($name)
    {
        return $this->_registry->$name;
    }

    public function setRegistry($registry)
    {
        $this->_registry = $registry;
    }

    public function swapTemplate($template)
    {
        $this->_template['template'] = $template;
    }

    public function templateHeaderStart()
    {
        extract($this->_data);
        require TEMPLATE_PATH . 'templateHeaderStart.php';
    }

    public function templateHeaderSRC()
    {
        $output = '';
        foreach ($this->_template['header_resources'] as $key => $value) {
            if ($value != null) $output .= "\t<link rel='stylesheet' href='" . $value . "'>\n";
        }
        echo $output;
    }

    public function templateFooterSRC()
    {
        $output = '';
        foreach ($this->_template['footer_resources'] as $key => $value) {
            $output .= "<script  src='" . $value . "'></script>\n ";
        }
        echo $output;
    }

    public function injectFooterResource($resourceKey, $path, $afterResource)
    {
        $footerResources = $this->_template['footer_resources'];
        if (empty($footerResources)) {
            $newFooterResources = array(
                $resourceKey => $path
            );
        } else {
            if (array_key_exists($afterResource, $footerResources)) {
                $key = array_search($afterResource,
                    array_keys($footerResources));
                $newFooterResources = array_slice($footerResources, 0, ++$key) + array(
                        $resourceKey => $path
                    ) + array_slice($footerResources, $key);
            } else {
                throw new Exception(
                    'given resource name does not exists in the template footer resources list');
            }
        }
        return $this->_template['footer_resources'] = $newFooterResources;
    }

    public function injectHeaderResource($resourceKey, $path, $afterResource)
    {
        $footerResources = $this->_template['header_resources'];
        if (empty($footerResources)) {
            $newFooterResources = array(
                $resourceKey => $path
            );
        } else {
            if (array_key_exists($afterResource, $footerResources)) {
                $key = array_search($afterResource,
                    array_keys($footerResources));
                $newFooterResources = array_slice($footerResources, 0, ++$key) + array(
                        $resourceKey => $path
                    ) + array_slice($footerResources, $key);
            } else {
                throw new Exception(
                    'given resource name does not exists in the template footer resources list');
            }
        }
        return $this->_template['header_resources'] = $newFooterResources;
    }

    public function removeKey($key)
    {
        unset($this->_template['header_resources'][$key]);
    }

    public function templateHeaderEnd()
    {
        require TEMPLATE_PATH . 'templateHeaderEnd.php';
    }

    public function templateFooter()
    {
        require TEMPLATE_PATH . 'templateFooter.php';
    }

    private function templateBlocks()
    {
        extract($this->_data);
        foreach ($this->_template['template'] as $key => $value) {
            if ($key == ':view')
                require $this->_actionView;
            else
                require $value;
        }
    }

    public function appRender($isAjax)
    {
        if (!$isAjax) {
            $this->templateHeaderStart();
            $this->templateHeaderSRC();
            $this->templateHeaderEnd();
            $this->templateBlocks();
            $this->templateFooterSRC();
            $this->templateFooter();
        } else {
            $this->templateBlocks();
        }
    }

}