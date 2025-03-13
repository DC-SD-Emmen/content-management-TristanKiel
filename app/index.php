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
    
<?php

    $db = new Database();
    
    $userManager = new UserManager($db->getConnection());

    $gameManager = new GameManager($db->getConnection());

    $kptb = new Koppeltabel($db->getConnection());

    

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $gameManager->fileUpload($_FILES['image']);

        $gameManager->insert($_POST, $_FILES['image']['name']);
    }  
?>

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

        <input type='submit' name='submit' value="Versturen">
    </form>

    

    <div id='games-container'>

        <?php
            $games = $gameManager->selectAll($_SESSION['userid']);

            foreach($games as $game) {
                echo "<a href='detailpagina.php?id=" . $game['id'] ."'> <img class='game-image' src='uploads/" . $game['image'] . "'></a><br>";
            }
        ?>


    </div>

    <form method="post">
        <input type="submit" name='logout' value="Logout">
    </form>

    <script src='javascript.js'></script>

</body>
</html>