<?php

session_start();


if(isset($_SESSION['titles']) && isset($_SESSION['descriptions'])){
    
    $titles = $_SESSION['titles'];
    $descriptions = $_SESSION['descriptions'];
    
} else {
    
    $titles = array();
    $descriptions = array();
    
}

if(isset($_POST['title'])){
    $title = $_POST['title'];
} else {
    $title = " ";
}

if(isset($_POST['description'])){
    $description = $_POST['description'];
} else{
    $description = " ";
}

array_push($titles, $title);
array_push($descriptions, $description);

$_SESSION['titles'] = $titles;
$_SESSION['descriptions'] = $descriptions;

header("location: newgame.php");

?>