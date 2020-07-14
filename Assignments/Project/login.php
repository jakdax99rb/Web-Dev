<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>Login</title>
    <a href="index.php">Frontpage</a>
    <meta charset="UTF-8" />
  </head>
  <body>
    <form action="login.php" method="POST">
      Username:
      <input type="text" name="username" placeholder="Username" />
      <br />
      Password:
      <input type="text" name="password" placeholder="Password" />
      <br />
      <input type="submit" name="login" value="Log in" />
    </form>

    <?php

        if (! empty( $_POST )) {
            if ( isset($_POST['username']) && isset($_POST['password'] ) ){
        
                $db_host = 'localhost';
                $db_user = 'root';
                $db_pass = '';
                $db_name = 'forum';    
                $table='users';

                $con = new mysqli($db_host, $db_user, $db_pass, $db_name,"3308");
                $stmt = $con->prepare("SELECT * FROM users WHERE username = ?");
                $stmt->bind_param('s', $_POST['username']);
                $stmt->execute();
                $result = $stmt->get_result();
                $user = $result->fetch_object();
                    
                // Verify user password and set $_SESSION
                if ( password_verify( $_POST['password'], $user->password ) ) {
                    $_SESSION['user_name'] = $user->username;
                    header("Location: profile.php");
                } else {
                    echo "Login unsuccessful, try again.<br>";
                }
                
                $con -> close();

            }   
        }

    ?>

    Dont have an account?
    <a href="register.html">Register here</a>
    <footer></footer>
  </body>
</html>

