<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
require '..' . DS . 'app' . DS . 'config.php';
require '..' . DS . 'vendor' . DS . 'autoload.php';
require VENDOR_PATH . 'autoload.php';
require ROUTER_PATH . 'index.php';
