<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 16/04/2018
 * Time: 17:13
 */

require_once 'php/Config.php';
error_reporting(-1);
ini_set('display_error', 'On');

//echo print_r($_SESSION);
//echo session_id();

class Session {

    private static $tableName = "sessions";

    public static function setSessionUserID($userID) {
        Config::getDatabase()->addRecord(self::$tableName, ['sessionID' => session_id(), 'userID' => $userID]);
        $_SESSION['userID'] = $userID;
        $_SESSION['sessionStatus'] = 2;
    }

    public static function deleteSession($sessionID) {
        Config::getDatabase()->deleteRecord(self::$tableName, ['sessionID' => session_id()]);
        session_unset();
        session_destroy();
    }
}
?>