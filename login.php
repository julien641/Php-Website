<?php
require 'db_library.php';

$username="";
$password="";
$nameErr = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (!empty($_POST["username"])) {
  $username = test_input($_POST["username"]);
          if (!empty($_POST["password"])) {
              $password = test_input($_POST["password"]);
              $nameErr = true;
          }
      }

}

if( $nameErr==true){

        $rc_login = query($db_info,"SELECT pw, login_id,privilege FROM login where username = ?;",array('s',$username),false);
       var_dump($rc_login);

        $pw_verify=password_verify("$password",$rc_login[0]['pw']);
    if( $pw_verify==false){
        echo 'error';
        exit();


    }
   $rc_us =query($db_info,"SELECT user_id FROM us where login_id = ?;",array('s',$rc_login[0]["login_id"]));
          /*
           * 1) what to do next
           * 2) what to check
           *
           * (1) dependency
           * (2)
           * */

     session_start();

      $_SESSION["id"] =$rc_login[0]["login_id"];


        $_SESSION['privilege']=$rc_login[0]['privilege'];
   // $_SESSION['username']=$returnusername;
  //  $_SESSION['name']=$name;

header('Location:index.php');
 }else{

exit();
 }

      function test_input($data){
      $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

?>