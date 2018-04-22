<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 16/04/2018
 * Time: 18:22
 */

require_once 'php/controller/account/Account.php';

class Signup extends Account {

    private $username = '';
    private $password = '';
    private $email ="";
    private $firstName = "";
    private $lastName = "";
    private $phone = "";
    private $dob = "";

    function submitted() {
        $salt = parent::generateSalt(16);
        $hash = parent::hashPassword($this->password, $salt);

        Users::createUser($this->username, $hash, $salt, $this->email, $this->firstName, $this->lastName, $this->phone, $this->dob);
    }

    function sign_up($username, $password, $email, $firstName, $lastName, $phone, $dob) {
        $this->username = parent::sanitizeInput($username);
        $this->password = parent::sanitizeInput($password);
        $this->email = parent::sanitizeInput($email);
        $this->firstName = parent::sanitizeInput($firstName);
        $this->lastName = parent::sanitizeInput($lastName);
        $this->phone = parent::sanitizeInput($phone);
        $this->dob = parent::sanitizeInput($dob);
        $this->submitted();
    }
}
?>

<?php
if (isset($_POST['signup_submitted'])): //this code is executed when the form is submitted
    $signup = new Signup();

    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];

    $signup->sign_up($username, $password, $email, $firstName, $lastName, $phone, $dob);
    $signup->submitted();
    header("Location: myEvents.php");
endif;
?>