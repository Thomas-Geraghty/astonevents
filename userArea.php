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

<body onload="displayMyEvents(<?php echo $_SESSION['userID'] ?>)">

<?php include "structure/navbar.php"; ?>
<script src="js/events.js"></script>

<!-- Header -->
<div id="header" class="bg">
    <div class="container">
        <div id="logo" onclick="window.location.href='index.php'">
            <h1>ASTON</h1>
            <h2>events</h2>
        </div>
        <div class="header-content" style="top: 20%; width: 100%;">
            <div class='right dark'>
                <div>
                    <h2 class="title" id="eventTitle">Loading...</h2>
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
</body>
</html>