<?php
session_start();

require_once 'php/model/elements/Session.php';
require_once 'php/view/EventView.php';
error_reporting(-1);
ini_set('display_error', 'On');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Aston Events</title>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <meta name="theme-color" content="#0086e7">
    <link rel="stylesheet" type="text/css" href="./css/sitewide.css">
</head>

<body>

<?php echo $_SESSION['userID']; ?>
<?php echo $_SESSION['sessionStatus']; ?>

<?php include "structure/navbar.php"; ?>
<script src="js/events.js"></script>


<!-- Header -->
<div id="header" class="bg">
    <div class="container">
        <div class="section-header">
            <h1 id="name-big">ASTON<h1 id="name-small">events</h1></h1>
        </div>
        <div class="header-content" style="top: 20%; width: 100%;">
            <div class="content-inner light">
                <div style="margin-right: 1.5em">
                    <h3 class="title">Edit Events</h3>
                </div>
                <table id="eventOptons" class="table">
                    <tr>
                        <td onclick="eventsView()">View Events</td>
                    </tr>
                    <tr>
                        <td onclick="addEventView()">Add Event</td>
                    </tr>
                    <tr>
                        <td>Edit Event</td>
                    </tr>
                    <tr>
                        <td>Delete Event</td>
                    </tr>
                </table>
            </div>
            <div class="content-inner dark">
                <div style="margin-right: 1.5em">
                    <h3 id="eventTitle" class="title">Your Events</h3>
                </div>
                <div id="eventView">
                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'structure/footer.php' ?>

<!-- Misc -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/navbar.js"></script>
<script src="js/event_info.js"></script>
<script src="js/expand-element.js"></script>
</body>
</html>