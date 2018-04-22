<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 16/04/2018
 * Time: 18:22
 */

require_once 'php/controller/account/Account.php';

class Auth extends Account {

    private $username = '';
    private $password = '';
    private $hash = "";

    function submitted() {
        $userSalt = Users::fetchUser(['salt'], ['username' => $this->username])->fetch();
        $this->hash = parent::hashPassword($this->password, $userSalt[0]);

        $user = Users::fetchUser(['id', 'username', 'hash'], ['hash' => $this->hash])->fetch();
        if($user[2] === $this->hash) {
            Session::setSessionUserID($user[0]);
            return true;
        } else {
            return false;
        }
    }

    function log_in($username, $password) {
        $this->username = parent::sanitizeInput($username);
        $this->password = parent::sanitizeInput($password);
        return $this->submitted();
    }

    function log_out() {
        Session::deleteSession(session_id());
    }
}
?>

<?php
if (isset($_POST['login_submitted'])): //this code is executed when the form is submitted
    $auth = new Auth();
    $username = $_POST['login-username'];
    $password = $_POST['login-password'];

    if($auth->log_in($username, $password)) {
        header("Location: myEvents.php");
    }
endif;
?>