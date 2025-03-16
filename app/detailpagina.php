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

        
        //spl autoloader
        spl_autoload_register(function ($class_name) {
            include 'classes/' . $class_name . '.php';
        });

        $db = new Database();

        $gameManager = new GameManager($db->getConnection());


        $id = $_GET['id'];

        $games = $gameManager->selectSingleGame($id);

        
        
        foreach($games as $game) {
            echo "<div id='game-title'>" . $game['title'] . "</div><br>";
            echo "<div id='game-genre'>" . $game['genre'] . "</div><br>";
            echo "<div id='game-platform'>" . $game['platform'] . "</div><br>";
            echo "<div id='game-release_year'>" . $game['release_year'] . "</div><br>";
            echo "<div id='game-rating'>" . $game['rating'] . "</div><br>";
        }

    ?>

    
</body>
</html>