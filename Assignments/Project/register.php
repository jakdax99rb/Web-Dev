<?php
    
    $regiusername = $_POST['username'];
    $regipassword = $_POST['password'];
    
    $serverName = 'localhost';
    $username = 'root';
    $password = '';
    $myDB = 'forum';

    $link = mysqli_connect($serverName, $username, $password, $myDB,"3308");

    if(!$link){
        die('Connection failed: '.$link->connect_error);
    }
    


    $sqlUpdate = "INSERT INTO users (username, password) VALUES ( "."'".$regiusername."','".password_hash($regipassword, PASSWORD_DEFAULT)."')";


    if (mysqli_query($link, $sqlUpdate)){
        $response = "Registered successfully!";
    } else{
        $response = "Registration unsuccessful, error: ".mysqli_error($link);
    }

    mysqli_close($link);

    echo $response;
?>


<footer><a href = "login.php">Return to login</a>.</footer>