<html>    
<body>    
<?php

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

    
        // als er op de submit knop voor login is gedrukt
        if(isset($_POST['login'])) {
            if (password_verify($_POST['psw'], $password)) {
                echo "Wachtwoord is goed.";
            }
            else {
                echo "Wachtwoord is niet goed.";
            }

            $_SESSION["username"] = $_POST['uname'];
            $_SESSION["password"] = $_POST['psw'];

        }
    }

?>
    <div id="container">
        <form action="beveiligdepagina.php" method="post">
            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="uname" required>
            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required>
            <input type="submit" name='login' value="Login">
        </form>
    </div>



</body>
</html>