<?php

    spl_autoload_register(function ($class_name) {
        include './classes/' . $class_name . '.php';
    });

    session_start();

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

    <h1>Wensenlijst</h1>

    <?php
        
        $db = new Database();

        $kptb = new Koppeltabel($db->getConnection());

        $games = $kptb->selectGames($_SESSION['user']->getUserID());

        foreach($games as $game) {
            echo "<a href='detailpagina.php?id=" . $game->getGameId() ."'> <img class='game-image' src='uploads/" . $game->getImage() . "'></a><br>";
        }
    ?>

</body>
</html>