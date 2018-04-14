/**

<?php
// define variables and set to empty values

error_reporting(-1);
ini_set('display_errors', 'On');

$username = $password = $email = $firstName = $lastName = $phone = $DOB = "";

if($_POST && isset($_POST['sendfeedback'], $_POST['username'], $_POST['password'], $_POST['email'], $_POST['first_name'], $_POST['last_name'], $_POST['phone'], $_POST['dob'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $firstName = $_POST["first_name"];
    $lastName = $_POST["last_name"];
    $phone = $_POST["phone"];
    $DOB = $_POST["dob"];

    //new Users().createUser($username, $password, $email, $firstName, $lastName, $phone, $DOB);
}

function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>