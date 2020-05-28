<?php

include "config.php";

session_start();



$valuation = $_POST['value'];



$q1 = "SELECT * FROM GAMEDB WHERE gameID = ".$_SESSION['joincode']." AND taskID=".$_SESSION['task']." AND player1 is not null";
$r1 = mysqli_query($connection, $q1);
$c1 = mysqli_num_rows($r1);



if($c1 == 0){
   
    //echo "Player1 is null";
    // Spieler 1 ist frei

    // UPDATE GAMEDB SET player1 = 'd', card1 = 99 WHERE gameID = 676638 AND taskID = 0
    $ins_q1 = "UPDATE GAMEDB SET player1 = '".$_SESSION['email']."', card1 = ".$valuation." WHERE gameID = ".$_SESSION['joincode']." AND taskID = ".$_SESSION['task'];
    //$ins_q1 = "INSERT INTO GAMEDB(player1, card1) VALUES ('".$_SESSION['email']."','".$valuation."') WHERE gameID = ".$_SESSION['joincode']."AND taskID = ".$_SESSION['task'];

    mysqli_query($connection, $ins_q1);


} else{
    
    $q2 = "SELECT * FROM GAMEDB WHERE gameID = ".$_SESSION['joincode']." AND taskID=".$_SESSION['task']." AND player2 is not null";
    $r2 = mysqli_query($connection, $q2);
    $c2 = mysqli_num_rows($r2);

    if ($c2 == 0){
        
        //echo "Player2 is null";
        // Spieler 2 ist frei

        $ins_q2 = "UPDATE GAMEDB SET player2 = '".$_SESSION['email']."', card2 = ".$valuation." WHERE gameID = ".$_SESSION['joincode']." AND taskID = ".$_SESSION['task'];

        mysqli_query($connection, $ins_q2);

    }else{

        $q3 = "SELECT * FROM GAMEDB WHERE gameID = ".$_SESSION['joincode']." AND taskID=".$_SESSION['task']." AND player3 is not null";
        $r3 = mysqli_query($connection, $q3);
        $c3 = mysqli_num_rows($r3);
        
        if ($c3 == 0){
            
            //echo "Player3 is null";
            // Spieler 3 ist frei

            $ins_q3 = "UPDATE GAMEDB SET player3 = '".$_SESSION['email']."', card3 = ".$valuation." WHERE gameID = ".$_SESSION['joincode']." AND taskID = ".$_SESSION['task'];
            mysqli_query($connection, $ins_q3);


        } else{

            $q4 = "SELECT * FROM GAMEDB WHERE gameID = ".$_SESSION['joincode']." AND taskID=".$_SESSION['task']." AND player4 is not null";
            $r4 = mysqli_query($connection, $q4);
            $c4 = mysqli_num_rows($r4);

            if($c4 == 0){
                
                //echo "Player4 is null";
                // Spieler 4 ist frei

                $ins_q4 = "UPDATE GAMEDB SET player4 = '".$_SESSION['email']."', card4 = ".$valuation." WHERE gameID = ".$_SESSION['joincode']." AND taskID = ".$_SESSION['task'];
                mysqli_query($connection, $ins_q4);
            
            } else {

                //echo "Game ist full";
                // Kein Spieler ist frei

            }
        }
    }
}



$_SESSION['task']= $_SESSION['task']+1;

if($_SESSION['count']-$_SESSION['task'] == 0){
    header("location: result-lobby.php");
}else{
    header("location: game.php");
}

?>