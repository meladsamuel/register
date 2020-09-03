<?php


namespace shfretak\models;


class IMEIServiceTranslationModel extends AbstractModel
{
    public $translation_id;
    public $imei_service_id;
    public $imei_service_title;
    public $imei_service_content;
    public $imei_service_delivery_time; // text
    public $language_code;

    protected static $tableName = 'imei_services_translation';
    protected static $primeryKey = 'translation_id';
    protected static $tableSchema = [
        'imei_service_id' => self::DATA_TYPE_INT,
        'imei_service_title' => self::DATA_TYPE_STR,
        'imei_service_content' => self::DATA_TYPE_STR,
        'imei_service_delivery_time' => self::DATA_TYPE_STR,
        'language_code' => self::DATA_TYPE_STR
    ];

}