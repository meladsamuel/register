<?php
namespace shfretak\models;
class FileCategoryModel extends AbstractModel {
      public $file_service_cat_id;
      public $file_service_cat_ordering;
      public $file_service_cat_visibility;

      
      protected static $tableName   = 'file_services_categories';
      protected static $primeryKey  = 'file_service_cat_id';
      protected static $tableSchema = array(
            'file_service_cat_visibility'      => self::DATA_TYPE_INT,
            'file_service_cat_ordering'        => self::DATA_TYPE_INT
      );



}