<?php
namespace shfretak;

use shfretak\lib\Authentication;
use shfretak\lib\Language;
use shfretak\lib\Massenger;
use shfretak\lib\Registry;
use shfretak\lib\SessionManager;
use shfretak\lib\template\Template;
use shfretak\lib\FrontController;

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
require '..'.DS.'app'.DS.'config'.DS.'config.php';
require APP_PATH.DS.'lib'.DS.'Autoload.php';
//require APP_PATH.DS.'lib'.DS.'rachat'.DS.'vendor'.DS.'autoload.php';
require APP_PATH.DS.'lib'.DS.'vendor'.DS.'autoload.php';

$session = new SessionManager();
$session->start();

// var_dump($_COOKIE['_lang']);
if(!isset($_COOKIE['_lang'])) setcookie('_lang', APP_DEFAULT_LANGUAGE);
if (!isset($session->lang))
    $session->lang = APP_DEFAULT_LANGUAGE;


$templateParts = require '..'.DS.'app'.DS.'config'.DS.'TemplateConfig.php';
$template  = new Template($templateParts);
$language  = new Language;
$registry  = Registry::getInstance();
$massenger = Massenger::getInstance($session);
$authentication = Authentication::getInstance($session);

$registry->language  = $language;
$registry->session   = $session;
$registry->massenger  = $massenger;

$controller = new FrontController($template, $registry, $authentication);

$controller->dispatch();