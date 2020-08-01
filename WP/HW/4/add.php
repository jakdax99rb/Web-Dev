<!DOCTYPE html>
  <head>
    <title>ADD AN ENTRY</title>
    <h1>ADD AN ENTRY</h1>
  </head>

  <body>
      
    <form action="add.php" method="POST">
      <label for="fname">First name: </label>
      <input type="text" name="fname" placeholder="First Name"></input>
      <br>

      <label for="lname">Last name: </label>
      <input type="text" name="lname" placeholder="Last Name"></input> 
      <br>
      
      <label for="address1">Address Line 1: </label>
      <input type="text" name ="address1" placeholder="Address Line 1"></input>
      <br>
      <label for="address2">Address Line 2: </label>
      <input type="text" name ="address2" placeholder="Address Line 2"></input>
      <br>
      <label for="address3">Address Line 3: </label>
      <input type="text" name ="address3" placeholder="Address Line 3"></input>
      <br>

      <label for="state">State (2 letters): </label>
      <input type="text" name ="state" placeholder="GA"></input>
      <br>

      <label for="zip">Zipcode: </label>
      <input type="text" name ="zip" placeholder="30156"></input>
      <br>

      <label for="email">Email: </label>
      <input type="text" name ="email" placeholder="Email"></input>
      <br>

      <label for="phone">Phone Number:  </label>
      <input type="text" name ="phone" placeholder="Phone #"></input>
      <br>
      <input type = "reset" value="Reset"></input>
      <input type="submit" value="Submit"></input>
    </form>
    <footer><a href="index.html">Return Home</a></footer>
  </body>
</html>


<?php
  if (!empty($_POST)){
    $db_host = 'mydb.ceyhk5htyork.us-east-2.rds.amazonaws.com';
    $db_user = 'admin';
    $db_pass = '7pMCCB57xwEe';
    $db_name = 'cw4';
    $db_table = "AddressBook";

    $link = mysqli_connect($db_host, $db_user, $db_pass, $db_name,"3306");

    if(!$link){
        die('Connection failed: '.$link->connect_error);
    }

    $sqlAdd = "INSERT INTO ".$db_table." (ADDRESS_LINE_1, ADDRESS_LINE_2, ADDRESS_LINE_3, AddressID, email_id, F_NAME, L_NAME, Phone_number, Stage_Code) ";
    $sqlAdd .= "VALUES ("."'".$_POST['address1']."',"."'".$_POST['address2']."',"."'".$_POST['address3']."',".$_POST['zip'].","."'".$_POST['email']."',"."'".$_POST['fname']."',"."'".$_POST['lname']."',"."'".$_POST['phone']."',"."'".$_POST['state']."'".")";

    if (mysqli_query($link, $sqlAdd)){
      echo $response = "Added successfully";
    } else{
      echo $response = "Error: ".mysqli_error($link);
    }
    $mysqli -> close();
  }
?>
