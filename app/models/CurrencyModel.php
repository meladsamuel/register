<?php


namespace shfretak\models;


class CurrencyModel extends AbstractModel
{
    public $currency_code;
    public $currency_amount;

    protected static $tableName   = 'currencies';
    protected static $primeryKey  = 'currency_code';
    protected static $tableSchema = [
        'currency_code'       => self::DATA_TYPE_STR,
        'currency_amount'     => self::DATA_TYPE_FLOAT
    ];

    public static function currencyExisting($currency) {
        return self::get('SELECT * FROM ' . self::$tableName . ' WHERE currency_code = "' .$currency.'"');
    }
}
