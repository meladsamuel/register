<?php
namespace shfretak\models;
class UsersGroupModel extends AbstractModel {
      public $group_id;
      public $group_name;
      
      protected static $tableName   = 'users_groups';
      protected static $primeryKey  = 'group_id';
      protected static $tableSchema = array(
            'group_id'        => self::DATA_TYPE_INT,
            'group_name'      => self::DATA_TYPE_STR
      );

      public function getTableName(){
            return self::$tableName;
      }


}