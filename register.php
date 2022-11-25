<?php session_start();
//$_SESSION['menu'] = "editprofile";
//$_SESSION['select'] = '';
ob_start();
error_reporting(0);
?>
<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <script language="javascript" type="text/javascript" src="js/main.js"></script>
    <title>ثبت نام</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
<div id="container">

    <?php include("header.php"); ?>

    <div id="body">

        <?php
        include("RegisterClass.php");
        $reg = new RegisterClass();
        $reg->Register();// register function , user can register in website
        $reg->Reset(); // reset register web page and try to check another username and email

        ?>
        </fieldset>

    </div>
    <?php include("footer.php"); ?>

</div>
</body>
</html>