<?php


use app\models\UsersModel;

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
require '..' . DS . 'app' . DS . 'config.php';
require '..' . DS . 'vendor' . DS . 'autoload.php';
//
//$con = mysqli_init();
//mysqli_real_connect($con, "mysql-mevqc3xeyr6xa.mysql.database.azure.com", "melad@mysql-mevqc3xeyr6xa", '7RAprBQqD:W_"b^ce}s!', 'loginSys', 3306);
$servername = "mysql-mevqc3xeyr6xa.mysql.database.azure.com";
$username = "melad@mysql-mevqc3xeyr6xa";
$password = '7RAprBQqD:W_"b^ce}s!';
$dbname = "loginSys";

//$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
if(UsersModel::userExisting('ali')){
    echo 'user exit ';
}else {
    $user = new UsersModel();
    $user->username = 'ali';
    $user->email = 'ali@ali.eg';
    $user->password = 'ali123';
    $user->reg_date = date('Y-m-d h:i:s');
    $user->group_id = 1;
    $user->save();

}


var_dump(UsersModel::getAll());
