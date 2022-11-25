<?php session_start();
ob_start();
error_reporting(0);
?>
<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script language="javascript" type="text/javascript" src="js/main.js"></script>
    <script src="ckeditor/ckeditor.js"></script>
    <meta charset="utf-8"/>
    <title>پروفایل</title>
</head>

<body>


<div id="container">
    <?php include("header.php"); ?>

    <div id="body">
        <?php

        include("navuser.php");
        include("ProfileClass.php");

        $profile = new ProfileClass();
        $profile->login(); // login in profile page
        $profile->logout(); // logout user
        $profile->edit_profile(); // edit user profiule
        $profile->manage_user(); // admin can manage user, remove or edit user profile
        $profile->reg_product(); // register new product in website
        $profile->manage_reg_product(); // admin can manage registered product , edit or remove product
        $profile->manage_order(); // admin can manage order
        $profile->search_order(); // admin can search invoice and show order detail


        ?>

    </div>

    <?php include("footer.php"); ?>

</div>

<script>
    CKEDITOR.replace('comment');
</script>

</body>
</html>