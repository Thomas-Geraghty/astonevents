function log_out(val) {
    $.post('php/controller/account/Auth.php', {'logout_submitted': val}, function (data) {
        window.location.replace('index.php');
    });
}