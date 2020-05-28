<?php

include "config.php";

session_start();


$code = $_POST['code'];

$query = "SELECT * FROM GAMEDB WHERE gameID = '".$code."' AND player4 is null";
$result = mysqli_query($connection, $query);
$count = mysqli_num_rows($result);
    
if($count > 0){

    $_SESSION['joincode'] = $code;
    
    header("location: game.php");

} else{

    header("location: joingame.php");

}



?>