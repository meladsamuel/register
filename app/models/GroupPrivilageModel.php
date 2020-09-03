<?php
namespace app\models;
class GroupPrivilageModel extends AbstractModel {
      public $id;
      public $group_id;
      public $privilage_id;

      
      protected static $tableName   = 'users_groups_privilages';
      protected static $primeryKey  = 'id';
      protected static $tableSchema = array(
            'id'           => self::DATA_TYPE_INT,
            'group_id'     => self::DATA_TYPE_INT,
            'privilage_id' => self::DATA_TYPE_INT
      );

      public function getTableName(){
            return self::$tableName;
      }
      public function getPrivilageUrl($groupId){
            $sql = 'SELECT ugp.*, up.privilage FROM ' .self::$tableName . ' AS ugp '  ;
            $sql .= 'INNER JOIN users_privilages AS up ON ugp.privilage_id = up.privilage_id ';
            $sql .= 'WHERE ugp.group_id =' .$groupId;
            $privilages = self::get($sql);
            $extractPrivilageUrl = [];
            if($privilages != false) {
                  foreach($privilages as $privilage){
                        $extractPrivilageUrl[] = $privilage->privilage;
                  }
            }
            return $extractPrivilageUrl;


      }


}