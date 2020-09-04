<?php

namespace app\lib\database;

use PDO;
use PDOStatement;

/**
 * Documentation of class Foo
 *
 * @method bool execute()
 * @method PDOStatement|bool prepare(string $sql)
 * @method string lastInsertId()
 */
class PDOHandler
{
    private static $_instance;
    private static PDO $_handler;

    private function __construct()
    {
        self::init();
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array(array(&self::$_handler, $name), $arguments);
    }

    protected static function init(): void
    {
            self::$_handler = new PDO(
                'mysql:host=' . DATABASE_HOST_NAME . ';dbname=' . DATABASE_DB_NAME,
                DATABASE_USER_NAME, DATABASE_PASSWORD, array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
                )
            );
  
    }

    public static function getInstance(): PDOHandler
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
}