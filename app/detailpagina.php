<?php

    // alle bestanden worden ingeladen
    spl_autoload_register(function ($class_name) {
        include 'classes/' . $class_name . '.php';
    });

    session_start();

    $db = new Database();
    $gameManager = new GameManager($db->getConnection());
    $userManager = new UserManager($db->getConnection());
        
    //als er een formulier wordt gepost
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        //als er op de submit knop wordt geklikt
        if(isset($_POST['wishlist'])) {

            $user_id = $_SESSION['user']->getUserID();
            $game_id = $_POST['game_id'];

            $userManager->addToWishList($user_id, $game_id);


        }

        if(isset($_POST['gameDelete'])) {
            $game_id = $_POST['game_id'];
            $gameManager->deleteGames($game_id);
            header("Location: index.php");
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
    <h1>Detail pagina</h1>

    <?php
        $id = $_GET['id'];

        $games = $gameManager->selectSingleGame($id);

    
        foreach($games as $game) {
            echo "<img class='game-image' src='uploads/" . $game['image'] . "'><br>";
            echo "<div id='game-title'>" . $game['title'] . "</div><br>";
            echo "<div id='game-genre'>" . $game['genre'] . "</div><br>";
            echo "<div id='game-platform'>" . $game['platform'] . "</div><br>";
            echo "<div id='game-release_year'>" . $game['release_year'] . "</div><br>";
            echo "<div id='game-rating'>" . $game['rating'] . "</div><br>";
            echo "<form method='post'>
                    <input type='text' value='$id' style='display:none;' name='game_id'>
                    <input type='submit' name='wishlist' value='Wensenlijst'>
                    <input type='submit' name='gameDelete' value='Verwijder Game'>
                </form>";
        }

    ?>

    <form action="index.php" method="post">
        <input type="submit" name="index" value="Terug naar index">
    </form>  
    
</body>
</html>