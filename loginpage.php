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


<body id="loginbody" onkeydown="verifyKey(event);">
    <?php
    if(isset( $_SESSION['privilege'])){
            header('Location:home.php');
    }
?>

            <div id="enclosedlogin">
                <form action="login.php" method="post">
                    <div id="dividentification">
                        <span id="identification">
                     <input required type="text" name="username"placeholder ="Username">
                     <br>
                     <input required type="password" name="password" placeholder ="password">
                </span>
                    <br/>
                    <span id="captcha">
                  <!--  <div class="g-recaptcha" data-sitekey="6LeAHi4UAAAAAAm586RsViLLGp6BHNarD-nwxhl4"></div>-->
                </span>
                <br/>
                    <span id=submit>
                    <input type="submit" value="login">
                    </span>
                </form>


            </div>





        <div id="footer">
        </div>

</body>

<!--
                    <div id="buttons1">
                        
                        <button type="button" id="leftb" onclick= "drawleft();" >left</button>
                        <button type="button" id="rightb" onclick= "drawright();">right</button>
                        <button type="button" id="downb" onclick= "drawdown();">down</button>
                        <button type="button" id="upb" onclick= "drawup()">up</button>
                        <button type="button" id="resetb" onclick= "drawreset(1)">reset/start</button>
            
                    </div>
            -->


<!--  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
            <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
            <script src="js/plugins.js"></script>
			-->


<!--
                            <script>
                    var _gaq = [['_setAccount', 'UA-XXXXX-X'], ['_trackPageview']];
                    (function (d, t) {
                        var g = d.createElement(t), s = d.getElementsByTagName(t)[0];
                        g.src = '//www.google-analytics.com/ga.js';
                        s.parentNode.insertBefore(g, s)
                    }(document, 'script'));
                            </script>-->


</html>