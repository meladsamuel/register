<?php
namespace shfretak\models;

class UsersModel extends AbstractModel {
      public $user_id;
      public $user_name;
      public $user_email;
      public $user_password;
      public $user_reg_stat;
      public $user_reg_date;
      public $user_group_id;
      public $user_last_login;
      public $user_balance;
      public $user_currency;
      /**
      * @var UserProfileModel
      */
      public $profile;
      public $privilages;

      protected static $tableName   = 'users';
      protected static $primeryKey  = 'user_id';
      protected static $tableSchema = array(
            'user_id'         => self::DATA_TYPE_INT,
            'user_name'       => self::DATA_TYPE_STR,
            'user_email'      => self::DATA_TYPE_STR,
            'user_password'   => self::DATA_TYPE_STR,
            'user_reg_stat'   => self::DATA_TYPE_INT,
            'user_reg_date'   => self::DATA_TYPE_STR,
            'user_group_id'   => self::DATA_TYPE_INT,
            'user_last_login' => self::DATA_TYPE_STR,
            'user_balance'    => self::DATA_TYPE_FLOAT,
            'user_currency'   => self::DATA_TYPE_STR
      );
      
      public function getTableName(){
            return self::$tableName;
      }
      public function cryptPassword($password){
            $this->user_password = crypt($password, APP_SALT);
      }
      public function changePassword(){
            return var_dump($this);
      }
      public static function getUsers($user){
            return self::get(
                  'SELECT users.*, users_groups.group_name FROM '. self::$tableName . ' INNER JOIN users_groups ON users.user_group_id = users_groups.group_id WHERE users.user_id != '.$user 
            );
      }
      public static function userExisting($username){
            return self::get(
                  'SELECT * FROM ' . self::$tableName . ' WHERE user_name = "'. $username . '"'
            );
      }
      public static function authenticate($username, $password, $session){
          $password = crypt($password, APP_SALT);
          $foundUser = self::getOne(
                'SELECT * FROM ' . self::$tableName . ' WHERE user_name = "' . $username . '" AND ' . 'user_password = "' . $password . '"'
          );
          if($foundUser != false) {
                if($foundUser->user_reg_stat == 2) { // user block
                      return 2;
                }
                $foundUser->user_last_login = date('Y-m-d H:i:s');
                $foundUser->save();
                $foundUser->profile = UsersProfilesModel::getByPK($foundUser->user_id);
                $foundUser->privilages = GroupPrivilageModel::getPrivilageUrl($foundUser->user_group_id);
                $session->u = $foundUser;
                $currency = CurrencyModel::getByPK($foundUser->user_currency);
                $session->currency_amount = $currency->currency_amount;
                return 1; // user verified
          }
          return false;
      }
      public static function changeCurrency($pk, $currency){
          $user = self::getByPK($pk);
          $user->user_currency = $currency;
          return $user->save();
      }

}