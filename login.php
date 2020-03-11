<?php
require 'db_library.php';
require 'db_info.php';
$username="";
$password="";

//var_dump($_SERVER);
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $clean= strip_all($_POST);


    if (checkarrayfilled($clean)) {
     //   var_dump($clean);
        $rc_login = query($db_info, "SELECT login_id, pw ,privilege FROM login where uname = ?;", array('s', $clean["username"]), false);

        var_dump($rc_login);
        $pw_verify = password_verify($clean["password"], $rc_login[0]['pw']);
        if ($pw_verify == true) {

            session_start();
            $_SESSION["id"] = $rc_login[0]["login_id"];
            $_SESSION['privilege'] = $rc_login[0]['privilege'];

            header('Location:index.php');


        } else {

            header('Location:loginpage.php?error=1');
        }

    } else {
        header('Location:loginpage.php?error=1');
    }

}
