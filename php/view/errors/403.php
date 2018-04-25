<?php

require_once ($_SERVER["DOCUMENT_ROOT"]) . '/php/view/errors/ErrorInterface.php';


class error403 implements ErrorInterface {
    public function errorTitle() {
        return "Error: 403 - Forbidden";
    }

    public function errorMessage()
    {
        return "Oops, you are forbidden from this accessing this page/editing this resource. 
        Please check your authorization. :) ";
    }
}
?>