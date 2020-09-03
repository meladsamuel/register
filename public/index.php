<?php

use app\SessionManager;

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
require '..' . DS . 'app' . DS . 'config.php';
require '..' . DS . 'vendor' . DS . 'autoload.php';
echo \app\test::print();
$session = new SessionManager();
$session->start();
$session->new = 'fsdjkfl;asd';
$session->dump();
if (!empty($session->new)) {
    echo $session->new;
}
echo UPLOAD_PATH;