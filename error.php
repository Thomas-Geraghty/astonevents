<?php
session_start();

define('BASEPATH', $_SERVER["DOCUMENT_ROOT"]);

require_once BASEPATH . '/php/model/elements/Session.php';
require_once BASEPATH . '/php/controller/account/Signup.php';
require_once BASEPATH . '/php/controller/account/Auth.php';
require_once BASEPATH . '/php/Config.php';
require_once BASEPATH . '/php/controller/errors/ErrorHandler.php';


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

<script src="js/error.js"></script>

<?php if(isset($_GET['e'])): ?>
<body onload="errorMsg(<?php echo $_GET['e'] ?>)">
<?php endif; ?>

<!-- Header -->
<?php include "structure/header.php"; ?>


<div id="content">
    <div class="container">
        <div id="eventView-Large" class="content-inner dark">
            <div>
                <h2 id='errorTitle' class='title'></h2>
                <h3 id="errorMessage"></h3>
            </div>
        </div>
    </div>
</div>


<?php include 'structure/footer.php' ?>

<!-- Misc -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/Signup.js"></script>
</body>
</html>