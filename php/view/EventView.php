<?php

/**
 * Author: Tom Geraghty
 * Date: 09/04/2018
 */

require_once ($_SERVER["DOCUMENT_ROOT"]) . '/php/Config.php';

class EventView {

    public static function displayEvent($eventID) {
        $eventData = Config::getDatabase()->fetchRecord("events", "*", ['id' => $eventID])->fetch();
        if($eventData == false) {
            return false;
        }

        $organiserData = Config::getDatabase()->fetchRecord("users", ['first_name', 'last_name', 'email', 'phone'], ['id' => $eventData['event_organiser']])->fetch();
        $photos = Config::getDatabase()->fetchRecord("event_photos", ['file_location'], ['event_id' => $eventID])->fetchall();
        $array = array_merge($eventData, $organiserData);
        $array['photos'] = $photos;
        return $array;
    }

    public static function displayMyEvents($userID) {
        return Config::getDatabase()->fetchRecord("events", "*", ['event_organiser' => $userID])->fetchAll();
    }

    public static function displayCategoryEvents($category) {
        return Config::getDatabase()->fetchRecord("events", "*", ['event_type' => $category])->fetchAll();
    }

    public static function displayAllEvents() {
        return Config::getDatabase()->fetchRecord("events", "*", [])->fetchAll();
    }
}
?>

<?php
if (isset($_GET['request_type'])):
    if($_GET['request_type'] == 1) {
        echo json_encode(EventView::displayAllEvents());
    }
    if($_GET['request_type'] == 2) {
        if (isset($_GET['user_ID'])) {
            echo json_encode(EventView::displayMyEvents($_GET['user_ID']));
        }
    }
    if($_GET['request_type'] == 3) {
        if (isset($_GET['event_ID'])) {
            echo json_encode(EventView::displayEvent($_GET['event_ID']));
        }
    }
    if($_GET['request_type'] == 4) {
        if (isset($_GET['category'])) {
            echo json_encode(EventView::displayCategoryEvents($_GET['category']));
        }
    }
endif;
?>
