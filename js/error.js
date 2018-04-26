function errorMsg($errorCode) {
    $.get('/view/errors/ErrorHandler.php', {'error': $errorCode}, function (data) {
        var obj = JSON.parse(data);

        $('#errorTitle').html(obj['errorTitle']);
        $('#errorMessage').html(obj['errorMessage']);
    });
}