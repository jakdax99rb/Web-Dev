<?php
      function exercise1() {
        echo "<script>console.log('hello world!');</script>";
      }
      
      function exercise2($number) {
        for ($forLoopCounter=1; $forLoopCounter <= $number; $forLoopCounter++){
          echo "<script>console.log('".str_repeat("*",$forLoopCounter)."');</script>";
        }
      }

      function exercise3($inputString) {
        
        $inputString = trim($inputString);
        echo "<script>console.log('".str_word_count($inputString,0)."');</script>";
        
      }

      function exercise4($str){
        
        $str = trim($str);
        $str = strtolower($str);
        $strArray = explode(" ", $str);
        $countArray = [];


        for ($count = 0; $count < sizeOf($strArray); $count++){
          $countArray[$strArray[$count]] = substr_count($str, $strArray[$count]);
        }
        print_r($countArray);
      }

      if (!empty($_POST)){

        print_r($_POST);
        mail("jbaird5@student.gsu.edu", "Stuff and ting", implode(" | ",$_POST), "From: WPSSummer@cs.gsu.edu");

      }

      exercise1();
      exercise2(5);
      exercise3("This is a sentance");
      exercise4("This counts the number of words in that repeat in a sentence see?");
?>


<!DOCTYPE html>
<html lang="en-US">
  <head></head>
  <body>
  <form action="cw8.php" method="POST">
      Name:
      <input type="text" name="name" placeholder="Name" />
      <br />
      Age:
      <input type="text" name="age" placeholder="age" />
      <br />
      Education:
      <input type="text" name="education" placeholder="education" />
      <br />
      Contact Email:
      <input type="text" name="email" placeholder="Email" />
      <br />
      Phone:
      <input type="text" name="phone" placeholder="phone" />
      <br />
      Address:
      <br />
      <textarea rows = 5 cols =20 name = "address"></textarea>
      <br />
      <input type="submit" name="register" value="Register" />
    </form>
  </body>
</html>
