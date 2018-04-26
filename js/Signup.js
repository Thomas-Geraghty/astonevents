function usernameCheck(val) {
    $.post('php/controller/account/Signup.php', {'usernameStr': val}, function (data) {
        if (val.length > 0) {
            if (data == 0) {
                $('#usernameMarker').html("<span style='color:green;'>Username is available</span>");
            }
            else {
                $('#usernameMarker').html("<span style='color:red;'>Username is not available</span>")
            }
        }
    })
}