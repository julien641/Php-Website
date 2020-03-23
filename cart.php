<!DOCTYPE html>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>PropheticGaming</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

    <!-- <link rel="stylesheet" href="css/normalize.css"> -->
    <link rel="stylesheet" href="css/views.css">
    <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>

</head>
<body id="body">
<?php
//$_SESSION['cart']=null;
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
//$_SESSION['cart']=null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["objects_id"],$_POST["count"])) {
        if($_POST["count"]>0){
        if (!isset($_SESSION['cart'][$_POST["objects_id"]]) ) {
            //   echo 'sup';
            $_SESSION['cart'][$_POST["objects_id"]] = array('objects_id' => $_POST["objects_id"],
                "count" => 0);
        }
        }
        //  var_dump($_SESSION['cart'][ $_GET["objects_id"] ] ["count"]);
            if(isset($_SESSION['cart'][$_POST["objects_id"]])) {
                $_SESSION['cart'][$_POST["objects_id"]]["count"] = ($_SESSION['cart'][($_POST["objects_id"])]["count"]) + ($_POST["count"]);
                if ($_SESSION['cart'][$_POST["objects_id"]]["count"] + 0 <= 0) {
                    unset($_SESSION['cart'][$_POST["objects_id"]]);
                    //   if( $_SESSION['cart']){


                    // }

                }
            }
         var_dump($_POST);
        echo '<br>sess';
         var_dump($_SESSION);
    }
}


?>
<div>
    <?php
    require_once 'algorithm_cart.php';


    if (isset($_SESSION['cart'])) {
        if(count($_SESSION['cart'])>0) {
            $objectslist = queryobjects($_SESSION['cart']);
            //  var_dump($objectslist);
            foreach ($objectslist as $key => $value) {
                $format = '
<div  class="small_objects">
<img src="%1$s" width="100" height="100">
<br>
%2$s %6$s 
<br>
<form action="cart.php" method="POST">
 <input type="hidden" id="objects_id" name="objects_id" value=%3$s>
 <button type="submit" id="m" value="1"  name="count">+</button>
  <button  type="submit" id="p" value="-1"name="count" >-</button>
    <button  type="submit" id="p" value="-100000"name="count" >remove from cart</button>
 </form>
 <form action="cart.php" method="POST">
    <input type="tel" id="icount" name="count" pattern="[0-9]{0,2}">
    <input type="hidden" id="objects_id" name="objects_id" value=%3$s>
     <input type="submit" id="submit" />

 </form>
</div>
';
                $urlinc = sprintf($format, $value["picture_address"], $value["name"], $value["Objects_ID"], "p", "m", $_SESSION["cart"][$value["Objects_ID"]]['count']);
                echo $urlinc;
            }
        }else{
            echo "The cart is empty";

                   }
    }
    ?>
</div>
<br>
<?php

$objectslist = queryobjects(null);

//var_dump($objectslist);
//location.href='loginpage.php';
foreach ($objectslist as $key => $value) {
    $format = '
<div class="small_objects">
<img src="%1$s" width="100" height="100">
<br>
%2$s
<br>
<form action="cart.php" method="POST">
 <input type="hidden" id="objects_id" name="objects_id" value=%3$s>
 <button type="submit" id="m" value="1"  name="count">+</button>
  <button  type="submit" id="p" value="-1"name="count" >-</button>
  
 </form>
 <form action="cart.php" method="POST">
    <input type="tel" id="icount" name="count" pattern="[0-9]{0,2}">
    <input type="hidden" id="objects_id" name="objects_id" value=%3$s>
     <input type="submit" id="submit" />

 </form>
</div>
';
    $urlinc = sprintf($format, $value["picture_address"], $value["name"], $value["Objects_ID"], "p", "m");
//\"/cart.php?objects_id=\\"{
    // $value[\"Objects_ID\"]}\\"\\"
    echo $urlinc;


}

?>
</body>
</html>