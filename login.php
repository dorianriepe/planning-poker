<?php

include "config.php";
session_start();
   
if($_SERVER["REQUEST_METHOD"] == "POST") { 
      
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']); 
    $hash = crypt($password, "webentwicklungsprojektfuerdiedhbwstuttgart1234!koakjbsdfkj");

    $query = "SELECT * FROM USERDB WHERE email = '".$email."' and password = '".$hash."'";
    $result = mysqli_query($connection, $query);
    $count = mysqli_num_rows($result);
    
    if($count > 0){
         
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $email; 

        header("location: index.php");
      
    }
    else{
    
        $error = "Your Login Name or Password is invalid";
        
        header("location: signup.html");

    }
    
}

?>