<?php
namespace shfretak\models;
      class IMEICategoryModel extends AbstractModel {
      public $imei_service_cat_id;
      public $imei_service_cat_ordering;
      public $imei_service_cat_visibility;

      protected static $tableName   = 'imei_services_categories';
      protected static $primeryKey  = 'imei_service_cat_id';
      protected static $tableSchema = array(
            'imei_service_cat_visibility'      => self::DATA_TYPE_INT,
            'imei_service_cat_ordering'        => self::DATA_TYPE_INT,
      );

}