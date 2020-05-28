<?php

session_start();

if($_SESSION['loggedin'] == true){
    $email = $_SESSION['email'];
}else{
    header("Location: login.html");
}

?>





<html>
    <head>
        <title>Planning Poker - Spiel beitreten</title>
        <link rel="stylesheet" type="text/css" href="css/joingame.css">
    </head>
    <body>
        <a href="index.php"><button class="home" style="float: left"></button></a>
        
        <h1>Beitreten</h1>
        <br><br><br>
        <form action="join.php" method="post">
        
            <input type="text" name="code" placeholder="Spiel-Code hier einfügen"><br>
            <br>
            <button type="submit" name="submit">Spiel beitreten</button>
        
        </form>

    </body>
</html>
