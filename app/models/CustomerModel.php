<?php
namespace shfretak\models;
class CustomereModel extends AbstractModel {
      public $user_id;
      public $user_name;
      public $user_email;
      public $user_credit ;
      public $user_subscription_stat;
      public $user_subscription_date;
      public $user_type_id;
      public $user_credit_id;
      public $user_order_id;
      public $user_log_id;
      public $user_last_log;

      
      protected static $tableName   = 'users';
      protected static $primeryKey  = 'user_id';
      protected static $tableSchema = array(
            'user_id'                 => self::DATA_TYPE_INT,
            'user_name'               => self::DATA_TYPE_STR,
            'user_email'              => self::DATA_TYPE_STR,
            'user_credit'             => self::DATA_TYPE_FLOAT,
            'user_subscription_stat'  => self::DATA_TYPE_STR,
            'user_subscription_date'  => self::DATA_TYPE_STR,
            'user_type_id'            => self::DATA_TYPE_INT,
            'user_credit_id'          => self::DATA_TYPE_INT,
            'user_order_id'           => self::DATA_TYPE_INT,
            'user_log_id'             => self::DATA_TYPE_INT,       
            'user_last_log'           => self::DATA_TYPE_STR        
      );

      public function getTableName(){
            return self::$tableName;
      }


}