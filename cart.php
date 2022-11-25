<?php session_start();
ob_start();
error_reporting(0);
$_SESSION['menu'] = "editprofile";
$_SESSION['select'] = '';
?>
    <!doctype html>
    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <meta charset="utf-8">
        <title>سبد خرید</title>
    </head>
    <body>
    <div id="container">
        <?php include("header.php"); ?>

        <div id="body">

            <table style="width: 1000px; background-color: #BBBBBB;box-shadow:0 0 10px #505050 ;margin-top: 40px">
                <tr>
                    <td colspan="6" height="30" class="caption">محصولات موجود در سبد خرید شما</td>
                </tr>
                <tr height="50px" style="background-color: #4b4b4b;color: #04e1ef">
                    <td style="width:10%;">عکس</td>
                    <td style="width:30%;">نام</td>
                    <td style="width:20%;">قیمت</td>
                    <td style="width:10%;">تعداد</td>
                    <td style="width:20%;">قیمت این تعداد</td>
                    <td style="width:10%;">حذف</td>
                </tr>


                <?php include("CartClass.php");
                $Cart = new CartClass();
                $Cart->ShowCart(); // show shopping cart
                $Cart->Submit(); // submit shopping cart and save data in database , order and invoice table
                $Cart->Reset(); // remove all product in shopping cart
                $Cart->btn(); // handle shopping cart button
                $Cart->RemoveOrder(); // remove order from shoping cart


                ?>
            </table>
            </form>

        </div>
        <?php include("footer.php"); ?>
    </div>
    </body>
    </html>
<?php ob_end_flush(); ?>