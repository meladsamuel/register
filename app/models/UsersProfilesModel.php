<?php
namespace app\models;
class UsersProfilesModel extends AbstractModel{
      public $user_profile_id;
      public $user_profile_first_name;
      public $user_profile_last_name;
      public $user_profile_phone_number;
      public $user_profile_country;
      public $user_profile_language;
      public $user_profile_img;

      protected static $tableName = 'users_profile';
      protected static $primeryKey = 'user_profile_id';
      protected static $tableSchema = array(
            'user_profile_id'           => self::DATA_TYPE_INT,
            'user_profile_first_name'   => self::DATA_TYPE_STR,
            'user_profile_last_name'    => self::DATA_TYPE_STR,
            'user_profile_phone_number' => self::DATA_TYPE_INT,
            'user_profile_country'      => self::DATA_TYPE_STR,
            'user_profile_language'     => self::DATA_TYPE_STR,
            'user_profile_img'          => self::DATA_TYPE_STR
      );

      public function getTableName(){
            return self::$tableName;
      }

}