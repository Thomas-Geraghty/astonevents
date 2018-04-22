<?php
/**
 * Author: Tom Geraghty
 * Date: 09/04/2018
 */

require_once 'php/Config.php';


class Events {

    private static $tableName = "events";

    /*
     * Adds a new event to the database.
     */
    public static function createEvent($name, $type, $dateTime, $location, $description) {
        //TODO: set event_organiser to ID of user cookie.
        Config::getDatabase()->addRecord(self::$tableName, ["event_name" => $name, "event_type" => $type, "event_time" => $dateTime, "event_location" => $location, "event_description" => $description, "event_organiser" => '1']);
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
