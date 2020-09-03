<?php
namespace shfretak\models;
class FileOrderModel extends AbstractModel {
    public $imei_order_id;
    public $imei_order;

    protected static $tableName = 'imei_order';
    protected static $primeryKey = 'imei_order_id';
    protected static $tableSchema = [
        'imei_order_id' => self::DATA_TYPE_INT,
        'imei_order' => self::DATA_TYPE_STR
    ];

}