<?php
    session_start();
?>
<html>    
<body>   
    <h1>Inlog pagina</h1> 
<?php

    spl_autoload_register(function ($class_name) {
        include './classes/' . $class_name . '.php';
    });

    $db = new Database();
    $userManager = new UserManager($db->getConnection());

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

    
        // als er op de submit knop voor login is gedrukt
        if(isset($_POST['login'])) {
            (password_verify($_POST['psw'], $password));
            $_SESSION["username"] = $_POST['uname'];
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