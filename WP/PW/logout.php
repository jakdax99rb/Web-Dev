<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <link rel = "stylesheet" type = "text/css" href = "stylesheet.css">
    </head>
    <body>
        <?php
            if (isset($_SESSION["user_name"]))    
                session_unset();
                session_destroy();
                header("Location: index.php");
        ?>
    </body>
</html>
