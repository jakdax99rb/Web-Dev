<!DOCTYPE html>
  <head>
    <title>Remove</title>
    <h1>Remove some entries</h1>
  </head>

  <body>
    
    <?php
    
      $db_host = 'mydb.ceyhk5htyork.us-east-2.rds.amazonaws.com';
      $db_user = 'admin';
      $db_pass = '7pMCCB57xwEe';
      $db_name = 'cw4';
      $db_table = "AddressBook";

      $link = mysqli_connect($db_host, $db_user, $db_pass, $db_name,"3306");

      if(!$link){
          die('Connection failed: '.$link->connect_error);
      }


      if(!empty($_POST)){

        $sqlDelete = "DELETE FROM $db_table WHERE id = ".$_POST['id'];
        if ($result = $link -> query($sqlDelete)){
            echo "Item Deleted";
        }

      }


      $sqlAddressList = "SELECT * FROM ".$db_table;
      $tableOfAddresses = "<ol>";
      
      if ($result = $link -> query($sqlAddressList)){
        
        while ($row = mysqli_fetch_array($result)){

          $entry = "<li>";

          $entry .= "Name: ".$row["F_NAME"]." ".$row["L_NAME"]."<br>";
          $entry .= "ID: ".$row["id"];
          $entry .= "<form action = 'remove.php' method='POST'><input type='submit' value = 'Remove'></input><input type='hidden' name='id' value = '".$row['id']."'></input></form>";

          $entry .= "</li><hr><br>";

          $tableOfAddresses .= $entry;
        }

      } else {
        echo $mysqli_error($link);
      }
      $tableOfAddresses .= "</ol>";
      echo $tableOfAddresses;
      $link -> close();

      
    ?>
    <footer><a href="index.html">Return Home</a></footer>
  </body>
</html>

