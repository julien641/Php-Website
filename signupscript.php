<?php
require 'db_info.php';


$inputErr = true;
$emailErr= true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = "";
    $password = "";
    $email = "";
    $dateofbirth = "";
    $firstname = "";
    $lastname = "";
    $country = "";
    //firstname

    if ($_POST["password"] == $_POST["repeat_password"]) {
        if (!empty($_POST["firstname"])) {
            $firstname = test_input($_POST["firstname"]);
            if (!empty($_POST["lastname"])) {
                $lastname = test_input($_POST["lastname"]);

                if (!empty($_POST["username"])) {
                    $username = test_input($_POST["username"]);

                }
                if (!empty($_POST["password"])) {
                    $password = test_input($_POST["password"]);

                    $password = password_hash($password, PASSWORD_BCRYPT);

                    if (!empty($_POST["email"])) {

                        $email = test_input($_POST["email"]);
                        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            $emailErr = false;
                        }
                        if (!empty($_POST["date_of_birth"])) {
                            $dateofbirth = test_input($_POST["date_of_birth"]);

                            if (!empty($_POST["country"])) {
                                $country = test_input($_POST["country"]);
                                $inputErr = false;
                            }
                        }
                    }
                }
            }
        }
    }
}
if($inputErr==false && $emailErr==false) {
$rc="";
    //email username verification
    $rc_dup = query($db_info, "SELECT count(login_id) as login_count from login where username = ? OR email = ?", array('ss', $username, $email), false);
var_dump($rc_dup[0]["login_count"]);

    if ($rc_dup[0]["login_count"]==0){
echo 'entered';
    $rc_login = query($db_info, "INSERT INTO login (username, pw , email) values ( ? , ? , ?)", array('sss', $username, $password, $email), true);
        echo 'login success';
    $rc_login_id = query($db_info, "SELECT login_id from login WHERE username= ? AND pw= ?",  array('ss',$username, $password), false);
        echo 'login_id_select';
    $rc_us = query($db_info, "INSERT INTO us (firstname,lastname,dateofbirth,country,login_id) values (?,?,?,?,?);", array('ssssi', $firstname, $lastname, $dateofbirth, $country, $rc_login_id[0]["login_id"]), true);
        echo 'successs';
    }
}else {
        if($emailErr==true){
            echo 'email error';
        }
        if($inputErr==true){

            echo 'input is wrong';

        }
}

