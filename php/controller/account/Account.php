<?php
/**
 * Created by IntelliJ IDEA.
 * User: Tom
 * Date: 20/04/2018
 * Time: 17:41
 */

require_once ($_SERVER["DOCUMENT_ROOT"]) . '/php/controller/Interaction.php';
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/php/controller/account/Users.php';


abstract class Account extends Interaction {

    abstract function submitted();

    protected function generateSalt($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $max = strlen($characters) - 1;
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