<?php
    session_start();

    spl_autoload_register(function ($class_name) {
        include './classes/' . $class_name . '.php';
    });

    $db = new Database();
    $userManager = new UserManager($db->getConnection());
    
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        //if isset register, betekend Als er op de register submit knop is gedrukt
        if(isset($_POST['register'])) {
            $user = $_POST['uname'];
            $password = password_hash($_POST['psw'], PASSWORD_DEFAULT);
            
            //usermanager->insertUser oproepen
            $userManager->insertUser($user, $password);
        }
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Registratie pagina</h1>

    <form method="post">
        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="uname" required> 
        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" required>
        <input type="submit" name='register' value="Register">
    </form>
</body>
</html>