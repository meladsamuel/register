<?php

namespace shfretak\lib\template;

/**
 * Trait TemplateHelper
 * @package shfretak\lib\template
 */
trait TemplateHelper
{
    /**
     * @param $url
     * @return bool
     */
    public function parseUrl($url)
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $path = explode('/', trim($path, '/'));
        return in_array($path[0], $url);
    }
    public function location($arg = '') {
        $path = WEB_SITE_NAME;
        $path .= parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $path = trim($path, '/');
        $path .= '/'. $arg . '/';
        return $path;
    }
    public function Breadcrumb($current)
    {
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $url = explode('/', trim($url, '/'));
        $lang = $_SESSION['lang'];
        $breadcrumb = "<ul class='bread-crumb list-unstyled list-inline '><li><a href='" . $this->oneLanguage() . "'><i class='fa fa-home'></i></a></li>";
        $length = count($url);
        for ($i = 0; $i < $length - 1; $i++) {
            $link = WEB_SITE_NAME;
            if($url[$i] == 'en' || $url[$i] == 'ar')
                continue;
            for ($j = 0; $j <= $i; $j++)
                $link .= '/' . $url[$j];
            $breadcrumb .= "<li class='fa'>".$this->_data['separator_'.$lang]."</li><li><a href='${link}'>" . $this->_data[$url[$i]] . "</a></li>";
        }
        $breadcrumb .= "<li class='fa'>".$this->_data['separator_'.$lang]."</li><li><a href='#'> $current </a></li>";
        return $breadcrumb . '</ul>';
    }

    /**
     * @param $fieldName
     * @param null $object
     * @param null $objValue
     * @return mixed|string
     */
    public function showValue($fieldName, $object = null, $objValue = null)
    {
        return isset($_POST[$fieldName]) ? $_POST[$fieldName] : (is_null($object) ? '' : $object->$objValue);
    }

    /**
     * @param $fieldName
     * @param $value
     * @param null $object
     * @param null $objValue
     * @return string
     */
    public function selected($fieldName, $value, $object = null, $objValue = null)
    {
        return ((isset($_POST[$fieldName]) && $_POST[$fieldName] == $value) || (!is_null($object) && $object->$objValue == $value)) ? 'selected' : '';
    }

    /**
     * @param $fieldName
     * @param $value
     * @param null $cValue
     * @return string
     */
    public function selected_A($fieldName, $value, $cValue = null)
    {
        return ((isset($_POST[$fieldName]) && $_POST[$fieldName] == $value) || (!is_null($cValue) && $cValue == $value)) ? 'selected' : '';
    }

    /**
     * @param $fieldName
     * @param $value
     * @param null $object
     * @param null $objValue
     * @return string
     */
    public function checked($fieldName, $value, $object = null, $objValue = null)
    {
        return ((isset($_POST[$fieldName]) && $_POST[$fieldName] == $value) || (!is_null($object) && $object->$objValue == $value)) ? 'checked' : '';
    }
    public function oneLanguage() {
        if($_SESSION['lang']=='en')
            return WEB_SITE_NAME . '/en/';
        return WEB_SITE_NAME;
    }
}    