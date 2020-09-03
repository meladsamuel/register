<?php

namespace shfretak\models;
class PrivilageModel extends AbstractModel {
      public $privilage_id;
      public $privilage;
      public $privilage_title;

      protected static $tableName = 'users_privilages';
      protected static $primeryKey = 'privilage_id';

      protected static $tableSchema = array(
            'privilage'       => self::DATA_TYPE_STR,
            'privilage_title' => self::DATA_TYPE_STR
      );

      public function getTableName(){
            return self::$tableName;
      }
}