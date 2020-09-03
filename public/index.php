<?php

use app\models\UsersModel;
use app\SessionManager;

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
require '..' . DS . 'app' . DS . 'config.php';
require '..' . DS . 'vendor' . DS . 'autoload.php';
$session = new SessionManager();
$session->start();

if (UsersModel::userExisting('ali'))
    echo 'hello';
else
    echo 'not exit <br>';
if (!empty($session->new)) {
    echo $session->new;
}
