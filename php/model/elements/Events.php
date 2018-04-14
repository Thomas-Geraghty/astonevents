/**
* Author: Tom Geraghty
* Date: 09/04/2018
*/
<?php

class Events {

    private static $tableName = "events";

    /*
     * Adds a new event to the database.
     */
    public static function createEvent($eventName, $userID, $date, $description) {
        Config::getDatabase().addData(self::$tableName, ["event_name" => $eventName, "user_id" => $userID, "date" => $date, "description" => $description]);
    }

    /*
     * Updates event.
     */
    public static function updateEvent($eventID, $data) {
        Config::getDatabase().updateRecord(self::$tableName, $eventID, $data);
    }

    /*
     * Remves an new event to the database.
     */
    public static function removeEvent($eventID) {
        Config::getDatabase().removeData(self::$tableName, ["event_ID" => $eventID]);
    }
}
?>
