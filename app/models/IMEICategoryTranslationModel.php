<?php


namespace shfretak\models;


class IMEICategoryTranslationModel extends AbstractModel
{
    public $translation_id;
    public $imei_service_cat_id;
    public $imei_service_cat_name;
    public $imei_service_cat_description;
    public $language_code;

    protected static $tableName   = 'imei_services_categories_translation';
    protected static $primeryKey  = 'translation_id';
    protected static $tableSchema = array(
        'imei_service_cat_id'           => self::DATA_TYPE_INT,
        'imei_service_cat_name'         => self::DATA_TYPE_STR,
        'imei_service_cat_description'  => self::DATA_TYPE_STR,
        'language_code'                 => self::DATA_TYPE_STR,
    );

}