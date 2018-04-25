<?php
session_start();

if (isset($_SERVER['HTTPS'])) {
    $protocol = "https";
} else {
    $protocol = "http";
}
$base_url = $protocol . "://" . $_SERVER['HTTP_HOST'] . "/";
$base_path = $_SERVER['DOCUMENT_ROOT'] . "/";

define('BASEURL', $base_url);
define('BASEPATH', $base_path);
define('SITEURL', $base_url . "site/");
define('SITEPATH', $base_path . "site/");
define('REQUESTURL', $_SERVER['REQUEST_URI']);

require_once BASEPATH . 'php/model/elements/Session.php';
require_once BASEPATH . 'php/controller/account/Signup.php';
require_once BASEPATH . 'php/controller/account/Auth.php';
require_once BASEPATH . 'php/Config.php';

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

<!-- Navbar -->
<?php include "structure/navbar.php"; ?>


<!-- Header -->
<div id="header" class="bg">
    <div class="pattern"></div>
    <div class="container">
        <div id="logo" onclick="window.location.href='index.php'">
            <h1>ASTON</h1>
            <h2>events</h2>
        </div>
        <div class="header-content" style="top: 30%; position: absolute; width: 70%;">
            <div id="caption" class="left">
                <h2>Create your own events, contact organisers and more!</h2>
                <br><br><br>
                <h2 id="caption-link"><a class="content-link" href="index.php"> See all events</a></h2>
            </div>
            <div class="right dark">
                <h2 class="caption">Sign up now</h2>
                <div id="signup-form" style="padding-top: 2%;">
                    <form id="signup-table" method="POST">
                        <table>
                            <tr>
                                <td><h4>Username:</h4></td>
                                <td><input name="username" class="form" type="text" maxlength="32"
                                           placeholder="Username" onblur="liveUsernameSearch(this.value)" required></td>
                                <td><h4 id="usernameMarker"></h4></td>
                            </tr>
                            <tr>
                                <td><h4>Password:</h4></td>
                                <td><input name="password" class="form" type="password" maxlength="32"
                                           placeholder="Password" required></td>
                            </tr>
                            <tr>
                                <td><h4>Email Address:</h4></td>
                                <td><input name="email" class="form" type="email" maxlength="254"
                                           placeholder="tom@example.com" required></td>
                            </tr>
                            <tr>
                                <td><h4>First Name:</h4></td>
                                <td><input name="first_name" class="form" type="text" maxlength="32"
                                           placeholder="First name" required></td>
                            </tr>
                            <tr>
                                <td><h4>Last Name:</h4></td>
                                <td><input name="last_name" class="form" type="text" maxlength="32"
                                           placeholder="Last name" required></td>
                            </tr>
                            <tr>
                                <td><h4>Phone Number:</h4></td>
                                <td><input name="phone" class="form" type="phone" placeholder="Phone" maxlength="15"
                                           required></td>
                            </tr>
                            <tr>
                                <td><h4>Date Of Birth:</h4></td>
                                <td><input name="dob" class="form" type="date" required></td>
                            </tr>
                        </table>
                        <input type="hidden" name="signup_submitted" value="1"/>
                        <input type="submit" class="linkButton" value="SIGN UP">
                    </form>
                </div>
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