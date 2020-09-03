<?php
namespace app\lib\database;


/**
 * Class DatabaseHandler
 * @package shfretak\lib\database
 */
abstract class DatabaseHandler{
    /**
     *
     */
    const DATABASE_DRIVER_POD       = 1;
    /**
     *
     */
    const DATABASE_DRIVER_MYSQLI    = 2;

    /**
     * DatabaseHandler constructor.
     */
    private function __construct() {}

    /**
     * @return mixed
     */
    abstract protected static function init();

    /**
     * @return mixed
     */
    abstract protected static function getInstance();

    /**
     * @return mixed|PDOdatabasehandler|null
     */
    public static function factory()
      {
            $driver = DATABASE_CONN_DRIVER;
            if ($driver == self::DATABASE_DRIVER_POD) {
            return PDODatabaseHandler::getInstance();
            } elseif ($driver == self::DATABASE_DRIVER_MYSQLI) {
            return null;// if their is another driver like(mysqli ....) you can use it
            }
      }
}