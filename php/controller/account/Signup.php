<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 16/04/2018
 * Time: 18:22
 */

require_once ($_SERVER["DOCUMENT_ROOT"]) . '/php/controller/account/Account.php';
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/php/controller/account/Auth.php';


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

        return Users::createUser($this->username, $hash, $salt, $this->email, $this->firstName, $this->lastName, $this->phone, $this->dob);
    }

    function sign_up($username, $password, $email, $firstName, $lastName, $phone, $dob) {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->phone = $phone;
        $this->dob = $dob;
        return $this->submitted();
    }
}
?>

<?php
$usernameErr = $emailErr = $firstnameErr = $lastnameErr = $phoneErr = $dobErr = "";

if (isset($_POST['signup_submitted'])): //this code is executed when the form is submitted
    $whitelist = array('username', 'password', 'email', 'first_name', 'last_name', 'phone', 'dob');
    $postData = Interaction::sanitizeTextInputs($whitelist, $_POST);
    $validationFailed = 'false';

    if (!preg_match('/^[A-Za-z][A-Za-z0-9]{0,31}$/', $postData['username'])) {
        $usernameErr = "Username must be only A-Z, 0-9. Maximum of 32 characters";
        $validationFailed = 'true';
    }

    if(Users::fetchUser(['username'], ['username' => $postData['username']])->fetch()[0] != null) {
        $usernameErr = "Username already taken";
        $validationFailed = 'true';
    }

    if (!filter_var($postData['email'], FILTER_VALIDATE_EMAIL) && strlen($postData['email']) < 255) {
        $emailErr = "Email address not valid. Maximum 255 characters";
        $validationFailed = 'true';
    }
    if (!preg_match('/^[A-Za-z]{0,31}$/', $postData['first_name'])) {
        $firstnameErr = "First name must be only A-Z. Maximum of 32 characters";
        $validationFailed = 'true';
    }
    if (!preg_match('/^[A-Za-z]{0,31}$/', $postData['last_name'])) {
        $lastnameErr = "Last name must be only A-Z. Maximum of 32 characters";
        $validationFailed = 'true';
    }
    if (!preg_match('/^[0-9]{0,15}$/', $postData['phone'])) {
        $phoneErr = "Phone must be only number. Maximum of 15 characters";
        $validationFailed = 'true';
    }
    if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $postData['dob'])) {
        $dobErr = "DOB must be valid YYYY-MM-DD.";
        $validationFailed = 'true';
    }


    if ($validationFailed == 'false') {
        $signup = new Signup();
        $signup->sign_up($postData['username'], $postData['password'], $postData['email'],
            $postData['first_name'], $postData['last_name'], $postData['phone'], $postData['dob']);

        $login = new Auth();
        $login->log_in($postData['username'], $postData['password']);
    }
endif;

if (isset($_POST['usernameStr'])):
    $whitelist = array('usernameStr');
    $postData = Interaction::sanitizeTextInputs($whitelist, $_POST);

    $match = Users::fetchUser(['username'], ['username' => $postData['usernameStr']])->fetch();

    //username available
    if($match[0] == null) {
        echo 0;
    } //username taken
    else {
        echo 1;
    }
endif;
?>