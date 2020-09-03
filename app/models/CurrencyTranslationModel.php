<?php


namespace shfretak\models;


class CurrencyTranslationModel extends AbstractModel
{
    public $currencies_translation_id;
    public $currency_code;
    public $language_code;
    public $currency_name;

    protected static $tableName   = 'currencies_translation';
    protected static $primeryKey  = 'currencies_translation_id';
    protected static $tableSchema = [
        'currencies_translation_id'     => self::DATA_TYPE_INT,
        'currency_code'                 => self::DATA_TYPE_STR,
        'language_code'                 => self::DATA_TYPE_STR,
        'currency_name'                 => self::DATA_TYPE_STR
    ];
}