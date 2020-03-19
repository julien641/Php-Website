<!DOCTYPE html>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>PropheticGaming</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

    <!-- <link rel="stylesheet" href="css/normalize.css"> -->
    <link rel="stylesheet" href="css/signup.css">
    <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>

</head>
<body id="body">
<form action="addObject.php" method="POST" enctype="multipart/form-data">
    <label for="fname">Item name:</label>
    <br>
    <input type="text" id="name" name="name">
    <br>
    <label for="fcost">cost</label><br>
    <input type="tel" id="idcost" name="ncost" pattern="[0-9]{0,}.{0,1}[0-9]{0,2}">
    <br>
    <label for="forimage">Select a image:</label>
    <input type="file" id="ifile" name="nfile">
    <!--
    item name
    cost
    picture
    description
    -->
     <br>
     <input type="submit" value="Submit">
    <?php
    session_start();
    var_dump($_SESSION);


    ?>
 </form>

 </body>
 </html>