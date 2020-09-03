<?php

namespace shfretak\models;

use ArrayIterator;

class FileServiceModel extends AbstractModel
{
    public $file_service_id;
    public $file_service_url;
    public $file_service_supplier_id; // null
    public $file_service_cat_id;
    public $file_service_price;
    public $file_service_cost_price;
    public $file_service_orders_verification; // radio box
    public $file_service_visibility;
    public $file_service_orders_received; //text

    protected static $tableName = 'file_services';
    protected static $primeryKey = 'file_service_id';
    protected static $tableSchema = [
        'file_service_url' => self::DATA_TYPE_STR,
        'file_service_supplier_id' => self::DATA_TYPE_INT,
        'file_service_cat_id' => self::DATA_TYPE_INT,
        'file_service_price' => self::DATA_TYPE_FLOAT,
        'file_service_cost_price' => self::DATA_TYPE_FLOAT,
        'file_service_orders_verification' => self::DATA_TYPE_INT,
        'file_service_visibility' => self::DATA_TYPE_INT,
        'file_service_orders_received' => self::DATA_TYPE_STR // TODO make the date verifiction befor insert the database
    ];


    public static function getAlls()
    {
        return self::get(
            'SELECT group_concat(a.file_service_title) AS file_service_title, group_concat(a.file_service_id) AS file_service_id, b.file_service_cat_name FROM ' . self::$tableName .
            ' a INNER JOIN file_services_categories b
                   ON a.file_service_cat_id = b.file_service_cat_id 
                   GROUP BY b.file_service_cat_name'
        );
    }

    /**
     * @return ArrayIterator|bool
     */
    public static function getAllService()
    {
        return self::get('SELECT a.*, b.* , c.*, d.* FROM ' . self::$tableName .
            ' a INNER JOIN ' . self::$tableName . '_translation b ON a.file_service_id = b.file_service_id' .
            ' INNER JOIN ' . self::$tableName . '_categories c ON a.file_service_cat_id = c.file_service_cat_id' .
            ' INNER JOIN ' . self::$tableName . '_categories_translation d ON c.file_service_cat_id = d.file_service_cat_id and b.language_code = d.language_code' .
            ' WHERE b.language_code = "' . $_SESSION['lang'] . '"'
        );
    }


    /**
     * get the service form database
     * @param string $language
     * @return ArrayIterator|bool
     */
    public static function getServices($language)
    {
        return self::get('SELECT a.*, b.file_service_cat_name, c.file_service_title FROM ' . self::$tableName .
            ' a INNER JOIN ' . self::$tableName . '_categories_translation   b ON a.file_service_cat_id = b.file_service_cat_id' .
            ' INNER JOIN ' . self::$tableName . '_translation c ON a.file_service_id = c.file_service_id' .
            " WHERE b.language_code='${language}'and c.language_code='${language}'"
        );

    }

    /**
     * get the service with it category by the key and show it in single language
     * @param string $key
     * @param string $language
     * @return ArrayIterator|bool
     */
    public static function getAllServiceBy($language, $key)
    {
        return self::getOne('SELECT a.*, b.* , c.*, d.* FROM ' . static::$tableName .
            ' a INNER JOIN ' . static::$tableName . '_translation b ON a.file_service_id = b.file_service_id' .
            ' INNER JOIN ' . static::$tableName . '_categories c ON a.file_service_cat_id = c.file_service_cat_id' .
            ' INNER JOIN ' . static::$tableName . '_categories_translation d ON c.file_service_cat_id = d.file_service_cat_id and b.language_code = d.language_code' .
            ' WHERE b.language_code = "' . $language . '" AND a.file_service_url ="' . $key . '"'
        );
    }


}