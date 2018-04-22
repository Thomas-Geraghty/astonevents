function checkUsername(str) {
    if (str.length == 0) {
        document.getElementById("usernameMarker").innerHTML = "❌";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("usernameMarker").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","php/controller/usernameTest.php?q="+str,true);
        xmlhttp.send();
        }
}