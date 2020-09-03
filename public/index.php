<?php
namespace app;

use app\lib\Authentication;

use app\lib\Massenger;
use app\lib\Registry;
use app\lib\SessionManager;
use app\lib\template\Template;
use app\lib\FrontController;

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
require '..'.DS.'app'.DS.'config'.DS.'config.php';
require APP_PATH.DS.'lib'.DS.'Autoload.php';

$session = new SessionManager();
$session->start();

// var_dump($_COOKIE['_lang']);
if(!isset($_COOKIE['_lang'])) setcookie('_lang', APP_DEFAULT_LANGUAGE);
if (!isset($session->lang))
$session->lang = APP_DEFAULT_LANGUAGE;


$templateParts = require '..'.DS.'app'.DS.'config'.DS.'TemplateConfig.php';
$template  = new Template($templateParts);
$registry  = Registry::getInstance();
$massenger = Massenger::getInstance($session);
$authentication = Authentication::getInstance($session);

$registry->session   = $session;
$registry->massenger  = $massenger;

$controller = new FrontController($template, $registry, $authentication);

$controller->dispatch();
