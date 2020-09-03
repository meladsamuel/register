<?php


namespace shfretak\models;


class PaymentNetworkModel extends AbstractModel
{
    public $charge_id;
    public $charge_network;
    public $charge_transaction_id;
    public $charge_value_local;
    public $charge_value_crypto;
    protected static $tableName   = 'payment_network';
    protected static $primeryKey  = 'charge_id';
    protected static $tableSchema = [
        'charge_id'                 => self::DATA_TYPE_STR,
        'charge_network'           => self::DATA_TYPE_STR,
        'charge_transaction_id'    => self::DATA_TYPE_STR,
        'charge_value_local'       => self::DATA_TYPE_FLOAT,
        'charge_value_crypto'      => self::DATA_TYPE_FLOAT,
    ];

}