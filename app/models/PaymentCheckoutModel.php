<?php


namespace shfretak\models;


class PaymentCheckoutModel extends AbstractModel
{
    public $checkout_id;
    public $checkout_name;
    public $checkout_description;
    public $checkout_pricing_type;
    public $checkout_local_price_amount;

    protected static $tableName   = 'payment_checkout';
    protected static $primeryKey  = 'checkout_id';
    protected static $tableSchema = [
        'checkout_id'                   => self::DATA_TYPE_STR,
        'checkout_name'                 => self::DATA_TYPE_STR,
        'checkout_description'          => self::DATA_TYPE_STR,
        'checkout_pricing_type'         => self::DATA_TYPE_STR,
        'checkout_local_price_amount'   => self::DATA_TYPE_FLOAT
    ];

}