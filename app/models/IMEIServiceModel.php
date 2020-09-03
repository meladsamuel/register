<?php

namespace shfretak\models;
use ArrayIterator;

class IMEIServiceModel extends AbstractModel
{
    public int $imei_service_id;
    public $imei_service_supplier_id; // null
    public int $imei_service_cat_id;
    public float $imei_service_price;
    public float $imei_service_cost_price;
    public int $imei_service_orders_verification; // radio box
    public int $imei_service_visibility;
    public string $imei_service_time_to_verfiy; //text
    public  $imei_service_img; // null
    public string $imei_service_return; // null
    public string $imei_service_url;

    protected static string $tableName = 'imei_services';
    protected static string $primeryKey = 'imei_service_id';
    protected static array $tableSchema = [
        'imei_service_supplier_id' => self::DATA_TYPE_INT,
        'imei_service_cat_id' => self::DATA_TYPE_INT,
        'imei_service_price' => self::DATA_TYPE_FLOAT,
        'imei_service_cost_price' => self::DATA_TYPE_FLOAT,
        'imei_service_orders_verification' => self::DATA_TYPE_INT,
        'imei_service_visibility' => self::DATA_TYPE_INT,
        'imei_service_time_to_verfiy' => self::DATA_TYPE_STR, // TODO make the date verifiction befor insert the database
        'imei_service_return' => self::DATA_TYPE_STR,
        'imei_service_url' => self::DATA_TYPE_STR,
        'imei_service_img' => self::DATA_TYPE_STR
    ];

    public static function getAlls()
    {
        return self::get(
            'SELECT group_concat(a.imei_service_title) AS imei_service_title, group_concat(a.imei_service_id) AS imei_service_id, b.imei_service_cat_name FROM ' . self::$tableName .
            ' a INNER JOIN imei_services_categories b
                   ON a.imei_service_cat_id = b.imei_service_cat_id 
                   GROUP BY b.imei_service_cat_name'

        );
    }

    /**
     * @return ArrayIterator|bool
     */
    public static function getAllService()
    {
        return self::get('SELECT a.*, b.* , c.*, d.* FROM ' . self::$tableName .
            ' a INNER JOIN ' . self::$tableName . '_translation b ON a.imei_service_id = b.imei_service_id' .
            ' INNER JOIN ' . self::$tableName . '_categories c ON a.imei_service_cat_id = c.imei_service_cat_id' .
            ' INNER JOIN ' . self::$tableName . '_categories_translation d ON c.imei_service_cat_id = d.imei_service_cat_id and b.language_code = d.language_code' .
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
        return self::get('SELECT a.*, b.imei_service_cat_name, c.imei_service_title FROM ' . self::$tableName .
            ' a INNER JOIN ' . self::$tableName . '_categories_translation   b ON a.imei_service_cat_id = b.imei_service_cat_id' .
            ' INNER JOIN ' . self::$tableName . '_translation c ON a.imei_service_id = c.imei_service_id' .
            " WHERE b.language_code='${language}'and c.language_code='${language}'"
        );

    }

    /**
     * get the service with it category by the url and show it in single language
     * @param string $url
     * @param string $language
     * @return ArrayIterator|bool
     */
    public static function getAllServiceBy($language, $url)
    {
        return self::getOne('SELECT a.*, b.* , c.*, d.* FROM ' . static::$tableName .
            ' a INNER JOIN ' . static::$tableName . '_translation b ON a.imei_service_id = b.imei_service_id' .
            ' INNER JOIN ' . static::$tableName . '_categories c ON a.imei_service_cat_id = c.imei_service_cat_id' .
            ' INNER JOIN ' . static::$tableName . '_categories_translation d ON c.imei_service_cat_id = d.imei_service_cat_id and b.language_code = d.language_code' .
            ' WHERE b.language_code = "' . $language . '" AND a.imei_service_url ="' . $url . '"'
        );
    }

}