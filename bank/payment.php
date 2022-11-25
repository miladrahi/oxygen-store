<link rel="stylesheet" type="text/css" href="../css/style.css">
<?php
session_start();
if(isset($_SESSION['payment']) && $_SESSION['payment']==1 && isset($_SESSION['reguser']) && isset($_SESSION['invoiceid']))
{
   echo "<div class='field' style='width: 600px;height: 400px;margin-top: 150px;'><div style='font-size: 18px;margin:120px auto 15% auto'>کاربر گرامی پرداخت شما با شماره پیگیری ۸۳۶۰۲۸۴ انجام شد</div>";
            echo '<div><form action="" method="post">
	<input type="submit" class="btn11" value="تایید پرداخت" name="confirmpayment" style="height: 50px;font-size: 16px" >
	</form></div></div>';

    if(isset($_POST['confirmpayment']))
    {
        $link=mysqli_connect("localhost","root","","oxygen");
        $sql="UPDATE `invoice` SET `paid` = '1' WHERE `invoice`.`invoiceid` = ".$_SESSION['invoiceid'].";";
        echo $sql;
        mysqli_query($link,$sql) or die();
        header('location: ../profile.php?usermenu=paid');
        $_SESSION['payment']=0;
    }
   }else
{
    echo "<div class='field' style='width: 33%;margin-top: 15%;'><div style='margin:12% auto 15% auto'>خطا ! اطلاعاتی جهت نمایش وجود ندارد</div>";
    echo '<div><form action="" method="post">
	<input type="submit" class="btn11" value="بازگشت به سایت" name="backtosite" >
	</form></div></div>';

    if(isset($_POST['backtosite']))
    {
        header('location: ../profile.php?pageorder=1');
    }
}
