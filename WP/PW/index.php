<?php
    session_start();
    $db_host = 'mydb.ceyhk5htyork.us-east-2.rds.amazonaws.com';
    $db_user = 'admin';
    $db_pass = '7pMCCB57xwEe';
    $db_name = 'forum';    


    $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name,"3306");
    
    if ($mysqli -> connect_errno){
        echo "Connection to database failed" . $mysqli -> connect_error;
        exit();
    }

    if (!empty($_POST)){
        $sqlUpdate = "INSERT INTO comments (content, post_ID, author) VALUES ( "."'".$_POST['content']."',".$_POST['id'].","."'".$_POST['author']."'".")";
        if (mysqli_query($mysqli, $sqlUpdate)){
            $response = "Commented successfully!";
        } else{
            $response = "Comment unsuccessful, error: ".mysqli_error($mysqli);
        }
    }
?>


<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>Frontpage</title>
    <?php
        $loggedIn = false;
        if (isset($_SESSION['user_name'])){
            echo "<a href='profile.php'>My Profile </a>";
            echo "<a href='newPost.php'>New post</a>";
            $loggedIn = true;
        } else {
            echo "<a href='login.php'>Login </a>";
            echo "<a href='register.html'>Register</a>";
        }
    ?>
    <link rel = "stylesheet" type = "text/css" href = "stylesheet.css">
    <meta charset="UTF-8" />
  </head>
  <body>
    
    <?php
        $sqlPostList = ("SELECT * FROM post");
        $tableOfPosts = "<ul>";
        if ($result = $mysqli -> query($sqlPostList)){
            
            if ($loggedIn){
                
                while($row = mysqli_fetch_array($result)){
                    $entry = "<li><div class = 'post'>";
                    $entry .= '<span class = "postTitle">'.$row['title'].'</span><br>'.'<span class = "postAuthor">'.$row['author'].'</span>'.'<br>'.'<span class = "postContent"><p>'.$row['content'].'</p></span><br>';
                    $entry .= '<span id="commentBox"><form action = "index.php" method = "POST"><textarea rows ="5" cols="60" class = "commentBox" name="content" placeholder="Comment"></textarea><br><input type="submit" value = "Comment"><input type="hidden" name="id" value="'.$row['id'].'"/><input type="hidden" name="author" value="'.$_SESSION['user_name'].'"/></form></span>';
                
                    if (!(mysqli_num_rows($commentQuery = $mysqli -> query("SELECT * FROM comments WHERE post_ID = ".$row['id'].""))==0)){
                
                        $entry .= "<br>Comments:<br><ul>";
                
                        while ($comment = mysqli_fetch_array($commentQuery)){
                
                            $entry .= '<li><span class = "postAuthor">'.$comment['author'].'</span>'.'<span class = "postContent"><p>'.$comment['content'].'</p></span></li>';
                
                        }
                
                        $entry .= "</ul>";
                
                    }
                
                    $tableOfPosts .= $entry .= "</div></li><hr>";
                
                }
            } else {
                
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

            $tableOfPosts .= "</ul>";
            $mysqli -> close();
            echo $tableOfPosts;

        }
        
        
    ?>

    <footer><?php if ($loggedIn) { echo "<a href='logout.php'>Logout</a>"; } ?></footer>
  </body>
</html>
