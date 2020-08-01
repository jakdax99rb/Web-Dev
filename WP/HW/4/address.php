


<!DOCTYPE html>
  <head>
    <title>View</title>
    <h1>View an entries</h1>
  </head>

  <body>
    
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

            if(isset($_POST['search'])){
        
                $phone = $_POST['phone'];
                $fname = $_POST['fname'];
                $lname = $_POST['lname'];
    
                $sqlSearch = "SELECT * FROM $db_table WHERE (F_NAME = '$fname' or L_NAME = '$lname' or Phone_number = '$phone')";
               

                if ($result = $link -> query($sqlSearch) and !empty($result)){

                    if (mysqli_num_rows($result)==0) { echo mysqli_num_rows($result); }

                    $row = mysqli_fetch_array($result);
                    
                    $entry = "Name: ".$row["F_NAME"]." ".$row["L_NAME"];
                    $entry .= "<br>Address: ".$row["ADDRESS_LINE_1"]."<br>".$row["ADDRESS_LINE_2"]."<br>".$row["ADDRESS_LINE_3"];
                    $entry .= "<br>State: ".$row["Stage_Code"];
                    $entry .= "<br>Zip: ".$row["AddressID"];
                    $entry .= "<br>Phone: ".$row["Phone_number"];
                    $entry .= "<br>Email: ".$row["email_id"];
                    $entry .= "<br>ID: ".$row["id"];
                    echo $entry;
                } else {
                    echo "$result didnt work".mysqli_error($link);
                }
                
            } else {

                $sqlAddressList = "Select * from ".$db_table." Where id = ".$_POST['id'];

                if ($result = $link -> query($sqlAddressList)){

                    $row = mysqli_fetch_array($result);

                    $entry = "Name: ".$row["F_NAME"]." ".$row["L_NAME"];
                    $entry .= "<br>Address: ".$row["ADDRESS_LINE_1"]."<br>".$row["ADDRESS_LINE_2"]."<br>".$row["ADDRESS_LINE_3"];
                    $entry .= "<br>State: ".$row["Stage_Code"];
                    $entry .= "<br>Zip: ".$row["AddressID"];
                    $entry .= "<br>Phone: ".$row["Phone_number"];
                    $entry .= "<br>Email: ".$row["email_id"];
                    $entry .= "<br>ID: ".$row["id"];
                    echo $entry;
                } else{
                    echo "$result didnt work".mysqli_error($link);
                }
            }
                
                mysqli_close($link);
        }
    ?>
    
    <footer><a href="index.html">Return Home</a></footer>
  </body>
</html>
