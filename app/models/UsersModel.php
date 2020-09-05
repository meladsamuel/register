<?php

namespace app\models;

use app\lib\SessionManager;

class UsersModel extends AbstractModel
{
    public $id;
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $password;
    public string $phone;
    public string $address;

    protected static string $tableName = 'users';
    protected static string $primaryKey = 'id';
    protected static array $tableSchema = [
        'id' => self::DATA_TYPE_INT,
        'firstName' => self::DATA_TYPE_STR,
        'lastName' => self::DATA_TYPE_STR,
        'email' => self::DATA_TYPE_STR,
        'password' => self::DATA_TYPE_STR,
        'phone' => self::DATA_TYPE_STR,
        'address' => self::DATA_TYPE_INT,
    ];

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

    public static function userExisting($email)
    {
        return self::get(
            'SELECT * FROM ' . self::$tableName . ' WHERE email = "' . $email . '"'
        );
    }

    /**
     * @param string $email
     * @param string $password
     * @param SessionManager $session
     * @return bool
     */
    public static function authenticate(string $email, string $password, SessionManager $session)
    {
        $password = crypt($password, APP_SALT);
        $foundUser = self::getOne(
            'SELECT * FROM ' . self::$tableName . ' WHERE email = "' . $email . '" AND ' . 'password = "' . $password . '"'
        );
        if ($foundUser) {
            $session->user = $foundUser;
            return true;
        }
        return false;
    }


}