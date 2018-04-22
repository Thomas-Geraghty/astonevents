<?php
/**
 * Created by IntelliJ IDEA.
 * User: Tom
 * Date: 20/04/2018
 * Time: 17:41
 */

require_once 'php/model/elements/Session.php';
require_once 'php/model/elements/Users.php';


abstract class Account{

    abstract function submitted();

    protected function sanitizeInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    protected function generateSalt($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $max = mb_strlen($characters) - 1;
        for ($i = 0; $i < $length; ++$i) {
            $parts[] = $characters[random_int(0, $max)];
        }
        return implode('', $parts);
    }

    protected function hashPassword($password, $salt) {
        return hash('sha256', $password.$salt);
    }
}
?>