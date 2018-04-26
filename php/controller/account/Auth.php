<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 16/04/2018
 * Time: 18:22
 */

require_once ($_SERVER["DOCUMENT_ROOT"]) . '/php/controller/account/Account.php';
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/php/controller/Session.php';

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
            return 0;
        }
    }

    function log_in($username, $password) {
        $this->username = $username;
        $this->password = $password;
        return $this->submitted();
    }

    function log_out() {
        Session::deleteSession();
    }
}
?>

<?php
if (isset($_POST['login'])):
    $whitelist = array('username', 'password');
    $postData = Interaction::sanitizeTextInputs($whitelist, $_POST);
    $auth = new Auth();
    echo $auth->log_in($postData['username'], $postData['password']);
endif;

if (isset($_POST['logout'])):
    $auth = new Auth();
    $auth->log_out();
endif;
?>