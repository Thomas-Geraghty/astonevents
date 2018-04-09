/**
* Author: Tom Geraghty
* Date: 09/04/2018
*/
<?php

class Event {

    private $eventName;
    private $userUD;
    private $date;

    public function __construct($eventName, $userID, $date) {
        $this->eventName = $eventName;
        $this->userUD = $userID;
        $this->date = $date;

        Config::getDatabase().addData("events", ["event_name" => $eventName, "user_id" => $userID, "date" => $date]);
    }
}

?>
