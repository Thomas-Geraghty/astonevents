<?php

require_once ($_SERVER["DOCUMENT_ROOT"]) . '/php/controller/errors/ErrorInterface.php';
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/php/controller/errors/404.php';
require_once ($_SERVER["DOCUMENT_ROOT"]) . '/php/controller/errors/403.php';

if (isset($_GET['error'])):
    if($_GET['error'] === '403') {
        $error = new error403();
        echo json_encode(['errorTitle' => $error->errorTitle() ,'errorMessage' => $error->errorMessage()]);
    }
    if($_GET['error'] === '404') {
        $error = new error404();
        $errorMsg = ['errorTitle' => $error->errorTitle() ,'errorMessage' => $error->errorMessage()];
        echo json_encode($errorMsg);
    }
    endif;
?>