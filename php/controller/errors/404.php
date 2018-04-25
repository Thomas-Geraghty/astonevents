<?php

require_once ($_SERVER["DOCUMENT_ROOT"]) . '/php/controller/errors/ErrorInterface.php';

class error404 implements ErrorInterface {

    public function errorTitle() {
        return "Error: 404 - Page Not Found";
    }

    public function errorMessage() {
        return "Oops, this page does not exist! Please check the link you followed, or return home. :) ";
    }
}
?>