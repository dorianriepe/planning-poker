<?php

include "config.php";

session_start();

if($_SESSION['loggedin'] == true){
    $email = $_SESSION['email'];
}else{
    header("Location: login.html");
}
/*
if(isset($_SESSION['task-res'])){

}else{

    $_SESSION['task-res']=0;
}
*/


$playerSubmitted = 0;


$q1 = "SELECT * FROM GAMEDB WHERE gameID = ".$_SESSION['joincode']." AND player1 is null";
$r1 = mysqli_query($connection, $q1);
$c1 = mysqli_num_rows($r1);

if($c1 == 0){
   
    // Spieler 1 hat alles abgegeben
    $playerSubmitted = $playerSubmitted + 1;
} 



$q2 = "SELECT * FROM GAMEDB WHERE gameID = ".$_SESSION['joincode']." AND player2 is null";
$r2 = mysqli_query($connection, $q2);
$c2 = mysqli_num_rows($r2);

if ($c2 == 0){
    
    // Spieler 2 hat alles abgegeben
    $playerSubmitted = $playerSubmitted + 1;
}



$q3 = "SELECT * FROM GAMEDB WHERE gameID = ".$_SESSION['joincode']." AND player3 is null";
$r3 = mysqli_query($connection, $q3);
$c3 = mysqli_num_rows($r3);
        
if ($c3 == 0){
            
    // Spieler 3 hat alles abgegeben
    $playerSubmitted = $playerSubmitted + 1;
}



$q4 = "SELECT * FROM GAMEDB WHERE gameID = ".$_SESSION['joincode']." AND player4 is null";
$r4 = mysqli_query($connection, $q4);
$c4 = mysqli_num_rows($r4);

if($c4 == 0){
                
    // Spieler 1 hat alles abgegeben
    $playerSubmitted = $playerSubmitted + 1;
} 




$query = "SELECT maxPlayers FROM GAMEDB WHERE gameID = ".$_SESSION['joincode'];
$result = mysqli_query($connection, $query);
$count = mysqli_num_rows($result);

for ($i = 0; $i < $count; $i++){
            
    $res[] = mysqli_fetch_assoc($result);

}

$maxPlayers = $res[0]["maxPlayers"];

//echo $maxPlayers;


if($playerSubmitted == $maxPlayers){

    header("location: result.php");
}


?>





<html>
    <head>
        <title>Planning Poker</title>
        <link rel="stylesheet" type="text/css" href="css/result-lobby.css">
        <meta http-equiv="refresh" content="10">
    </head>

    <body>
        <a href="index.php"><button class="quit" style="float: right"></button></a>
        
        <h1>Planning Poker</h1>

        <h2> <?php echo "#".$_SESSION['joincode']; ?> </h2>

        <h4>Bitte warten Sie bis alle Mitspieler die Aufgaben bewertet haben...</h4>

        


    </body>

</html>