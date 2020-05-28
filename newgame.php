<?php

include "config.php";

session_start();

if($_SESSION['loggedin'] == true){
    $email = $_SESSION['email'];
}else{
    header("Location: login.html");
}


?>
<html>
    <head>
        <title>Planning Poker - Neues Spiel</title>
        <link rel="stylesheet" type="text/css" href="css/newgame.css">
    </head>
    <body>

        <a href="index.php"><button class="home" style="float: left"></button></a>

        <h1>Neues Spiel</h1>
        
        <h2> 
        
        <?php 

            // Hier wird sich um die Spiel ID gekümmert.

            if($_SESSION['gamecode-in-use'] == false){

                $gamecode = rand(100000, 999999);
                
                while(true){
                    
                    // Schaue ob der Code bereits existiert
                    $query = "SELECT * FROM GAMEDB WHERE gameID = ".$gamecode;
                    $result = mysqli_query($connection, $query);
                    $count = mysqli_num_rows($result);
    
                    if($count == 0){
                        //echo "Gamecode valid";
                        break;
    
                    } else {
                        //echo "New Gamecode";
                        $gamecode = rand(100000, 999999);
                    }
                }

                $_SESSION['gamecode-in-use'] = true;
                $_SESSION['gamecode'] = $gamecode;
                
            } else {

                $gamecode = $_SESSION['gamecode'];

            }

            echo "#".$gamecode;

        ?>  

        </h2>
        <br>
        <!--

            DONE:
            - Titel einfügen
            - Beschreibung einfügen
            - in Session sichern

            TODO:
            - in DB schreiben
            - maximale Spieleranzahl setzen (als Session mit Abfrage ob schon gesetzt?)

        -->

        <form action="add-task.php" method="post">
        
            <input type="text" name="title" placeholder="Aufgaben-Titel"><br>
            <br><input type="text" name="description" placeholder="Aufgaben-Beschreibung"><br>

            <br><button type="submit" name="submit" class="add">+</button>
        
        </form>

        <br>
        <button onclick="decrement_maxPlayers()" class="add">-</button>
        <button onclick="increment_maxPlayers()" class="add">+</button>
        <br><br>
        
        <form action="create-new-game.php" method="post">
            
            <input type="text" name="maxp" id="maxp" value="2" readonly>
            <br><br>
            <button type="submit" name="submit">Spiel erstellen</button>
        </form>
        <script>

            function increment_maxPlayers(){

                current_value = Number(document.getElementById("maxp").value);

                switch(current_value) {
  
                    case 2:
                        new_value = 3;
                        break;
                    case 3:
                        new_value = 4;
                        break;
                    case 4:
                        new_value = 4;
                        break;
                    default:
                        new_value = 1;
                        break;

                }
                new_value = Number(new_value);
                
                document.getElementById("maxp").value = new_value;

            }

            function decrement_maxPlayers(){

                current_value = Number(document.getElementById("maxp").value);
                
                switch(current_value) {
  
                    case 2:
                        new_value = 2;
                        break;
                    case 3:
                        new_value = 2;
                        break;
                    case 4:
                        new_value = 3;
                        break;
                    default:
                        new_value = 1;
                        break;

                }

                new_value = Number(new_value);
                
                document.getElementById("maxp").value = new_value;
            }

        </script>

    </body>
</html>
