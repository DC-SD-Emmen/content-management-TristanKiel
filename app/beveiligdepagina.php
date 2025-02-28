<?php
session_start();

if (!isset($_SESSION['username'])) {
    session_destroy();
}
elseif (!isset($_SESSION['password'])) {
    session_destroy();
}
?>
<html>
<body>
<?php
    if(isset($_POST['logout'])) {
        session_destroy();
    }
?>
    <form method="post">
        <input type="submit" name='logout' value="Logout">
    </form>
</body>
</html>