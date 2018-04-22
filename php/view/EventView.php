<?php

/**
 * Author: Tom Geraghty
 * Date: 09/04/2018
 */

require_once 'php/view/View.php';


class EventView implements View
{

    public function display()
    {
        $lol = Config::getDatabase()->fetchRecord("events", "*", ['event_organiser' => $_SESSION['userID']]);

        foreach ($lol as $row) {
            echo "<tr class='eventRow' onclick='myFunction();'>
                    <td>" . $row['event_name'] . "</td> 
                    <td>" . $row['event_type'] . "</td>
                    <td>" . $row['event_time'] . "</td>
                    <td>" . $row['event_location'] . "</td>
                </tr>
            ";
        }
    }
}
?>
