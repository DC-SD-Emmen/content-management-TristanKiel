<?php
    session_start();

    spl_autoload_register(function ($class_name) {
        include './classes/' . $class_name . '.php';
    });

    $db = new Database();
    $userManager = new UserManager($db->getConnection());

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

       
        // als er op de submit knop voor login is gedrukt
        if(isset($_POST['login'])) {
            
            $userName = $_POST['uname'];
            $password = $_POST['psw'];

            //user ophalen uit de database
            $user = $userManager->getUser($userName);

            if ($user && isset($user['password'])) { 
                if(password_verify($password, $user['password'])) {

                    $_SESSION['username'] = $userName;
                    $_SESSION['userid'] = $user['id'];

                    header('Location: index.php');
                } else {
                    echo "Login not succesfull! try again";
                }
            } else {
                echo "User not found!";
            }

            
        }
    }

?>


<html> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>   
<body>   
    <h1>Inlog pagina</h1> 
    <div id="container">
        <form method="post">
            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="uname" required>
            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required>
            <input type="submit" name='login' value="Login">
        </form>
        <form action="registratie.php">
            Als je nog geen account hebt, dan kun je je registreren:
            <input type="submit" name="register" value="Registreer">
        </form>    
    </div>



</body>
</html>