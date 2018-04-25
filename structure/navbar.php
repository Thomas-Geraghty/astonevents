<?php
require_once ($_SERVER["DOCUMENT_ROOT"]) . "/php/controller/account/Auth.php";
?>
<!-- Navbar -->
<script src="js/Auth.js"></script>
<nav class="navbar-sticky">
    <ul>
        <?php if(!isset($_SESSION['sessionStatus']) || $_SESSION['sessionStatus'] == 1): ?>
            <a class="navbar-link button" href="events.php">View events</a>
            <a id ="loginButton" class="navbar-link button " onclick="loginClick()">Log in</a>
            <div id="loginDropdown">
                <form id="login-form" method="POST">
                <table>
                    <tr>
                        <td><h4 class="login-label">Username:</h4></td>
                        <td><input name="login-username" class="form" type="text" maxlength="32" placeholder="Username"
                                   required></td>
                    </tr>
                    <tr>
                        <td><h4 class="login-label">Password:</h4></td>
                        <td><input name="login-password" class="form" type="password" maxlength="32" placeholder="Password"
                                   required></td>
                    </tr>
                </table>
                <input type="hidden" name="login_submitted" value="1"/>
                <input type="submit" class="linkButton" id="log-in-button" value="SIGN IN">
            </form>
            </div>
            <script>
                document.addEventListener('mouseup', function (e) {
                    var trigger1 = document.getElementById('loginButton');
                    var container1 = document.getElementById('loginDropdown');

                    if(trigger1.contains(e.target)) {
                        $('#loginDropdown').slideToggle(200);
                    }
                    else if (!container1.contains(e.target)) {
                        $('#loginDropdown').slideUp(100);
                    }
                }.bind(this));
            </script>
        <?php elseif($_SESSION['sessionStatus'] == 2): ?>
            <a id="eventsButton" class="navbar-link button">Events</a>
            <a class="navbar-link button" onclick="log_out(1)">Log out</a>
            <div id="eventsDropdown">
                <h4 class="button eventsDropdownButton" onclick="window.location.href='events.php'">All Events</h4>
                <h4 class="button eventsDropdownButton" onclick="window.location.href='../userArea.php'">Manage Events</h4>
            </div>
            <script>
                document.addEventListener('mouseup', function (e) {
                    var trigger2 = document.getElementById('eventsButton');
                    var container2 = document.getElementById('eventsDropdown');

                    if(trigger2.contains(e.target)) {
                        $('#eventsDropdown').slideToggle(200);
                    }
                    else if (!container2.contains(e.target)) {
                        $('#eventsDropdown').slideUp(100);
                    }
                }.bind(this));
            </script>
        <?php endif; ?>
    </ul>
</nav>
