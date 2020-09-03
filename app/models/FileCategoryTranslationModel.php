<?php
namespace shfretak\models;
class FileCategoryTranslationModel extends AbstractModel {
      public $translation_id;
      public $file_service_cat_id;
      public $language_code;
      public $file_service_cat_name;
      public $file_service_cat_description;



    protected static $tableName   = 'file_services_categories_translation';
      protected static $primeryKey  = 'translation_id';
      protected static $tableSchema = array(
            'file_service_cat_id'              => self::DATA_TYPE_INT,
            'language_code'                    => self::DATA_TYPE_STR,
            'file_service_cat_name'            => self::DATA_TYPE_STR,
            'file_service_cat_description'     => self::DATA_TYPE_STR,

      );

}