<?php

include "config.php";

session_start();



$titles = $_SESSION['titles'];
$descriptions = $_SESSION['descriptions'];

$maxPlayers = $_POST['maxp'];

for($i=0; $i < sizeof($titles); $i++){

    $query = "INSERT INTO GAMEDB(gameID,taskID,task,description,maxPlayers) VALUES (".$_SESSION['gamecode'].",".$i.",'".$titles[$i]."','".$descriptions[$i]."',".$maxPlayers.")";
    mysqli_query($connection, $query);

}

$_SESSION['joincode'] = $_SESSION['gamecode'];

unset($_SESSION["titles"]);
unset($_SESSION["descriptions"]);
unset($_SESSION["gamecode"]);
$_SESSION['gamecode-in-use'] = false;


header("location: game.php");

?>