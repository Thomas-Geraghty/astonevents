<?php
session_start();

require_once ($_SERVER["DOCUMENT_ROOT"]) . '/php/model/elements/Session.php';
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/php/view/EventView.php';
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/php/controller/event/Events.php';
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/eventDisplay.js"></script>

<?php if(isset($_GET['eventID'])):
        if(isset($_SESSION['sessionStatus'])): ?>
            <body onload="displayEvent(<?php echo $_GET['eventID'] . ", " . $_SESSION['userID'] ?>)">
            <script src="js/eventEdit.js"></script>
            <?php else: ?>
            <body onload="displayEvent(<?php echo $_GET['eventID'] ?>)">
        <?php endif ?>
<?php elseif(isset($_SESSION['sessionStatus'])): ?>
        <body onload="selectedEventView('all-events-label')">
        <script src="js/eventEdit.js"></script>
<?php else: ?>
        <body onload="selectedEventView('all-events-label')">
<?php endif ?>


<!-- Header -->
<?php include "structure/header.php"; ?>

<div id="content">
    <div class="container">
        <div id="eventView-Large" class="content-inner dark">
            <div id="eventView">
                <h2 id='eventTitle' class='title'>Events</h2>
                <div id="event-view-selectors">
                    <h3 id="all-events-label" class='selectable-title' onclick='selectedEventView(this.id, 0)'>All events</h3>
                    <?php if(isset($_SESSION['sessionStatus'])): ?>
                    <h3 id="my-events-label"  class='selectable-title' onclick='selectedEventView(this.id, <?php echo $_SESSION['userID'] ?>)'>My events</h3>
                    <?php endif; ?>
                </div>
                <div id="event-category-selectors">
                    <h4 id="all-events-label" class='selectable-title' onclick="filterTable('All')">All</h4>
                    <h4 id="all-events-label" class='selectable-title' onclick="filterTable('Sport')">Sports</h4>
                    <h4 id="all-events-label" class='selectable-title' onclick="filterTable('Culture')">Culture</h4>
                    <h4 id="all-events-label" class='selectable-title' onclick="filterTable('Other')">Other</h4>
                </div>
                <div id="event-table"></div>
                <?php if(isset($_SESSION['sessionStatus'])): ?>
                    <a id="add-event-button" class="button" onclick="addEvent()">Add event</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include 'structure/footer.php' ?>

</body>
</html>