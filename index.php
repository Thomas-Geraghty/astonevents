<?php
session_start();

require_once 'php/model/elements/Session.php';
require_once 'php/controller/Signup.php';
require_once 'php/controller/Auth.php';
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
<script src="js/Login.js"></script>

<?php include "structure/navbar.php"; ?>

<!-- Header -->
<div id="header" class="bg">
    <div class="pattern"></div>
    <div class="container">
        <div class="section-header">
            <h1 id="name-big">ASTON</h1>
            <h1 id="name-small">events</h1>
        </div>
        <div class="header-content" style="top: 30%; position: absolute; width: 70%;">
            <div style="
                display: inline-block;
                padding-right: 10%;
                padding-top: 2%;
                float: left;
                width: 30%;
                top: 15%;">
                <h3 class="caption">Create your own events, contact organisers and more!</h3>
                <br><br><br>
                <h3 class="caption" id="caption-link"><a href="index.php"> See all events</a></h3>
            </div>
            <div style="
                display: inline-block;
                width: 50%;
                padding: 2%;
                background-color: rgba(6,33,49,0.70);">
                <h3 class="caption">Sign up now</h3>
                <div id="signup-form" style="padding-top: 2%;">
                    <form id="signup-table" method="POST">
                        <table>
                            <tr>
                                <td><h4 class="label">Username:</h4></td>
                                <td><input name="username" class="form" type="text" maxlength="32"
                                           placeholder="Username" onkeyup="checkUsername(this.value)" required></td>
                                <td><h4 id="usernameMarker"></h4></td>
                            </tr>
                            <tr>
                                <td><h4 class="label">Password:</h4></td>
                                <td><input name="password" class="form" type="password" maxlength="32"
                                           placeholder="Password" required></td>
                            </tr>
                            <tr>
                                <td><h4 class="label">Email Address:</h4></td>
                                <td><input name="email" class="form" type="email" maxlength="254"
                                           placeholder="tom@example.com" required></td>
                            </tr>
                            <tr>
                                <td><h4 class="label">First Name:</h4></td>
                                <td><input name="first_name" class="form" type="text" maxlength="32"
                                           placeholder="First name" required></td>
                            </tr>
                            <tr>
                                <td><h4 class="label">Last Name:</h4></td>
                                <td><input name="last_name" class="form" type="text" maxlength="32"
                                           placeholder="Last name" required></td>
                            </tr>
                            <tr>
                                <td><h4 class="label">Phone Number:</h4></td>
                                <td><input name="phone" class="form" type="phone" placeholder="Phone" maxlength="15"
                                           required></td>
                            </tr>
                            <tr>
                                <td><h4 class="label">Date Of Birth:</h4></td>
                                <td><input name="dob" class="form" type="date" required></td>
                            </tr>
                        </table>
                        <input type="hidden" name="signup_submitted" value="1"/>
                        <input type="submit" class="linkButton" value="SIGN UP">
                    </form>
                </div>
            </div>
        </div>    </div>
</div>

<?php include 'structure/footer.php' ?>

<!-- Misc -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/smooth-scroll.js"></script>
<script src="js/expand-element.js"></script>
</body>
</html>