<?php
require 'php/Config.php';

error_reporting(-1);
ini_set('display_error', 'On');


/**
 * Author: Tom Geraghty
 * Date: 09/04/2018
 */

class Users {
    private static $tableName = "users";

    /*
     * Adds a new event to the database.
     */
    public static function createUser($username, $password, $email, $firstName, $lastName, $phone, $DOB) {
        $config = new Config();

        Config::getDatabase()->addRecord(self::$tableName, ["username" => $username, "password" => $password, "email" => $email, "first_name" => $firstName, "last_name" => $lastName, "phone" => $phone, "DOB" => $DOB]);
    }

    /*
     * Updates user
     */
    public static function updateUser($userID, $data) {
        Config::getDatabase().deleteRecord(self::$tableName, $userID, $data);
    }

    /*
     * Deletes user
     */
    public static function deleteUser($userID) {
        Config::getDatabase().deleteRecord(self::$tableName, $userID);
    }
}
?>
