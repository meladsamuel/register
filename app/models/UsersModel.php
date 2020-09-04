<?php

namespace app\models;

use app\lib\SessionManager;

class UsersModel extends AbstractModel
{
    public $id;
    public string $username;
    public string $email;
    public string $password;
    public string $reg_date;
    public int $group_id;

    protected static string $tableName = 'users';
    protected static string $primaryKey = 'id';
    protected static array $tableSchema = array(
        'id' => self::DATA_TYPE_INT,
        'username' => self::DATA_TYPE_STR,
        'email' => self::DATA_TYPE_STR,
        'password' => self::DATA_TYPE_STR,
        'reg_date' => self::DATA_TYPE_STR,
        'group_id' => self::DATA_TYPE_INT,
    );

    public function cryptPassword($password)
    {
        $this->password = crypt($password, APP_SALT);
    }

    public static function getUsers($user)
    {
        return self::get(
            'SELECT * FROM ' . self::$tableName . ' WHERE id != ' . $user
        );
    }

    public static function userExisting($username)
    {
        return self::get(
            'SELECT * FROM ' . self::$tableName . ' WHERE username = "' . $username . '"'
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
            $foundUser->last_login = date('Y-m-d H:i:s');
            $foundUser->save();
            $session->u = $foundUser;
            return true;
        }
        return false;
    }


}