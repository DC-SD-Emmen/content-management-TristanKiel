<?php
    session_start();

    if (!isset($_SESSION['username'])) {
        session_destroy();
    }
?>
<html>
<body>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST['logout'])) {
            session_unset();
            session_destroy();
        }
    }
?>
    <form action="inlog.php" method="post">
        <input type="submit" name='logout' value="Logout">
    </form>
</body>
</html>