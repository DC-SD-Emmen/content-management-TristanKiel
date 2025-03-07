<?php
    session_start();

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
        echo "Hello " . $_SESSION['username'] . "!";
    }


?>

<html>
<body>
    <form method="post">
        <input type="submit" name='logout' value="Logout">
    </form>
</body>
</html>