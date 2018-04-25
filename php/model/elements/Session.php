<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 16/04/2018
 * Time: 17:13
 */

require_once ($_SERVER["DOCUMENT_ROOT"]) . '/php/model/Config.php';

class Session {

    private static $tableName = "sessions";

    public static function createSession($userID) {
        Config::getDatabase()->addRecord(self::$tableName, ['session_id' => session_id(), 'user_id' => $userID]);
        $_SESSION['userID'] = $userID;
        $_SESSION['sessionStatus'] = 1; //logged in
    }

    public static function deleteSession() {
        session_start();
        Config::getDatabase()->deleteRecord(self::$tableName, ['session_id' => session_id()]);
        session_unset();
        session_destroy();
    }
}
?>