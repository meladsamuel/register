<?php

namespace shfretak\models;

class FileServiceOrderModel extends AbstractModel
{
    public $file_order_id;
    public int $file_order_user_id;
    public int $file_order_service_id;
    public string $file_order_note;
    public int $file_order_status;
    public string $file_order_created_date;
    public float $file_order_price;
    public $file_order_return_code;
    public string $file_order_file_path;
    public string $file_order_received_date;
    // TODO what is the result of the order
    protected static string $tableName = 'file_services_orders';
    protected static string $primeryKey = 'file_order_id';
    protected static array $tableSchema = [
        'file_order_id' => self::DATA_TYPE_INT,
        'file_order_user_id' => self::DATA_TYPE_INT,
        'file_order_service_id' => self::DATA_TYPE_INT,
        'file_order_note' => self::DATA_TYPE_STR,
        'file_order_status' => self::DATA_TYPE_INT,
        'file_order_created_date' => self::DATA_TYPE_STR,
        'file_order_price' => self::DATA_TYPE_FLOAT,
        'file_order_return_code' => self::DATA_TYPE_STR,
        'file_order_file_path' => self::DATA_TYPE_STR,
        'file_order_received_date' => self::DATA_TYPE_STR
    ];


    public static function getOrder($limit = 0, $isDESC = false)
    {
        return self::get('SELECT a.*, b.user_name FROM file_services_orders a INNER JOIN users b ON a.file_order_user_id = b.user_id' . ($isDESC ? " ORDER BY " . static::$primeryKey . " DESC" : '') . ($limit ? " LIMIT $limit " : ''));
    }

    /**
     * Compute the price for the files that update to the order
     * @param float $price the price of imei service
     * @param int $number the number of the imei service the you want
     */
    public function orderPrice(float $price, int $number)
    {
        $this->file_order_price = $price * $number;
    }

    /**
     * Create received date
     * This function generate received date. It take the number of hours form database and add into received date in database
     * @param int The number of minutes
     */
    public function receivedDate(int $n)
    {
        $this->file_order_received_date = date('Y-m-d h:i:s', time() + ($n * (60 * 60)));
    }
}