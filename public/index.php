<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
require '..' . DS . 'app' . DS . 'config.php';
require '..' . DS . 'vendor' . DS . 'autoload.php';
echo \app\test::print();
$session = new \shfretak\lib\SessionManager();
$session->start();
$session->new = 'fsdjkfl;asd';
$session->dump();
echo UPLOAD_PATH;