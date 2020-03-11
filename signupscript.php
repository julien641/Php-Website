<?php
require 'db_info.php';
require 'db_library.php';


//echo 'hi';
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //firstname
    $cleanbool = false;
    if ($_POST["password"] == $_POST["repeat_password"]) {
     //   echo 'pass';
        if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        //    echo 'email';
            $clean = strip_all($_POST);

        }else{
            header('Location:signuppage.php?error=1');

        }
    }else{
        header('Location:signuppage.php?error=1');


    }
 //   var_dump($clean);
    if (checkarrayfilled($clean)) {

    //    var_dump($clean);
        $rc = "";
        //email username verification
        $rc_dup = query($db_info, "SELECT count(login_id) as login_count from login where uname = ? OR email = ?", array('ss', $clean["username"], $clean["email"]), false);
       $pass= password_hash($_POST["password"], PASSWORD_BCRYPT);
        if ($rc_dup[0]["login_count"] == 0) {

            $executes=array('sssssi',$pass, $clean['username'],  $clean['email'], $clean['firstname'], $clean['lastname'],1);
        //    echo '<br>';
          //  var_dump( $executes);
       //     echo 'entered';
            $rc_login = query($db_info, "INSERT INTO login (pw, uname,email,firstname,lastname,privilege) values ( ? , ? , ?,? , ? , ? )",$executes , true);
         //   echo 'login success';
            $rc_login_id = query($db_info, "SELECT login_id,privilege from login , WHERE uname= ? AND pw= ?", array('ss', $clean["username"], $pass), false);
            session_start();
            $_SESSION["ID"]=$rc_login_id[0]["login_id"];
            $_SESSION["privilege"]=$rc_login_id[0]["privilege"];
          //  var_dump($_SESSION);
            header("Location:index.php");
        }else{

            header('Location:signuppage.php?error=1');


        }
    } else {
        header('Location:signuppage.php?error=1');
    }
}

