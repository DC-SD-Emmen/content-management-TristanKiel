<?php
    session_start();

    spl_autoload_register(function ($class_name) {
        include './classes/' . $class_name . '.php';
    });

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST['logout'])) {
            session_unset();
            session_destroy();
            header("Location: inlog.php");
        }
    }
    
    if (!isset($_SESSION['username'])) {
        session_destroy();
        header("Location: inlog.php");
    } else {
        echo "Hello " . $_SESSION['username'] . "!<br>";
    }

    $db = new Database();
    $userManager = new UserManager($db->getConnection());


    $kptb = new Koppeltabel($db->getConnection());

    $gameTitles = $kptb->selectGames($_SESSION['userid']);

    foreach($gameTitles as $gameTitle) {
        echo $gameTitle['title'] . "<br>";
    }




?>

<html>
<body>
    <form method="post">
        <input type="submit" name='logout' value="Logout">
    </form>
</body>
</html>