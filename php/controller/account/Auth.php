<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 16/04/2018
 * Time: 18:22
 */

require_once ($_SERVER["DOCUMENT_ROOT"]) . '/php/controller/account/Account.php';

class Auth extends Account {

    private $username = '';
    private $password = '';
    private $hash = "";

    function submitted() {
        $userSalt = Users::fetchUser(['salt'], ['username' => $this->username])->fetch();
        $this->hash = parent::hashPassword($this->password, $userSalt[0]);

        $user = Users::fetchUser(['id', 'username', 'hash'], ['hash' => $this->hash])->fetch();
        if($user[2] === $this->hash) {
            Session::createSession($user[0]);
            return true;
        } else {
            return false;
        }
    }

    function log_in($username, $password) {
        $this->username = $username;
        $this->password = $password;
        return $this->submitted();
    }

    function log_out() {
        Session::deleteSession(session_id());
    }
}
?>

<?php
if (isset($_POST['login_submitted'])): //this code is executed when the form is submitted
    $whitelist = array('login-username', 'login-password');
    $postData = Interaction::sanitizeTextInputs($whitelist, $_POST);

    $auth = new Auth();
    if($auth->log_in($postData['login-username'], $postData['login-password'])) {
    }
endif;
if (isset($_POST['logout_submitted'])): //this code is executed when the form is submitted

    $auth = new Auth();
    $auth->log_out();
endif;
?>