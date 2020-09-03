<?php

namespace app\models;

use app\SessionManager;

class UsersModel extends AbstractModel
{
    public $user_id;
    public string $user_name;
    public string $user_email;
    public string $user_password;
    public string $user_reg_date;
    public int $user_group_id;
    public string $privileges;

    protected static string $tableName = 'users';
    protected static string $primaryKey = 'user_id';
    protected static array $tableSchema = array(
        'user_id' => self::DATA_TYPE_INT,
        'user_name' => self::DATA_TYPE_STR,
        'user_email' => self::DATA_TYPE_STR,
        'user_password' => self::DATA_TYPE_STR,
        'user_reg_date' => self::DATA_TYPE_STR,
        'user_group_id' => self::DATA_TYPE_INT,
    );

    public function cryptPassword($password)
    {
        $this->user_password = crypt($password, APP_SALT);
    }

    public static function getUsers($user)
    {
        return self::get(
            'SELECT * FROM ' . self::$tableName . ' WHERE users.user_id != ' . $user
        );
    }

    public static function userExisting($username)
    {
        return self::get(
            'SELECT * FROM ' . self::$tableName . ' WHERE user_name = "' . $username . '"'
        );
    }

    /**
     * @param string $username
     * @param string $password
     * @param SessionManager $session
     * @return bool
     */
    public static function authenticate(string $username, string $password, SessionManager $session)
    {
        $password = crypt($password, APP_SALT);
        $foundUser = self::getOne(
            'SELECT * FROM ' . self::$tableName . ' WHERE username = "' . $username . '" AND ' . 'password = "' . $password . '"'
        );
        if ($foundUser) {
            $foundUser->user_last_login = date('Y-m-d H:i:s');
            $foundUser->save();
            $session->u = $foundUser;
            return true;
        }
        return false;
    }


}