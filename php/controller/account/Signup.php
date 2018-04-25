<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 16/04/2018
 * Time: 18:22
 */

require_once ($_SERVER["DOCUMENT_ROOT"]) . '/php/controller/account/Account.php';

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
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->phone = $phone;
        $this->dob = $dob;
        $this->submitted();
    }
}
?>

<?php
if (isset($_POST['signup_submitted'])): //this code is executed when the form is submitted
    $whitelist = array('username', 'password', 'email', 'first_name', 'last_name', 'phone', 'dob');
    $postData = Interaction::sanitizeTextInputs($whitelist, $_POST);

    $signup = new Signup();

    $signup->sign_up($postData['username'], $postData['password'], $postData['email'],
        $postData['first_name'], $postData['last_name'], $postData['phone'], $postData['dob']);
endif;

if (isset($_POST['usernameStr'])):
    $whitelist = array('usernameStr');
    $postData = Interaction::sanitizeTextInputs($whitelist, $_POST);

    $match = Users::fetchUser(['username'], ['username' => $postData['usernameStr']])->fetch();

    if($match[0] == null) {
        echo 1;
    }
endif;
?>