<?php

    session_start();

    if ( isset( $_SESSION['user_name'] ) ) {
        $db_host = 'mydb.ceyhk5htyork.us-east-2.rds.amazonaws.com';
        $db_user = 'admin';
        $db_pass = '7pMCCB57xwEe';
        $db_name = 'forum';    
        

        $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name,"3306");
        
        if ($mysqli -> connect_errno){
            echo "Connection to database failed" . $mysqli -> connect_error;
            exit();
        }
        
    } else {
        // Redirect them to the login page
        header("Location: http://localhost/webDev/Assignments/Project/login.php");
        exit;
    }

?>


<!DOCTYPE html>
<html>
    <head>
        <link rel = "stylesheet" type = "text/css" href = "stylesheet.css">
        <title><?php echo $_SESSION['user_name'];?>'s Profile</title>
        <a href="index.php">Frontpage</a>
        <a href='newPost.php'>New post</a>
        <meta charset="UTF-8" />
        
    </head>
    <body>
        <div class="postList">Your Posts:
        <?php   

            $sqlPostList = ("SELECT * FROM post WHERE author ="."'".$_SESSION['user_name']."'");
            $tableOfPosts = "<ul>";
            if ($result = $mysqli -> query($sqlPostList)){
            
                while($row = mysqli_fetch_array($result)){
                
                    $entry = "<li><div class = 'post'>";
                    $entry .= '<span class = "postTitle">'.$row['title'].'</span><br>'.'<span class = "postAuthor">'.$row['author'].'</span>'.'<br>'.'<span class = "postContent"><p>'.$row['content'].'</p></span><br><br>';
                
                    if (!(mysqli_num_rows($commentQuery = $mysqli -> query("SELECT * FROM comments WHERE post_ID = ".$row['id'].""))==0)){
                
                        $entry .= "<br>Comments:<br><ul>";
                
                        while ($comment = mysqli_fetch_array($commentQuery)){
                
                            $entry .= '<li><span class = "postAuthor">'.$comment['author'].'</span>'.'<span class = "postContent"><p>'.$comment['content'].'</p></span></li>';
                
                        }
                
                        $entry .= "</ul>";
                
                    }
                
                    $tableOfPosts .= $entry .= "</div></li><hr>";
                
                }
            }
                
                $mysqli -> close();
                echo $tableOfPosts;
            
        ?>
        </div>
        <footer>
            <a href="logout.php">Logout</a>
        </footer>
    </body>
</html>
