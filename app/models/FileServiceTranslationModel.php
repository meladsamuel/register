<?php


namespace shfretak\models;


class FileServiceTranslationModel extends AbstractModel
{
    public $translation_id;
    public $file_service_id;
    public $language_code;
    public $file_service_content;
    public $file_service_title;
    public $file_service_delivery_time; // text


    protected static $tableName   = 'file_services_translation';
    protected static $primeryKey  = 'translation_id';
    protected static $tableSchema = [
        'file_service_id'                   => self::DATA_TYPE_INT,
        'language_code'                     => self::DATA_TYPE_STR,
        'file_service_content'              => self::DATA_TYPE_STR,
        'file_service_title'                => self::DATA_TYPE_STR,
        'file_service_delivery_time'        => self::DATA_TYPE_STR,

    ];
}