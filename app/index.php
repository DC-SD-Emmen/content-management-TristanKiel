<?php
    // alle bestanden worden ingeladen
    spl_autoload_register(function ($class_name) {
        include './classes/' . $class_name . '.php';
    });
    session_start();

    $db = new Database();   
    $userManager = new UserManager($db->getConnection());
    $gameManager = new GameManager($db->getConnection());
    $kptb = new Koppeltabel($db->getConnection());
    //als er een formulier wordt gepost
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        //als er op de submit knop wordt geklikt
        if(isset($_POST['logout'])) {
            session_unset();
            session_destroy();
            header("Location: inlog.php");
        } 
        else if(isset($_POST['userDelete'])){
            $userManager->deleteUsers($_SESSION['user']->getUserID());
            header("Location: inlog.php");
        } 
        else if(isset($_POST['add-game'])) {
            $gameManager->fileUpload($_FILES['image']);
            $gameManager->insert($_POST, $_FILES['image']['name']);
        }
    }
    
    if (!isset($_SESSION['username'])) {
        session_destroy();
        header("Location: inlog.php");
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

    <h1>Game Library</h1>

    <a href="wishlist.php">Link naar wishlist</a><br>
    
    <button id='add-button'>ADD</button>

    <form id='gameForm' method="POST" enctype="multipart/form-data" style='display: none;'>

        <lable for='title'>Titel: </lable>
        <input type='text' name='title' id='title'><br>

        <lable for='genre'>Genre: </lable>
        <input type='text' name='genre' id='genre'><br>

        <lable for='platform'>Platform: </lable>
        <input type='text' name='platform' id='platform'><br>
        
        <lable for='release_year'>Release year: </lable>
        <input type='date' name='release_year'><br>

        <lable for='rating'>Rating: </lable>
        <input type='number' name='rating' step='.01'><br>

        <lable for='image'>Image: </lable>
        <input type='file' name='image'><br>

        <input type='submit' name='add-game' value="Versturen">
    </form>

    

    <div id='games-container'>

        <?php
            $games = $gameManager->selectAll($_SESSION['user']->getUserID());

            foreach($games as $game) {
                echo "<a href='detailpagina.php?id=" . $game['id'] ."'> <img class='game-image' src='uploads/" . $game['image'] . "'></a><br>";
            }
        ?>


    </div>

    <form method="post">
        <input type="submit" name='logout' value="Logout">
        <input type='submit' name='userDelete' value="Verwijder Gebruiker">
    </form>

    <script src='javascript.js'></script>

</body>
</html>