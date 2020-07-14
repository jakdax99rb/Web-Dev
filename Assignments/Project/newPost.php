<?php

    session_start();

    
    
?>

<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>New Post</title>
    <a href="index.php">Frontpage</a>
    <meta charset="UTF-8" />
  </head>
  <body>
    <form action="newPost.php" method="POST">
      Title:<br/>
      <input type="text" name="title" placeholder="title" />
      <br />
      Content:<br/>
      <textarea rows ="5" cols="60" name="content" placeholder="Content"></textarea>
      <br />
      <input type="submit" name="post" value="Post" />
    </form>

    <?php  
        if ( isset( $_SESSION['user_name'] ) ) {
        
            $db_host = 'localhost';
            $db_user = 'root';
            $db_pass = '';
            $db_name = 'forum';    
    
            $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name,"3308");
            
            if ($mysqli -> connect_errno){
                echo "Connection to database failed" . $mysqli -> connect_error;
                exit();
            }
            
            if (! empty( $_POST )) {

                if ( isset($_POST['title']) && isset($_POST['content'] ) ){

                    $sqlUpdate = "INSERT INTO post (title, content, author) VALUES ( "."'".$_POST['title']."', '".$_POST['content']."', '".$_SESSION['user_name']."')";

                    if ($mysqli -> query($sqlUpdate)){
                        echo "Post successful";
                    } else{
                        echo "Post unsuccessful, error: ".mysqli_error($mysqli);
                    }

                    header("Location: index.php");

                    mysqli_close($mysqli);
                }
                else{
                    echo "One of the fields are empty. To make a post both fields must be full.";
                }

            }
        } else {
            // Redirect them to the login page
            echo "To make a post your need to login first.<br> <a href='login.php'>Login</a>";
            exit;
        }
    ?>

    <footer><a href="logout.php">Logout</a></footer>
  </body>
</html>
