<?php
    session_start();
?>
<html>
<body>
<?php

    
    if (!isset($_SESSION['username'])) {
        session_destroy();
    }

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