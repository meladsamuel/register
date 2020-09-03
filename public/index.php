<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
require '..' . DS . 'app' . DS . 'config.php';
require 'vendor/autoload.php';
echo \app\test::print();
echo UPLOAD_PATH;