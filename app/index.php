<?php

$host = "mysql"; // Le host est le nom du service, présent dans le docker-compose.yml
$dbname = "my-wonderful-website";
$charset = "utf8";
$port = "3306";
?>

<html>
<head>
    <title>Drenthe College docker web server</title>
</head>
<body>

<form>
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required> 
    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>
</form>



</body>
</html>
