<?php
/**
 * Author: Tom Geraghty
 * Date: 09/04/2018
 */

require_once ($_SERVER["DOCUMENT_ROOT"]) . '/php/Config.php';
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/php/controller/Interaction.php';

class Events
{

    private static $eventsTable = "events";
    private static $photosTable = "event_photos";
    private static $photosDir = 'event_photos/';

    /*
     * Adds a new event to the database.
     */
    public static function createEvent($name, $type, $dateTime, $location, $description)
    {
        return Config::getDatabase()->addRecord(self::$eventsTable, ["event_name" => $name, "event_type" => $type, "event_time" => $dateTime, "event_location" => $location, "event_description" => $description, "event_organiser" => $_SESSION['userID']]);
    }

    /*
     * Updates event.
     */
    public static function updateEvent($eventID, $data) {
        Config::getDatabase()->updateRecord(self::$eventsTable, $data, ['id' => $eventID]);
    }

    /*
     * Remves an new event to the database.
     */
    public static function removeEvent($eventID)
    {
        Config::getDatabase()->deleteRecord(self::$photosTable, ["event_id" => $eventID]);
        Config::getDatabase()->deleteRecord(self::$eventsTable, ["id" => $eventID]);
    }

    public static function likeEvent($eventID) {
        $likeAmount = Config::getDatabase()->fetchRecord(self::$eventsTable, ['event_likes'], ['id' => $eventID])->fetch();
        $newAmount = $likeAmount['event_likes'] + 1;
        self::updateEvent($eventID, ['event_likes' => $newAmount]);
    }

    public static function uploadEventPhoto($eventID, $file) {
        $file_format = pathinfo($file['name'], PATHINFO_EXTENSION);
        $tmp_filename = md5(time().$file['name']);
        $upload_dir = self::$photosDir . $eventID . '/';

        if(!is_dir(self::$photosDir .$eventID.'/')) {
            mkdir(self::$photosDir .$eventID.'/');
        }

        $full_path = $upload_dir . '/' . $tmp_filename . '.' . $file_format;

        move_uploaded_file($file['tmp_name'], $full_path);
        Config::getDatabase()->addRecord(self::$photosTable, ["event_id" => $eventID, "file_location" => $full_path]);
    }
}
?>

<?php
if (isset($_POST['event_submit'])):
    $whitelist = array('event_name', 'event_type', 'event_time', 'event_location', 'event_description');
    $postData = Interaction::sanitizeTextInputs($whitelist, $_POST);
    $whitelist = array('event_image1', 'event_image2', 'event_image3');

    array_push($postData, Interaction::sanitizeImageInputs($whitelist, $_POST));

    $id = Events::createEvent($postData['event_name'], $postData['event_type'], $postData['event_time'], $postData['event_location'], $postData['event_description']);

    if (isset($_FILES['event_image1']) && strlen($_FILES['event_image1']['name']) > 0) {
        Events::uploadEventPhoto($id, $_FILES['event_image1']);
    }
    if (isset($_FILES['event_image2']) && strlen($_FILES['event_image2']['name']) > 0)  {
        Events::uploadEventPhoto($id, $_FILES['event_image2']);
    }
    if (isset($_FILES['event_image3']) && strlen($_FILES['event_image3']['name']) > 0)  {
        Events::uploadEventPhoto($id, $_FILES['event_image3']);
    }
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

if (isset($_POST['event_like'])):
    Events::likeEvent($_POST['event_id']);
endif;
?>
