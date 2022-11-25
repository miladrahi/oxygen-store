<?php session_start();
ob_start();
error_reporting(0);
//$_SESSION['menu'] = "editprofile";
//_SESSION['select'] $= '';
include("page_class.php");
?>
<!doctype html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <meta charset="utf-8"/>
    <title>اکسیژن کامپیوتر</title>
</head>

<body>
<div id="container">
    <?php include("header.php"); ?>


    <div id="body">

        <?php include("navigation.php");

        include("BuyClass.php");
        include("ShowProductClass.php");

        $buy = new BuyClass();

        $ShowProduct = new ShowProductClass();
        $buy->ShowMSG(); // when click in buy button show add to basket message
        $ShowProduct->SelectProductType(); // when click in type of product in navigation menu show product type
        $ShowProduct->ShowProductPage(); // show product detail page


        $buy->BuyProduct();  // when click in buy save product info in session

        ?>
    </div>

    <?php include("footer.php"); ?>

</div>

</body>
</html>
<?php ob_end_flush(); ?>
