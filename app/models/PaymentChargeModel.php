<?php


namespace shfretak\models;


class PaymentChargeModel extends AbstractModel
{
    public $charge_id;
    public $charge_name;
    public $charge_user_id;
    public $charge_created_at;
    public $charge_expires_at;
    public $charge_confirmed_at;
    public $charge_checkout_id;
    public $charge_time_line;
    public $charge_addresses_bitcoin;
    public $charge_addresses_ethereum;
    public $charge_addresses_litecoin;
    public $charge_addresses_bitcoincash;
    public $charge_addresses_usdc;
    protected static $tableName   = 'payment_charges';
    protected static $primeryKey  = 'charge_id';
    protected static $tableSchema = [
        'charge_id'                     => self::DATA_TYPE_STR,
        'charge_name'                   => self::DATA_TYPE_STR,
        'charge_user_id'                => self::DATA_TYPE_INT,
        'charge_created_at'             => self::DATA_TYPE_STR,
        'charge_expires_at'             => self::DATA_TYPE_STR,
        'charge_confirmed_at'           => self::DATA_TYPE_STR,
        'charge_checkout_id'            => self::DATA_TYPE_STR,
        'charge_time_line'              => self::DATA_TYPE_STR,
        'charge_addresses_bitcoin'      => self::DATA_TYPE_STR,
        'charge_addresses_bitcoincash'  => self::DATA_TYPE_STR,
        'charge_addresses_ethereum'     => self::DATA_TYPE_STR,
        'charge_addresses_litecoin'     => self::DATA_TYPE_STR,
        'charge_addresses_usdc'         => self::DATA_TYPE_STR,
    ];
    public static function getAlls() {
        return self::get('select a.* , b.user_name from '.self::$tableName.' a INNER JOIN users b ON b.user_id = a.charge_user_id');
    }
    public static function getAllByPK($chargeId) {
        $charge =  self::get('select a.* , c.*, b.user_name from '.self::$tableName.
            ' a INNER JOIN users b ON b.user_id = a.charge_user_id'.
            '  INNER JOIN payment_network c ON c.charge_id = a.charge_id WHERE a.charge_id = "'.$chargeId.'"');
        return $charge[0];

    }

}