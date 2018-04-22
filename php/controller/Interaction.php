<?php
/**
 * Created by IntelliJ IDEA.
 * User: Tom
 * Date: 22/04/2018
 * Time: 17:23
 */

abstract class Interaction {
    protected function sanitizeInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>