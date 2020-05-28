<?php

include "config.php";

session_start();

if(isset($_POST['submit'])) {      

    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];                 
    $email=$_POST['email'];
    $password=$_POST['password'];
    $password2=$_POST['password2'];
    $hash = crypt($password, "webentwicklungsprojektfuerdiedhbwstuttgart1234!koakjbsdfkj");

    $query = "SELECT * FROM USERDB WHERE email = '".$email."'";
    $result = mysqli_query($connection, $query);
    $count = mysqli_num_rows($result);
    
    // Prüfe ob E-Mail bereits genutzt:
    if($count == 0){

        // Prüfe ob alle Felder ausgefüllt und die Passwörter gleich
        if(!empty($firstname) && !empty($lastname) && !empty($email) && !empty($hash) && $password == $password2){

            mysqli_query($connection, "INSERT INTO USERDB(firstName,lastName,email,password) VALUES ('$firstname','$lastname','$email','$hash')"); 

            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
                 
            header("location: index.php");

        } else{

            header("location: signup.html");
        }
    } 
    else{
        
        header("location: signup.html");
    }
}
?>