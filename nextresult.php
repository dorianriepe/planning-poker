<?php

session_start();
if($_SESSION['count']-$_SESSION['task-res'] == 1){

    header("location: index.php");
    
} else{
    
    $_SESSION['task-res'] = $_SESSION['task-res']+1;
    header("location: result.php");
}




?>