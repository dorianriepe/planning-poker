<?php

session_start();

if($_SESSION['loggedin'] == true){
    $email = $_SESSION['email'];
}else{
    header("Location: login.html");
}

$_SESSION['gamecode-in-use'] = false;

unset($_SESSION["titles"]);
unset($_SESSION["descriptions"]);
unset($_SESSION['gamecode']);
unset($_SESSION['joincode']);
unset($_SESSION['task']);
unset($_SESSION['task-res']);
unset($_SESSION['count']);

?>
<html>
    <head>
        <title>Planning Poker</title>
        <link rel="stylesheet" type="text/css" href="css/index.css">
    </head>
    <body>
        <a href="logout.php"><button class="logout" style="float: right"></button></a>
        <h1>Planning Poker</h1>
        <br><br><br><br><br><br>
        <a href="newgame.php"><button>Neues Spiel erstellen</button></a>
        <br><br><br>
        <a href="joingame.php"><button>Spiel beitreten</button></a>
    </body>
</html>

