<?php
global $db_info;
require 'db_info.php';
require 'db_library.php';
//ini_set('display_errors',1);
//error_reporting(E_ALL);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();

    $folder_dirs = "users/".$_SESSION['username']."/items_pic";
   // $folder_dir = "./upload/" . $_SESSION['username'] . "/items_pic/";
    dirmaker($folder_dirs);

  $file_dir = fileuploader($_FILES['nfile'],$folder_dirs);

if($file_dir!=null){
    $clean = strip_all($_POST);
    if(checkarrayfilled($clean)) {
        $qz = "INSERT INTO objects (name,costs,picture_address,owner_id) values(?,?, ?,?)";
        $rc_login = query($db_info, $qz, array('sdsi', $clean['name'], $clean['ncost'], $file_dir, $_SESSION['id']), true);
        header("Location:objectform.php");
    }
}else{
    echo 'not worth';
}
   // var_dump($_FILES);



}