<html>
<head>
    <title>Drenthe College docker web server</title>
</head>
<body>

<?php

    spl_autoload_register(function ($class_name) {
        include './classes/' . $class_name . '.php';
    });

    $db = new Database();
    $userManager = new UserManager($db->getConnection());
    
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        //usermanager->insertUser oproepen
    }
?>

    <form method="post">
        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="uname" required> 
        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" required>
        <input type="submit">
    </form>


<?php
   
?>


</body>
</html>