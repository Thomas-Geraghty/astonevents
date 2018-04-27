<?php
/**
 * Author: Tom Geraghty
 * Date: 09/04/2018
 */

require_once ($_SERVER["DOCUMENT_ROOT"]) . '/php/model/Config.php';
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/php/controller/Interaction.php';
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/php/controller/Session.php';

class Events
{
    private static $eventsTable = "events";
    private static $photosTable = "event_photos";
    private static $photosDir =  'event_photos/';

    /*
     * Adds a new event to the database.
     */
    public static function createEvent($name, $type, $dateTime, $location, $description, $eventOrganiser) {
        return Config::getDatabase()->addRecord(self::$eventsTable, ["event_name" => $name, "event_type" => $type, "event_time" => $dateTime, "event_location" => $location, "event_description" => $description, "event_organiser" => $eventOrganiser]);
    }

    /*
     * Updates event.
     */
    public static function updateEvent($eventID, $data) {
        $event = Config::getDatabase()->fetchRecord(self::$eventsTable, ['event_organiser'], ["id" => $eventID])->fetch();
        if($event['event_organiser'] == $_SESSION['userID']) {
            Config::getDatabase()->updateRecord(self::$eventsTable, $data, ['id' => $eventID]);
        } else {
            header('Location: error.php?e=403');
        }
    }

    /*
     * Remves an new event to the database.
     */
    public static function removeEvent($eventID) {
        $event = Config::getDatabase()->fetchRecord(self::$eventsTable, ['event_organiser'], ["id" => $eventID])->fetch();
        if($event['event_organiser'] == $_SESSION['userID']) {
            Config::getDatabase()->deleteRecord(self::$photosTable, ["event_id" => $eventID]);
            Config::getDatabase()->deleteRecord(self::$eventsTable, ["id" => $eventID]);
        } else {
            header('Location: error.php?e=403');
        }
    }

    public static function likeEvent($eventID) {
        $event = Config::getDatabase()->fetchRecord(self::$eventsTable, ['event_likes'], ['id' => $eventID])->fetch();
        $newAmount = ($event['event_likes'] + 1);
        Config::getDatabase()->updateRecord(self::$eventsTable, ['event_likes' => $newAmount], ['id' => $eventID]);
    }

    public static function uploadEventPhoto($eventID, $file) {
        $file_format = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = md5(time().$file['name']). '.' . $file_format;
        $site_path = self::$photosDir . $eventID;
        $upload_dir = $_SERVER["DOCUMENT_ROOT"] . '/' . $site_path;

        if(!is_dir($upload_dir.'/')) {
            mkdir($upload_dir.'/');
        }

        $full_path = $upload_dir . '/' . $filename;
        move_uploaded_file($file['tmp_name'], $full_path);

        Config::getDatabase()->addRecord(self::$photosTable, ["event_id" => $eventID, "file_location" => $site_path.'/'.$filename]);
    }

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

    public static function displayAllEvents() {
        return Config::getDatabase()->fetchRecord("events", "*", [])->fetchAll();
    }
}
?>
<?php
$eventNameErr = $eventTypeErr = $eventLocationErr = "";

if (isset($_GET['request_type'])):
    if($_GET['request_type'] == 1) {
        echo json_encode(Events::displayAllEvents());
    }
    if($_GET['request_type'] == 2) {
        if (isset($_GET['user_ID'])) {
            echo json_encode(Events::displayMyEvents($_GET['user_ID']));
        }
    }
    if($_GET['request_type'] == 3) {
        if (isset($_GET['event_ID'])) {
            echo json_encode(Events::displayEvent($_GET['event_ID']));
        }
    }
endif;

if (isset($_POST['event_submit'])):
    $whitelist = array('event_name', 'event_type', 'event_time', 'event_location', 'event_description');
    $postData = Interaction::sanitizeTextInputs($whitelist, $_POST);
    $validationFailed = 'false';

    array_push($postData, Interaction::sanitizeImageInputs($whitelist, $_FILES));

    if (!(strlen($postData['event_name']) > 0 && strlen($postData['event_name']) < 256)) {
        $validationFailed = 'true';
    }

    if (!($postData['event_type'] === 'Sport' || $postData['event_type'] === 'Culture' || $postData['event_type'] === "Other")) {
        echo $validationFailed = 'true';
    }

    if (!(strlen($postData['event_location']) > 0 && strlen($postData['event_location']) < 512)) {
        $validationFailed = 'true';
    }

    if ($validationFailed == 'false') {
        $whitelist = array('event_image1', 'event_image2', 'event_image3');

        $id = Events::createEvent($postData['event_name'], $postData['event_type'], $postData['event_time'], $postData['event_location'], $postData['event_description'], $_SESSION['userID']);

        if (isset($_FILES['event_image1']) && strlen($_FILES['event_image1']['name']) > 0) {
            Events::uploadEventPhoto($id, $_FILES['event_image1']);
        }
        if (isset($_FILES['event_image2']) && strlen($_FILES['event_image2']['name']) > 0) {
            Events::uploadEventPhoto($id, $_FILES['event_image2']);
        }
        if (isset($_FILES['event_image3']) && strlen($_FILES['event_image3']['name']) > 0) {
            Events::uploadEventPhoto($id, $_FILES['event_image3']);
        }
    }
endif;
if (isset($_POST['event_like'])):
    Events::likeEvent($_POST['event_id']);
endif;

if (isset($_POST['event_delete'])):
    $whitelist = array('event_ID');
    $postData = Interaction::sanitizeTextInputs($whitelist, $_POST);
    Events::removeEvent($postData['event_ID']);
endif;
if (isset($_POST['event_edit'])):
    $whitelist = array('id', 'event_name', 'event_type', 'event_time', 'event_location', 'event_description');
    $postData = Interaction::sanitizeTextInputs($whitelist, $_POST);

    Events::updateEvent($postData['id'], ['event_name' => $postData['event_name'], 'event_type' => $postData['event_type'], 'event_time' => $postData['event_time'], 'event_location' => $postData['event_location'], 'event_description' => $postData['event_description']]);
endif;
?>


