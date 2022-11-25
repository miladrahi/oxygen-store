<?php

class CartClass
{

    /*
   ======== function list ========

   Reset
   Submit
   ShowCart
   RemoveOrder
   btn
   QtyCheck

   ================================
    */

// Properties
    var $link;

// Constructor
    function CartClass(){
        $this->link = mysqli_connect("localhost", "root", "", "oxygen");
    }

    /*================================================================================
     \                          function  Reset                                \
     ================================================================================*/

    function Reset()
    {
        mysqli_query($this->link,"SET NAMES UTF8");
        if (isset($_POST['reset'])) {
            foreach ($_SESSION as $key => $value) {
                $id = substr("$key", 1);
                $sql = "SELECT * FROM `product` WHERE productid='$id'";

                $result = mysqli_query($this->link, $sql) or die();


                while ($row = mysqli_fetch_assoc($result)) {
                    unset($_SESSION['p' . $id]);
                }


            }
            header("refresh:0;");
        }

    }// ********* end function Reset *********


    /*================================================================================
     \                          function  Submit                                \
     ================================================================================*/

    function Submit()
    {

        mysqli_query($this->link,"SET NAMES UTF8");
        $msg = "";
        $check=true;
                if (isset($_POST['submit'])) {

                    if (isset($_SESSION["reguser"])) {

                        for ($i = 1; $i <= $_SESSION["numrow"]; $i++) {
                            $id = $_POST['name' . $i];
                            $qty = "qty$i";
                            if($this->QtyCheck($id,$_POST[$qty]))
                                $check=false;
                        }
                        if($check){
                            $totalprice = 0;
                            for ($i = 1; $i <= $_SESSION["numrow"]; $i++) {
                                $totalprice += $_POST['totalprice' . $i];
                            }
                            date_default_timezone_set('Asia/Tehran');
                            $date = date('Y-m-d H:i:s', time());

                            $sql = "INSERT INTO `invoice` VALUES (NULL ,'$_SESSION[reguser]','$totalprice','$date',0,0,0,0)";
                            mysqli_query($this->link, $sql) or die();

                            $sql = "SELECT invoiceid FROM invoice ORDER BY invoiceid DESC LIMIT 1";
                            $result = mysqli_query($this->link, $sql) or die();
                            $row = mysqli_fetch_row($result);

                            for ($i = 1; $i <= $_SESSION["numrow"]; $i++) {
                                $id = $_POST['name'.$i];

                                $qty = "qty$i";
                                $totalprice = "totalprice$i";


                                $sql = "INSERT INTO `productorder`VALUES(NULL,$id,$_POST[$qty],'$_POST[$totalprice]',$row[0])";

                                if (mysqli_query($this->link, $sql)) {

                                    $msg = "<p class='msgok' style='margin-bottom: 30px;'>سفارش شما با موفقیت ثبت شد</p>";



                                } else {

                                    $msg = "<p class='msgerror' style='margin-bottom: 30px;'>مشکل در ثبت اطلاعات</p>";

                                    break;

                                }

                            }
                            echo $msg;

                            $sql="SELECT * FROM `productorder` WHERE invoiceid=$row[0]";
                            $result = mysqli_query($this->link, $sql) or die();
                            while ($row=mysqli_fetch_assoc($result)) {
                                $sql = "UPDATE `product` SET `inventory` = (inventory-$row[qty]) WHERE productid = $row[productid]";

                                mysqli_query($this->link, $sql) or die();
                            }
                        }else {
                            echo "<p class='msgerror' style='margin-bottom: 30px;'>تعداد اجناس درخواستی شما از موجودی انبار بیشتر است</p>";

                        }


            } else {

                echo "<p class='msgerror' style='margin-bottom: 30px;'>برای سفارش اجناس با نام کاربری خود وارد شوید</p>";

            }


        }


    } // ********* end function Submit *********


    /*================================================================================
     \                          function  ShowCart                                \
     ================================================================================*/

