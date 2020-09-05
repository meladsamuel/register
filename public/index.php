<?php

use app\lib\SessionManager;
use app\models\UsersModel;
use app\lib\Request;
use app\lib\Router;
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
require '..' . DS . 'app' . DS . 'config.php';
require '..' . DS . 'vendor' . DS . 'autoload.php';
require VENDOR_PATH . 'autoload.php';
require ROUTER_PATH.  'index.php';


//$router = new Router($request);
//$router->useRouter('index');
//$router->dispatch();

//$session = new SessionManager();
//$session->start();
//$session->user = '';
//$session->dump();
//unset($session->user);



//if(UsersModel::userExisting('ali')){
//    echo 'user exit ';
//}else {
//    $user = new UsersModel();
//    $user->username = 'ali';
//    $user->email = 'ali@ali.eg';
//    $user->password = 'ali123';
//    $user->reg_date = date('Y-m-d h:i:s');
//    $user->group_id = 1;
//    $user->save();
//
//}


//var_dump(UsersModel::getAll());
