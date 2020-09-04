<?php


use app\models\UsersModel;

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
require '..' . DS . 'app' . DS . 'config.php';
require '..' . DS . 'vendor' . DS . 'autoload.php';

$user = new UsersModel();
$user->username = 'ali';
$user->email = 'ali@ali.eg';
$user->password = 'ali123';
$user->reg_date = date('Y-m-d h:i:s');
$user->group_id = 1;
$user->save();

var_dump(UsersModel::getAll());
