/**
* Author: Tom Geraghty
* Date: 09/04/2018
*/

<?php

class Users {

    private static $tableName = "users";

    /*
     * Adds a new event to the database.
     */
    public static function createUser($username, $password, $email, $firstName, $lastName, $DOB) {
        Config::getDatabase().addRecord(self::$tableName, ["username" => $username, "password" => $password, "email" => $email, "first_mame" => $firstName, "last_name" => $lastName, "DOB" => $DOB]);
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