    function ShowCart()
    {
        mysqli_query($this->link,"SET NAMES UTF8");
        $i = 0;
        $j = 0;
        $color = "#bfbfbf";
        foreach ($_SESSION as $key => $value) {
            $id = substr("$key", 1);

            $sql = "SELECT * FROM `product` WHERE productid='$id'";
            $result = mysqli_query($this->link, $sql) or die();

            while ($row = mysqli_fetch_assoc($result)) {
                //var_dump($row);
                if ($j == 0) {
                    $color = "#bfbfbf";
                } else if ($j == 1) {
                    $color = "#c6c5c5";
                } else if ($j == 2) {
                    $color = "#cecdcd";
                } else if ($j == 3) {
                    $color = "#d5d4d4";
                } else if ($j == 4) {
                    $color = "#dcdcdc";
                } else if ($j == 5) {
                    $color = "#e3e3e3";
                }else if ($j == 6) {
                    $color = "#eaeaea";
                }else if ($j == 7) {
                    $color = "#f0f0f0";
                }else if ($j == 8) {
                    $color = "#f4f3f3";
                }else if ($j == 9) {
                    $color = "#f5f5f5";
                }else if ($j == 10) {
                    $color = "#f6f6f6";
                }else if ($j == 11) {
                    $color = "#f8f7f7";
                }else if ($j == 12) {
                    $color = "#fcfcfc";
                    $j = -1;
                }
                $j++;
                ++$i;
                echo "<form action='' method='post'>
				<tr bgcolor=$color style='font-family:arial;'> 
				<td><img class='img-radius' src='" . $row['pimage'] . "' id='product' style='width:95px; height:66px;border-radius: 7%'></td>";

                echo " <td><input type='hidden' name='name$i' value=$id>" . $row["pname"] . "</td>";

                $price = $row['price'] / 1000;
                if ($price < 1000 && $price > 1)
                    $price = $price . " هزار تومان";
                elseif($price < 1)
                    $price = $price*1000 . " تومان";
                else
                    $price = ($price / 1000) . " میلیون تومان";

                echo "<td><input type='hidden' name='price$i' value='$row[price]'>" . $price . "</td>";
                echo "<td><input type='hidden' name='qty$i' value='$value'>" . $value . "</td> ";

                    $sum = $value * $row["price"];
                    $sum = $sum / 1000;
                    if ($sum < 1000 && $sum > 1)
                        $sum = $sum . " هزار تومان";
                    elseif($sum < 1)
                        $sum = $sum*1000 . " تومان";
                    else
                        $sum = ($sum / 1000) . " میلیون تومان";

                    $sumValue=$value * $row["price"];

                echo "<td><input type='hidden' name='totalprice$i' value='$sumValue'>" . $sum . "</td>";
                echo "<td><button type='submit' value='$id' name='remove'  class='btn4'>حذف</button></td></tr>";

            }

        }
        if (!isset($_POST['submit'])) {
            $_SESSION["numrow"] = $i;
        }


    } // ********* end function ShowCart *********


    /*================================================================================
     \                          function  RemoveOrder                                \
     ================================================================================*/

    function RemoveOrder()
    {
        if (isset($_POST['remove'])) {
            $id = $_POST['remove'];
            unset($_SESSION['p' . $id]);
            header("refresh:0;");
        }
    } // ********* end function RemoveOrder *********


    /*================================================================================
     \                          function  btn                                \
     ================================================================================*/

    function btn()
    {
        $num_rows = 0;
        mysqli_query($this->link,"SET NAMES UTF8");
        foreach ($_SESSION as $key => $value) {
            $id = substr("$key", 1);
            $sql = "SELECT * FROM `product` WHERE productid='$id'";
            $result = mysqli_query($this->link, $sql) or die();
            if (mysqli_num_rows($result))
                $num_rows++;

        }
        if ($num_rows > 0) {
            echo "<tr style='background-color: #dedfe1;text-align: center'>
	<td colspan='6' height='60px' style=''> <input class='btn3' type='submit' name='reset' value='خالی کردن سبد خرید' style='width:150px;margin-left: 5px'>
	<input class='btn5' type='submit' name='submit' value='ثبت سفارش' style='width:150px;'></td></tr>";
        } else {
            echo "<tr style='background-color: #acadaf;color: white'>
	        <td colspan='6' height='60px'>سبد خرید شما خالی می باشد</td></tr>";
        }

    } // ********* end function btn *********


    /*================================================================================
     \                          function  QtyCheck                                \
     ================================================================================*/

    function QtyCheck($id,$qty)
    {
        $this->link=mysqli_connect("localhost","root","","oxygen");
        $sql="SELECT * FROM product WHERE productid=$id";
        $result=mysqli_query($this->link,$sql);
        $row=mysqli_fetch_assoc($result);
        if($row['inventory']>=$qty)
            return false;

        return true;

    }// ********* end function QtyCheck *********

} // ==================// END CartClass //==================


?>