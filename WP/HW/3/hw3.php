<?php

    $color = $_POST["color"];
    $bgcolor = $_POST["background-color"];
    $weight = $_POST["font-weight"];
    $text = $_POST["text"];

?>

<!DOCTYPE html>
  
    <head>
        <style>

            p{
                color: <?php echo $color ?>;
                background-color: <?php echo $bgcolor ?>;
                font-weight: <?php echo $weight ?>;
            }

        </style>
    </head>

    <body>
        <p><?php echo $text ?></p>
    </body>

</html>
