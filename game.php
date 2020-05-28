<?php

include "config.php";

session_start();

if($_SESSION['loggedin'] == true){
    $email = $_SESSION['email'];
}else{
    header("Location: login.html");
}

if(isset($_SESSION['task'])){

}else{

    $_SESSION['task']=0;
}

?>





<html>
    <head>
        <title>Planning Poker</title>
        <link rel="stylesheet" type="text/css" href="css/game.css">
    </head>
    <body>
        <a href="index.php"><button class="quit" style="float: right"></button></a>
        
        <h1>Planning Poker</h1>

        <h2> <?php echo "#".$_SESSION['joincode']; ?> </h2>
        <br><br>
        <h3>
        <?php
            
            $q0 = "SELECT task, description FROM GAMEDB WHERE gameID = ".$_SESSION['joincode'];
            $res0 = mysqli_query($connection, $q0);
            $_SESSION['count'] = mysqli_num_rows($res0);;

            
            $query = "SELECT task, description FROM GAMEDB WHERE gameID = ".$_SESSION['joincode']." AND taskID=".$_SESSION['task'];
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

        <button onclick="decrement_fibonacci()" class="add">-</button>
        <button onclick="increment_fibonacci()" class="add">+</button>
        <br>
        <br>
        <form id="card" action="nexttask.php" method="post">
             
            <input type="text" name="value" id="valuefield" value="1" readonly>
            <br>
            <br>
            <br>
            <?php
           
                if($_SESSION['count']-$_SESSION['task'] == 1){
                    echo "<button type='submit' name='submit' class='last'>Zur Auswertung</button>";
                }else{
                    echo "<button type='submit' name='submit'>Nächste Aufgabe bewerten</button>";
                }
           ?>
        </form>

        
        <script>

            function increment_fibonacci(){


                current_value = Number(document.getElementById("valuefield").value);

                switch(current_value) {
  
                    case 0:
                        new_value = 1;
                        break;
                    case 1:
                        new_value = 2;
                        break;
                    case 2:
                        new_value = 3;
                        break;
                    case 3:
                        new_value = 5;
                        break;
                    case 5:
                        new_value = 8;
                        break;
                    case 8:
                        new_value = 13;
                        break;
                    case 13:
                        new_value = 21;
                        break;
                    case 21:
                        new_value = 34;
                        break;
                    case 34:
                        new_value = 55;
                        break;
                    case 55:
                        new_value = 89;
                        break;
                    case 89:
                        new_value = 99;
                        break;
                    case 99:
                        new_value = 99;
                        break;
                    default:
                        new_value = current_value;
                }

                new_value = Number(new_value);
                
                document.getElementById("valuefield").value = new_value;

            }

            function decrement_fibonacci(){

                current_value = Number(document.getElementById("valuefield").value);

                switch(current_value) {
                    
                    case 0:
                        new_value = 0;
                        break;
                    case 1:
                        new_value = 0;
                        break;
                    case 2:
                        new_value = 1;
                        break;
                    case 3:
                        new_value = 2;
                        break;
                    case 5:
                        new_value = 3;
                        break;
                    case 8:
                        new_value = 5;
                        break;
                    case 13:
                        new_value = 8;
                        break;
                    case 21:
                        new_value = 13;
                        break;
                    case 34:
                        new_value = 21;
                        break;
                    case 55:
                        new_value = 34;
                        break;
                    case 89:
                        new_value = 55;
                        break;
                    case 99:
                        new_value = 89;
                        break;
                    default:
                        new_value = current_value;
                    }

                new_value = Number(new_value);

                document.getElementById("valuefield").value = new_value;

            }

        </script>

    </body>

</html>