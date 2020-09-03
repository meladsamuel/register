<?php

namespace shfretak\models;
class IMEIServiceOrderModel extends AbstractModel
{
    public $imei_order_id;
    public $imei_order_user_id;
    public $imei_order_service_id;
    public $imei_order_note;
    public $imei_order_status;
    public $imei_order_created_date;
    public $imei_order_prices;
    public $imei_order_updated_date;
    public $imei_order_return_code;
    // TODO what is the result of the order
    protected static $tableName = 'imei_services_orders';
    protected static $primeryKey = 'imei_order_id';
    protected static $tableSchema = [
        'imei_order_user_id' => self::DATA_TYPE_INT,
        'imei_order_service_id' => self::DATA_TYPE_INT,
        'imei_order_note' => self::DATA_TYPE_STR,
        'imei_order_status' => self::DATA_TYPE_INT,
        'imei_order_created_date' => self::DATA_TYPE_STR, // TODO CREATE DATE VALTIDAY IN DATABASE
        'imei_order_updated_date' => self::DATA_TYPE_STR,
        'imei_order_prices' => self::DATA_TYPE_FLOAT,
        'imei_order_return_code' => self::DATA_TYPE_STR,
    ];


    /**
     * @param float $price the price of imei service
     * @param int $number the number of the imei service the you want
     */
    public function orderPrice(float $price, int $number)
    {
        $this->imei_order_prices = $price * $number;
    }


    public static function getOrder($limit = 0, $isDESC = false)
    {
        return self::get('SELECT a.*, b.user_name FROM imei_services_orders a INNER JOIN users b ON a.imei_order_user_id = b.user_id' . ($isDESC ? " ORDER BY " . static::$primeryKey . " DESC" : '') . ($limit ? " LIMIT $limit " : ''));
    }
}