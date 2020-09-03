<?php
namespace shfretak\models;
class ServiceModel extends AbstractModel {
      public $service_item_id;
      public $service_item_name;
      public $service_item_description;
      public $service_item_dead_time ;
      public $serviec_item_price;
      public $service_item_visibility;
      public $service_item_cat_id;
      public $service_item_created_date;
      // TODO WE WILL ADD $SERVICE_ITEM_IMG 

      protected static $tableName   = 'services_items';
      protected static $primeryKey  = 'service_item_id';
      protected static $tableSchema = array(
            'service_item_name'        => self::DATA_TYPE_STR,
            'service_item_description' => self::DATA_TYPE_STR,
            'service_item_price'       => self::DATA_TYPE_FLOAT,
            'service_item_dead_time'   => self::DATA_TYPE_STR,
            'service_item_visibility'  => self::DATA_TYPE_INT,
            'service_item_cat_id'      => self::DATA_TYPE_INT,
            'service_item_created_date'=> self::DATA_TYPE_STR  

      );

      public function getTableName(){
            return self::$tableName;
      }


}