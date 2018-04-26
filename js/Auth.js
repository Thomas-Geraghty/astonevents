function log_out() {
    if(confirm("Are you sure you want to log out?")) {
        $.post('/php/controller/account/Auth.php', {'logout': true}, function (data) {
            window.location.reload();
        });
    }
}


function log_in($username, $password) {
    $.post('/php/controller/account/Auth.php', {'login': true, 'username': $username, 'password': $password}, function (data) {
        window.location.reload();
    });
}