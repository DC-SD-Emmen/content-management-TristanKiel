<?php

    class GameManager {

        private $conn;


        public function __construct($conn) {
            $this->conn = $conn;
        }

        public function selectAll() {
        
            try {
                $stmt = $this->conn->prepare("SELECT * FROM games");
                $stmt->execute();
                $resultaten = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $resultaten = $stmt->fetchALl();
                return $resultaten;
            }
            catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                $resultaten = [];
            }
        }

        public function selectSingleGame($id) {
        
            try {
                $stmt = $this->conn->prepare("SELECT * FROM games WHERE id=$id");
                $stmt->execute();
                $resultaten = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $resultaten = $stmt->fetchALl();
                return $resultaten;
            }
            catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                $resultaten = [];
            }
        }
        
        public function insert($data, $imageName) {
                // set the PDO error mode to exception

                //input filteren met htmlspecialchars (tegen XSS attack)
                $title = htmlspecialchars($data['title']);
                $genre = htmlspecialchars($data['genre']);
                $platform = htmlspecialchars($data['platform']);
                $release_year = htmlspecialchars($data['release_year']);
                $rating = htmlspecialchars($data['rating']);                   

                    //regex controle

                    $titleRegex = '/^[A-Za-z0-9 ]+$/';   // Letters, cijfers en spaties toegestaan
                    $genreRegex = '/^[A-Za-z ]+$/';      // Alleen letters en spaties
                    $platformRegex = '/^[A-Za-z0-9 ]+$/'; // Letters, cijfers en spaties
                    

                    // als de match niet goed is
                    if(!preg_match($titleRegex, $title)) {
                        echo "Titel is niet goed";
                    }
                    elseif(!preg_match($genreRegex, $genre)){
                        echo "Genre is niet goed";
                    }
                    elseif(!preg_match($platformRegex, $platform)) {
                        echo "Platform is niet goed";
                    }
                    elseif($rating < 1 || $rating > 10){
                        echo "Rating is niet goed<br>";
                        echo "voer een rating in tussen de 1 en de 10";
                    }

                try {
                    $stmt = $this->conn->prepare("INSERT INTO games (title, genre, platform, release_year, rating, image) VALUES (:title, :genre, :platform, :release_year, :rating, :imageName)");
                    $stmt->bindParam(':title', $title);
                    $stmt->bindParam(':genre', $genre);
                    $stmt->bindParam(':platform', $platform);
                    $stmt->bindParam(':release_year', $release_year);
                    $stmt->bindParam(':rating', $rating);
                    $stmt->bindParam(':imageName', $imageName);
                    $stmt->execute();
                    echo "New data created succesfully";
                }
                        
                catch (PDOExeption $e) {
                    echo $sql . "<br>" . $e->getMessage();
                }
        }

        public function fileUpload($file) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($file["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            $check = getimagesize($file["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }


            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }

            // Check file size
            if ($file["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" && $imageFileType != "webp") {
                echo "Sorry, only JPG, JPEG, PNG, GIF & WEBP files are allowed.";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } else {
            if (move_uploaded_file($file["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars( basename( $file["name"])). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
            }
        }
        public function deleteGames($id){
            $stmt = $this->conn->prepare("DELETE FROM user_games WHERE game_id = :game_id");
            $stmt->bindParam(':game_id', $id);
            $stmt->execute();
        }

    }
?>