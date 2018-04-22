<!-- Navbar -->
<nav class="navbar-sticky">
    <ul class="weblinks">
        <?php if(!isset($_SESSION['sessionStatus']) || $_SESSION['sessionStatus'] == 1): ?>
            <a class="navbar-link button loginButton">Log in</a>
            <div id="loginDropdown">
            <form id="login-form" method="POST">
                <table>
                    <tr>
                        <td><h4 style="color: #062131">Username:</h4></td>
                        <td><input name="login-username" class="form" type="text" maxlength="32" placeholder="Username"
                                   required></td>
                    </tr>
                    <tr>
                        <td><h4 style="color: #062131">Password:</h4></td>
                        <td><input name="login-password" class="form" type="text" maxlength="32" placeholder="Password"
                                   required></td>
                    </tr>
                </table>
                <input type="hidden" name="login_submitted" value="1"/>
                <input type="submit" class="linkButton" id="log-in-button" value="SIGN IN">
            </form>
        </div>
        <?php elseif($_SESSION['sessionStatus'] == 2): ?>
            <a class="navbar-link button loginButton">Log out</a>
        <?php endif; ?>
    </ul>
</nav>