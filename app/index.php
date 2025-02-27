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

        $user = $_POST['uname'];
        $password = password_hash($_POST['psw'], PASSWORD_DEFAULT);
        $verified_password = password_verify($_POST['psw'], $password);

        //usermanager->insertUser oproepen
        $userManager->insertUser($user, $password);
    }
?>

    <form method="post">
        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="uname" required> 
        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" required>
        <input type="submit">
    </form>

    <div id="container">
        <form method="post">
            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="uname" required>
            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required>
            <button type="submit">Login</button>
        </form>
    </div>


</body>
</html>