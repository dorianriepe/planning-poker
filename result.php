<?php

include "config.php";

session_start();

if($_SESSION['loggedin'] == true){
    $email = $_SESSION['email'];
}else{
    header("Location: login.html");
}

if(isset($_SESSION['task-res'])){

}else{

    $_SESSION['task-res']=0;
}

?>

<html>
    <head>
        <title>Planning Poker</title>
        <link rel="stylesheet" type="text/css" href="css/result.css">
    </head>

    <body>
        <a href="index.php"><button class="quit" style="float: right"></button></a>
        
        <h1>Ergebnis</h1>

        <h2> <?php echo "#".$_SESSION['joincode']; ?> </h2>
        <br><br>
        <h3>
        <?php
            
            $q0 = "SELECT task, description FROM GAMEDB WHERE gameID = ".$_SESSION['joincode'];
            $res0 = mysqli_query($connection, $q0);
            $_SESSION['count'] = mysqli_num_rows($res0);;

            
            $query = "SELECT task, description, card1, card2, card3, card4, maxPlayers FROM GAMEDB WHERE gameID = ".$_SESSION['joincode']." AND taskID=".$_SESSION['task-res'];
            $result = mysqli_query($connection, $query);
            $count = mysqli_num_rows($result);

            for ($i = 0; $i < $count; $i++){
            
                $res[] = mysqli_fetch_assoc($result);
            }

            echo $res[0]["task"];
        ?>
        </h3>
        
        <h4><?php

            echo $res[0]["description"];

        ?></h4>

        <h5><?php

            $max = (int)$res[0]["maxPlayers"];

            switch($max){

                case 1:
                    $avg = (int)$res[0]["card1"];
                    break;

                case 2:
                    $avg = ( (int)$res[0]["card1"] + (int)$res[0]["card2"] ) / $max;
                    break;

                case 3:
                    $avg = ( (int)$res[0]["card1"] + (int)$res[0]["card2"] + (int)$res[0]["card3"] ) / $max;
                    break;

                case 4:
                    $avg = ( (int)$res[0]["card1"] + (int)$res[0]["card2"] + (int)$res[0]["card3"] + (int)$res[0]["card4"] ) / $max;
                    break;

                default:
                    $avg = $max;
                
            }

            echo round($avg,1);

            $ins_res = "UPDATE GAMEDB SET result = ".round($avg,1)." WHERE gameID = ".$_SESSION['joincode']." AND taskID = ".$_SESSION['task-res'];
                mysqli_query($connection, $ins_res);

        ?></h5>

        <form action="nextresult.php" method="post">
            
            <?php
           
                if($_SESSION['count']-$_SESSION['task-res'] == 1){

                    echo "<button type='submit' name='submit' class='last'>Beenden</button>";
                }else{
                    echo "<button type='submit' name='submit'>Weiter</button>";
                }
           ?>
        </form>


    </body>

</html>