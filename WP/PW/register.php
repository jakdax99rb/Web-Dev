<?php
    
    $regiusername = $_POST['username'];
    $regipassword = $_POST['password'];
    
    $db_host = 'mydb.ceyhk5htyork.us-east-2.rds.amazonaws.com';
    $db_user = 'admin';
    $db_pass = '7pMCCB57xwEe';
    $db_name = 'forum';    

    $link = mysqli_connect($db_host, $db_user, $db_pass, $db_name,"3306");

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