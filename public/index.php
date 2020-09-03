<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
require '..' . DS . 'app' . DS . 'config.php';
require '..' . DS . 'vendor' . DS . 'autoload.php';
echo \app\test::print();
echo UPLOAD_PATH;