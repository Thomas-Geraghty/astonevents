<?php
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/php/model/Config.php';


/**
 * Author: Tom Geraghty
 * Date: 09/04/2018
 */

class Users {
    private static $tableName = "users";

    /*
     * Adds a new event to the database.
     */
    public static function createUser($username, $hash, $salt, $email, $firstName, $lastName, $phone, $dob) {
        Config::getDatabase()->addRecord(self::$tableName, ["username" => $username, "hash" => $hash, 'salt' => $salt, "email" => $email, "first_name" => $firstName, "last_name" => $lastName, "phone" => $phone, "dob" => $dob]);
    }

    /*
     * Updates user
     */
    public static function updateUser($userID, $data) {
        Config::getDatabase().deleteRecord(self::$tableName, $userID, $data);
    }

    public static function fetchUser($columns, $where) {
        return Config::getDatabase()->fetchRecord(self::$tableName, $columns, $where);;
    }

    /*
     * Deletes user
     */
    public static function deleteUser($userID) {
        Config::getDatabase().deleteRecord(self::$tableName, $userID);
    }
}
?>
