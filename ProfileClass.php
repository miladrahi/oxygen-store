<?php

include("page_class.php");

class ProfileClass
{
    /*
    ======== function list ========

    edit_profile
    manage_user
    ShowUserInfo
    reg_product
    manage_reg_product
    manage_order
    search_order
    logout
    login
    ShowOrder
    validate
    showinvoice
    priceConvertor
    TypeConvertor

    ================================
     */

// Properties
    var $link;

// Constructor
    function ProfileClass(){
        $this->link = mysqli_connect("localhost", "root", "", "oxygen");
    }


    /*================================================================================
     \                          function  edit_profile                               \
     ================================================================================*/


    function edit_profile()
    {

        if (isset($_POST['btn_editUser'])) {

            /* if ($_POST['name'] == "" || $_POST['family'] == "" || $_POST['username'] == ""
                 || $_POST['email'] == "" || $_POST['password'] == "" || $_POST['tel'] == "" || $_POST['postalcode'] == "" || $_POST['address'] == "") {
                 echo "<p class='msgerror'>اطلاعات تمام فیلد ها را تکمیل کنید</p>";
             } else {*/

            if ($this->validate($_POST) == "OK") {
                mysqli_query($this->link, "SET NAMES 'UTF8'");

                $sql = "UPDATE `user` SET `email` = '$_POST[email]', `password` = '" . $_POST["password"][0] . "', `name` = '$_POST[name]', `family` = '$_POST[family]', `gender` = $_POST[gender] ,`address` = '$_POST[address]', `postalcode` = '$_POST[postalcode]', `tel` = '$_POST[tel]' WHERE `user`.`username` ='" . $_SESSION['edituserprofile'] . "';";

                if (mysqli_query($this->link, $sql)) {
                    echo "<p class='msgok'>تغییرات با موفقیت انجام شد</p>";
                    header('refresh:3');
                } else {
                    echo "<p class='msgerror'>مشکل در ثبت اطلاعات</p>";
                }
            } else {
                echo "<div style='line-height: 30px'><p class='msgerror'>خطاهایی در اصلاح اطلاعات رخ داده است</p>";
                echo "<p class='msgerror'>" . $this->validate($_POST) . "</p>";
                echo "<p class='msgerror'>لطفا دوباره امتحان کنید</p></div>";
            }

        }

        if (isset($_SESSION['reguser'])) {
            if (basename($_SERVER['REQUEST_URI']) == "profile.php") {
                header('location: ?usermenu=editprofile');

            }

            if (isset($_GET['usermenu']) && $_GET['usermenu'] == 'editprofile' && $_SESSION['menu'] != "editprofile") {
                $_SESSION['menu'] = "editprofile";
                header("refresh:0;");
            }

            if ($_SESSION['menu'] == "editprofile") {
                mysqli_query($this->link, "SET NAMES 'UTF8'");
                if (isset($_SESSION['select']) && $_SESSION['select'] == 'edituser' && $_SESSION['reguser'] == 'admin') {
                    $sql = "SELECT * FROM `user` WHERE username='$_SESSION[edituserprofile]'";

                } else {
                    $sql = "SELECT * FROM `user` WHERE username='$_SESSION[reguser]'";
                    $_SESSION['edituserprofile'] = $_SESSION['reguser'];
                }

                $result = mysqli_query($this->link, $sql) or die();
                $row = mysqli_fetch_assoc($result);

                echo '<div class="msgerror" style="line-height: 25px" > <p id="fnmsg"></p><p id="lnmsg"></p><p id="usermsg"></p>
                              <p id="emailmsg"></p><p id="pass1msg"></p><p id="pass2msg"></p><p id="addressmsg"></p><p id="postmsg"></p><p id="telmsg"></p> </div>
<form method="post" class="field4">
        <div style="margin:auto">تغییر پروفایل کاربری</div>
        <div class="tbl" style="margin-right: 22px;margin-top: 20px">

        <div class="row">
            <div class="cell">نام کاربری</div>
            <div class="cell"><input class="txt3" type="text" name="username" id="user" readonly value="' . $row['username'] . '"></div>
        </div>
        <div class="row">
            <div class="cell">ایمیل</div>
            <div class="cell"><input class="txt3" type="text" name="email" id="email" value="';
                if (isset($_POST['email'])) echo $_POST['email']; else echo $row['email'];
                echo '" style="direction: ltr"></div>
        </div>
        <div class="row">
            <div class="cell">رمز عبور</div>
            <div class="cell"><input class="txt3" type="password" value="';
                if (isset($_POST['password'])) echo $_POST['password'][0]; else echo $row['password'];
                echo '" name="password[]" id="pass1" style="direction: ltr"></div>
        </div>
        <div class="row">
            <div class="cell">تکرار رمز عبور</div>
            <div class="cell"><input class="txt3" type="password" name="password[]" id="pass2" value="';
                if (isset($_POST['password'])) echo $_POST['password'][1]; else echo $row['password'];
                echo '" style="direction: ltr"></div>
        </div>
        <div class="row">
            <div class="cell">نام</div>
            <div class="cell"><input class="txt3" type="text" name="name" id="firstname" value="';
                if (isset($_POST['name'])) echo $_POST['name']; else echo $row['name'];
                echo '"></div>
        </div>
        <div class="row">
            <div class="cell">نام خانوادگی</div>
            <div class="cell"><input class="txt3" type="text" name="family" id="lastname" value="';
                if (isset($_POST['family'])) echo $_POST['family']; else echo $row['family'];
                echo '"></div>
        </div>
        <div class="row">
            <div class="cell">جنسیت</div>
            <div class="cell">
            <select name="gender" id="gender" class="txt3">
            <option value=0';
                if ($row['gender'] == 0) echo " selected";
                echo '>مرد</option>
            <option value=1';
                if ($row['gender'] == 1) echo " selected";
                echo '>زن</option>
            </select>
            </div>
        </div>
        <div class="row">
            <div class="cell">آدرس</div>
            <div class="cell"><input class="txt3" type="text" name="address" id="address" value="';
                if (isset($_POST['address'])) echo $_POST['address']; else echo $row['address'];
                echo '"></div>
        </div>
        <div class="row">
            <div class="cell">کدپستی</div>
            <div class="cell"><input class="txt3" name="postalcode" id="postalcode" type="text" value="';
                if (isset($_POST['postalcode'])) echo $_POST['postalcode']; else echo $row['postalcode'];
                echo '" style="direction: ltr"></div>
        </div>
        <div class="row">
            <div class="cell">شماره تماس</div>
            <div class="cell"><input class="txt3" name="tel" type="text" id="tel" value="';
                if (isset($_POST['tel'])) echo $_POST['tel']; else echo $row['tel'];
                echo '" style="direction: ltr"></div>
        </div>
        <div class="row">
            <div class="cell"></div>
            <div class="cell" "><input class="btn6" type="submit" name="btn_editUser" value="اعمال تغییرات" style="margin-top: 20px"></div>
        </div>
    </div>

</form>';

            }
        }

    } // ********* end function edit_profile *********


    /*================================================================================
     \                          function  manage_user                                \
     ================================================================================*/

    function manage_user()
    {

        if (isset($_GET['usermenu']) && $_GET['usermenu'] == 'manageuser' && $_SESSION["reguser"] == "admin") {

            $_SESSION['menu'] = "manageuser";
            $_SESSION['select'] = "manageuser";
            header('refresh:0');

            $url = basename($_SERVER['PHP_SELF']) . "?pageorder=1";
            header("location: $url");
        }

        if (isset($_SESSION['menu']) && $_SESSION['menu'] == "manageuser" && isset($_GET['pageorder'])) {
            //var_dump($_SESSION);
            echo "<div style='width: 1000px;margin-right: 300px'>
            <form action='' method='post'>
            <table name='tbl1' id='tbl1' style='width: 100%'>";

            echo "<tr><td colspan='8' class='caption'>مدیریت کاربران</td></tr> 
          <tr style='background-color: #4b4b4b;color: #04e1ef'>
          	<td height='50' style='width:160px;'>نام کاربری</td>
          	<td style='width:160px;'>ایمیل</td>
            <td style='width:160px;'>نام</td>
            <td style='width:160px;'>نام خانوادگی</td>
            <td style='width:80px;'>جنسیت</td>
			<td style='width:110px;'>شماره تماس</td>
			<td style='width:130px;'></td>
			<td style='width:40px;'></td>
          </tr>        
          
          ";

            $condition = '1';
            $this->ShowUserInfo($condition);


        }

        //----------------edituser----------------

        if (isset($_POST['edituser']) && $_SESSION['reguser'] == 'admin') {
            $username = $_POST["edituser"];
            $_SESSION['select'] = 'edituser';
            $_SESSION['edituserprofile'] = $username;
            header('location: ?usermenu=editprofile');

        }
        //----------------removeuser----------------

        if (isset($_POST['removeuser']) && $_SESSION['reguser'] == 'admin') {
            
            $username = $_POST["removeuser"];

            $sql = "SELECT invoiceid FROM `invoice` WHERE user='$username'";
            $result = mysqli_query($this->link, $sql) or die();
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['invoiceid'];
                $sql = "DELETE FROM `productorder` WHERE invoiceid='$id'";
                mysqli_query($this->link, $sql) or die();
            }
            $sql = "DELETE FROM `invoice` WHERE user='$username'";
            mysqli_query($this->link, $sql) or die();

            $sql = "DELETE FROM `user` WHERE username='$username'";
            mysqli_query($this->link, $sql) or die();

            header("refresh:0;");

        }


    } // ********* end function  manage_user *********


    /*================================================================================
    \                          function ShowUserInfo                                 \
     ================================================================================*/

    function ShowUserInfo($condition)
    {
        if ($_SESSION['menu'] == "manageuser" && $_SESSION['select'] == "manageuser" && $_SESSION['reguser'] == 'admin') {
            
            mysqli_query($this->link, "SET NAMES 'UTF8'");

            $i = 0;
            $j = 0;
            $color = "#DAF1FF";


            //------------------------------------------------------

            $per_page = 8;

            $pageadmin = new page_class($per_page, 'pageorder');

            //error_reporting(0); // disable the annoying error report
            $sql = "SELECT * FROM `user` WHERE $condition GROUP BY username";

            $result = mysqli_query($this->link, $sql) or die();
// paging start
            $row_counts = mysqli_num_rows($result);
            $pageadmin->specify_row_counts($row_counts);
            $starting_record = $pageadmin->get_starting_record();

            $sql = "SELECT * FROM `user` WHERE $condition GROUP BY username LIMIT $starting_record, $per_page";

            $result = mysqli_query($this->link, $sql) or die();
            $number = $starting_record; //numbering
            $num_rows = mysqli_num_rows($result);
            if ($num_rows == 0) {   // if no result is found
                echo "<tr class='notice' style=' height: 50px'>
     <td colspan='8' class=note>اطلاعاتی برای نمایش وجود ندارد</td>
     </tr></table></form>";

                if ($_GET['pageorder'] > 1) {
                    $page = $_GET['pageorder'] - 1;
                    header('location:?pageorder=' . $page . '');
                }

            } else {
                if ($_GET['pageorder'] == 1) {
                    $starting_record = 0;

                } else {
                    $starting_record = ($_GET['pageorder'] * 8) - 8;
                }
            }

            $sql = "SELECT * FROM `user` WHERE $condition GROUP BY username LIMIT $starting_record, 8";


            //------------------------------------------------------


            $result = mysqli_query($this->link, $sql) or die();
            mysqli_query($this->link, "SET NAMES 'UTF8'");

            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['username'] != 'admin') {
                    if ($j == 0) {
                        $color = "#bfbfbf";
                        $j++;
                    } else if ($j == 1) {
                        $color = "#c7c7c7";
                        $j++;
                    } else if ($j == 2) {
                        $color = "#d0cece";
                        $j++;
                    } else if ($j == 3) {
                        $color = "#d9d8d8";
                        $j++;
                    } else if ($j == 4) {
                        $color = "#e2e1e1";
                        $j++;
                    } else if ($j == 5) {
                        $color = "#e7e7e7";
                        $j++;
                    } else if ($j == 6) {
                        $color = "#ececec";
                        $j++;
                    } else if ($j == 7) {
                        $color = "#efefef";
                        $j++;
                    } else if ($j == 8) {
                        $color = "#f1f1f1";
                        $j++;
                    } else if ($j == 9) {
                        $color = "#f3f3f3";
                        $j = 0;
                    }


                    echo "
				<tr bgcolor=$color style=' height: 50px'> 
				<td><input type='hidden'>" . $row["username"] . "</td>";
                    echo "<td><input type='hidden'>" . $row["email"] . "</td>";
                    echo "<td><input type='hidden'>" . $row["name"] . "</td>";
                    echo "<td><input type='hidden'>" . $row["family"] . "</td>";
                    $gender = 'مرد';
                    if ($row["gender"] == 1) $gender = 'زن';
                    echo "<td><input type='hidden'>" . $gender . "</td>";
                    echo "<td><input type='hidden'>" . $row["tel"] . "</td>";
                    echo "<td><button type='submit' value='$row[username]' class='btn9' name='edituser'>تغییر مشخصات</button></td>";
                    echo "<td><button type='submit' value='$row[username]' class='btn7' name='removeuser' style='height: 33px;width: 35px;font-size: 14px' >X</button></td></tr>";
                }


            }
            echo "</table></form></div> ";
            echo "<div style='margin-top: 2%;direction: ltr'>";
            $pageadmin->show_pages_link('pageorder');
            echo "</div>";


        }


    }// ********* end function ShowUserInfo *********

    /*================================================================================
     \                          function  reg_product                                \
     ================================================================================*/

    function reg_product()
    {
        if (isset($_REQUEST['btn_regproduct']) && $_SESSION['reguser'] == 'admin') {
            if (isset($_FILES['pimage']['name'])) {
                $target_dir = "img/";
                mysqli_query($this->link, "SET NAMES 'UTF8'");
                $sql = "SHOW TABLE STATUS LIKE 'product'";
                $result = mysqli_query($this->link, $sql) or die();
                $row = mysqli_fetch_row($result);

                $imageFileType = pathinfo($_FILES['pimage']['name'], PATHINFO_EXTENSION);
                $tmpName = $_FILES['pimage']['tmp_name'];
                if ($row == null) {
                    $target_file = $target_dir . "100." . $imageFileType;
                } else {
                    $img = $row['10'];
                    $target_file = $target_dir . (string)$img . "." . $imageFileType;
                }

                move_uploaded_file($tmpName, $target_file);

                $sql = "INSERT INTO `product` VALUES (NULL, '" . $_REQUEST['pname'] . "', '" . $_REQUEST['price'] . "', '" . $_REQUEST['inventory'] . "' ,'" . $_REQUEST['ptype'] . "','" . $target_file . "'  ,'" . $_REQUEST['comment'] . "');";

                if (mysqli_query($this->link, $sql)) {


                    header("location:?regproductok");
                    header('refresh:0;');

                } else {
                    header("location:?regproducterror");
                    header('refresh:0;');
                }
            }
        }

        if (isset($_GET['regproductok']) && $_SESSION["reguser"] == "admin") {
            $_SESSION['menu'] = 'regproductok';

            echo "<div class='field' style='width: 600px;height: 400px;margin-top: 50px;'><div style='font-size: 18px;margin:120px auto 15% auto'>اطلاعات کالای مورد نظر با موفقیت در پایگاه داده ثبت شد</div>";
            echo '<div><form action="" method="post">
	<input type="submit" class="btn11" value="ثبت کالای جدید" name="backtoregproduct" style="height: 50px;font-size: 16px" >
	</form></div></div>';

            if (isset($_POST['backtoregproduct'])) {
                header('location: ?usermenu=regproduct');

            }

        }

        if (isset($_GET['regproducterror']) && $_SESSION["reguser"] == "admin") {
            $_SESSION['menu'] = 'regproducterror';

            echo "<div class='field' style='width: 600px;height: 400px;margin-top: 50px;'><div style='font-size: 18px;margin:120px auto 15% auto'>خطایی در هنگام ثبت اطلاعات رخ داده است</div>";
            echo '<div><form action="" method="post">
	<input type="submit" class="btn11" value="بازگشت" name="backtoregproduct" style="height: 50px;font-size: 16px" >
	</form></div></div>';

            if (isset($_POST['backtoregproduct'])) {
                header('location: ?usermenu=regproduct');

            }

        }


        if (isset($_SESSION["reguser"]) && $_SESSION["reguser"] == "admin") {


            if (isset($_GET['usermenu']) && $_GET['usermenu'] == 'regproduct' && $_SESSION['menu'] != "regproduct") {
                $_SESSION["menu"] = "regproduct";
                header("refresh:0;");
            }

            if ($_SESSION["menu"] == "regproduct") {

                echo '<div class="msgerror" style="line-height: 25px" > <p id="pnamemsg"></p><p id="pricemsg"></p><p id="inventorymsg"></p><p id="ptypemsg"></p><p id="pimagemsg"></p> </div>
<form method="post" onSubmit="return regproductform();"  class="field6" enctype="multipart/form-data" >
<div style="margin:auto;font-size: 16px;font-weight: bold">ثبت اجناس</div>
    <div class="tbl" style="margin: 20px 210px auto auto; ">
    
        <div class="row">
            <div class="cell">نام کالا</div>
            <div class="cell"><input class="txt4" type="text" id="pname" name="pname" ></div>
        </div>
        <div class="row">
            <div class="cell">قیمت (تومان)</div>
            <div class="cell"><input class="txt4" type="text" id="price" name="price"></div>
        </div>
        <div class="row" >
            <div class="cell">تعداد موجودی</div>
            <div class="cell"><input class="txt4" type="text" id="inventory" name="inventory"></div>
        </div>
        <div class="row" style="height: 10px"></div>
        <div class="row">
            <div class="cell" >نوع کالا</div>
            <select name="ptype" id="ptype" class="txt4">
                <option value="main">مادربرد</option>
                <option value="cpu">پردازنده</option>
                <option value="ram">رم کامپیوتر</option>
                <option value="gpu">کارت گرافیگ</option>
                <option value="hard">هارد دیسک</option>
                <option value="case">کیس</option>
                <option value="power">پاور</option>
                <option value="monitor">مانیتور</option>
            </select>
        </div>
        <div class="row" style="height: 10px"></div>
        <div class="row" >
            <div class="cell">عکس کالا</div>
            <div class="cell" style="direction: ltr;"><input class="file " type="file" accept="image/*" name="pimage" id="pimage" style="width: 345px"></div>
        </div>
        </div>
        <div class="tbl">
        <div class="row">
            <div class="cell">توضیحات</div>
        </div>
        <div class="row">
            <div class="cell"><textarea class="txt4" name="comment" id="comment" style="width: 345px"></textarea></div>
        </div>
        <div class="row" style="height: 30px"></div>
        <div class="row">
            
            <div class="cell" "><input class="btn6" type="submit" name="btn_regproduct" value="ثبت کالا"></div>
        </div>
    </div>
</form>
';
            }

        }
    }// ********* end function  reg_product *********


    /*================================================================================
     \                          function  manage_reg_product                         \
     ================================================================================*/

    function manage_reg_product()
    {

        if (isset($_GET['usermenu']) && $_GET['usermenu'] == 'editproduct' && $_SESSION['reguser'] == 'admin') {
            $_SESSION['menu'] = "editproduct";
            $_SESSION['select'] = 'editproduct';
            header("refresh:0;");
            $url = basename($_SERVER['PHP_SELF']) . "?page=1";
            header("location: $url");
        }

        if (isset($_SESSION['menu']) && $_SESSION['menu'] == "editproduct" && isset($_GET['page']) && isset($_SESSION['reguser']) && $_SESSION['reguser'] == 'admin') {

            echo '<form method="post"  class="form3">

<table class="form" >
    <tr><td colspan="8" class="caption" >تغییر اجناس ثبت شده</td></tr>
    <tr class="row" style="background-color: #4b4b4b;color: #04e1ef;height: 50px">
        <td class="cell" style="width: 10%">شماره کالا</td>
        <td class="cell" style="width: 8%">عکس</td>
        <td class="cell" style="width: 35%">نام</td>
        <td class="cell" style="width: 16%">قیمت</td>
        <td class="cell" style="width: 5%">موجودی</td>
        <td class="cell" style="width: 12%">نوع</td>
        <td class="cell" style="width: 10%">تغییرات</div>
        <td class="cell" style="width: 4%"></td>
    </tr>';
            $per_page = 12;
            $page = new page_class($per_page, 'page');
            //error_reporting(0); // disable error report
            $sql = "SELECT * FROM product WHERE 1 GROUP BY productid";
            $result = mysqli_query($this->link, $sql) or die();
// paging start
            $row_counts = mysqli_num_rows($result);
            $page->specify_row_counts($row_counts);
            $starting_record = $page->get_starting_record();

            $sql = "SELECT * FROM product WHERE 1 GROUP BY productid LIMIT $starting_record, $per_page";
            $result = mysqli_query($this->link, $sql) or die();
            $number = $starting_record; //numbering
            $num_rows = mysqli_num_rows($result);
            if ($num_rows == 0) {   // if no result is found
                echo "<tr class='notice' style=' height: 50px'>
     <td colspan='8' class=note>اطلاعاتی برای نمایش وجود ندارد</td>
     </tr></table> </form>";
                if ($_GET['page'] > 1) {
                    $page = $_GET['page'] - 1;
                    header('location:?page=' . $page . '');
                }

            } else {
                if ($_GET['page'] == 1) {
                    $starting_record = 0;

                } else {
                    $starting_record = ($_GET['page'] * 12) - 12;
                }


                $sql = "SELECT * FROM product WHERE 1 GROUP BY productid LIMIT $starting_record, 12";
                $result = mysqli_query($this->link, $sql) or die();

                $j = 0;
                $color = "#a4a4a4";
                while ($row = mysqli_fetch_assoc($result)) {

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
                    } else if ($j == 6) {
                        $color = "#eaeaea";
                    } else if ($j == 7) {
                        $color = "#f0f0f0";
                    } else if ($j == 8) {
                        $color = "#f4f3f3";
                    } else if ($j == 9) {
                        $color = "#f5f5f5";
                    } else if ($j == 10) {
                        $color = "#f6f6f6";
                    } else if ($j == 11) {
                        $color = "#f8f7f7";
                    } else if ($j == 12) {
                        $color = "#fcfcfc";
                        $j = -1;
                    }
                    $j++;
                    $price = $row['price'] / 1000;
                    if ($price < 1000 && $price > 1)
                        $price = $price . " هزار تومان";
                    elseif ($price < 1)
                        $price = $price * 1000 . " تومان";
                    else {
                        $price = ($price / 1000) . " میلیون تومان";
                    }

                    echo "<tr class='row' style='font-size: 14px;color: black;background: $color'>
                    <td class='cell'>" . $row["productid"] . "</td>
                    <td class='cell'><img class='img-radius' style='width: 80px;height: 53px;' src=" . $row["pimage"] . "></td>
                    <td class='cell'>" . $row["pname"] . "</td>
                    <td class='cell'>" . $price . "</td>
                    <td class='cell'>" . $row["inventory"] . "</td>
                    <td class='cell'>" . $this->TypeConvertor($row["ptype"]) . "</td>
                    <td class='cell'><button style='height: 33px;width: 100%' type='submit' class='btn10' name='btn_edit' value=" . $row["productid"] . ">تغییر</button> </td> 
                    <td class='cell'><button type='submit' class='btn7' name='btn_removeproduct' value=" . $row["productid"] . "  style='width: 35px;height: 33px;font-size: 18px'>X</button> </td>
                    
                </tr>
                    ";
                }
                echo '</table> </form> ';
            }

            echo '<div style="direction: ltr;">';
            $page->show_pages_link('page');
            echo '</div>';

        }

        if (isset($_REQUEST['btn_removeproduct']) && $_SESSION['reguser'] == 'admin') {
            $id = $_POST["btn_removeproduct"];
            $sql = "SELECT pimage FROM product WHERE productid='$id'";
            $result = mysqli_query($this->link, $sql);
            $row = mysqli_fetch_assoc($result);
            unlink("$row[pimage]");

            $sql = "DELETE FROM `productorder` WHERE productid='$id'";
            mysqli_query($this->link, $sql);

            $sql = "DELETE FROM `product` WHERE productid='$id'";
            mysqli_query($this->link, $sql);
            header("refresh:0;");

        }


        if (isset($_REQUEST['btn_editproduct']) && $_SESSION['reguser'] == 'admin') {
            $sql = "SET NAMES 'UTF8'";
            mysqli_query($this->link, $sql) or die();

            if ($_FILES['pimage']['name'] != "") {
                $target_dir = "img/";
                $target_file = $target_dir . basename($_SESSION['pimage']);
                $sql = "SELECT productid FROM product ORDER BY productid DESC LIMIT 1";
                $result = mysqli_query($this->link, $sql) or die();
                $row = mysqli_fetch_row($result);
                $imageFileType = pathinfo($_FILES['pimage']['name'], PATHINFO_EXTENSION);
                $oldimageFileType = pathinfo($_SESSION['pimage'], PATHINFO_EXTENSION);
                $tmpName = $_FILES['pimage']['tmp_name'];
                if ($imageFileType == $oldimageFileType) {
                    $target_file = $target_dir . basename($_SESSION['pimage']);
                } else {
                    $filename = substr($_SESSION['pimage'], 0, strrpos($_SESSION['pimage'], "."));
                    $target_file = $target_dir . $filename . "." . $imageFileType;
                }

                move_uploaded_file($tmpName, $target_file);

                $sql = "UPDATE `product` SET `pname` = '" . $_REQUEST['pname'] . "', `price` = '" . $_REQUEST['price'] . "', `inventory` = '" . $_REQUEST['inventory'] . "', `ptype` = '" . $_REQUEST['ptype'] . "', `pimage` = '$target_file', `comment` = '" . $_REQUEST['comment'] . "' WHERE `product`.`productid` = " . $_REQUEST['productid'] . ";";
                if (mysqli_query($this->link, $sql)) {

                    echo "<p class='msgok' id='eidtmsg' style='margin-top: 20px;'>تغییرات مورد نظر با موفقیت ثبت شد</p>";

                } else {
                    echo "<p class='msgerror' id='eidtmsg' style='margin-top: 20px;'>خطا در ثبت اطلاعات</p>";
                }
            } else {

                $sql = "UPDATE `product` SET `pname` = '" . $_REQUEST['pname'] . "', `price` = '" . $_REQUEST['price'] . "', `inventory` = '" . $_REQUEST['inventory'] . "', `ptype` = '" . $_REQUEST['ptype'] . "', `comment` = '" . $_REQUEST['comment'] . "' WHERE `product`.`productid` = " . $_REQUEST['productid'] . ";";

                if (mysqli_query($this->link, $sql)) {

                    echo "<p class='msgok' id='eidtmsg' style='margin-top: 20px;'>تغییرات مورد نظر با موفقیت ثبت شد</p>";

                } else {
                    echo "<p class='msgerror' id='eidtmsg' style='margin-top: 20px;'>خطا در ثبت اطلاعات</p>";
                }

            }


        } // end btn_edit

        if (isset($_REQUEST['btn_edit']) && $_SESSION['reguser'] == 'admin') {
            $_SESSION['menu'] = "advancedEditProduct";
            $_SESSION['id'] = $_REQUEST['btn_edit'];
            header('refresh:0;');
        }
        if (isset($_SESSION['menu']) && $_SESSION['menu'] == "advancedEditProduct") {
            $sql = "SET NAMES 'UTF8'";
            mysqli_query($this->link, $sql) or die();
            $sql = "SELECT * FROM `product` WHERE productid='" . $_SESSION["id"] . "'";
            $result = mysqli_query($this->link, $sql);
            $row = mysqli_fetch_assoc($result);

            echo '<div class="msgerror" style="line-height: 25px" > <p id="pnamemsg"></p><p id="pricemsg"></p><p id="inventorymsg"></p><p id="ptypemsg"></p> </div><form method="post" onsubmit="return editproductform();" class="field6"  enctype="multipart/form-data" >
    <div style="margin:auto;font-size: 15px;">تغییر اجناس ثبت شده</div>
    <div class="tbl" style="margin: 30px 145px auto auto;">
        <div class="row">
            <div class="cell">کد کالا</div>
            <div class="cell"><input class="txt4" type="text" name="productid" value="' . $row["productid"] . '" style="width: 400px" readonly></div>
        </div>
        <div class="row">
            <div class="cell">نام کالا</div>
            <div class="cell"><input class="txt4" type="text" name="pname" id="pname" value="' . $row["pname"] . '" style="width: 400px"></div>
        </div>
        <div class="row">
            <div class="cell">قیمت (تومان)</div>
            <div class="cell"><input class="txt4" type="text" name="price" id="price" value="' . $row["price"] . '" style="width: 400px"></div>
        </div>
        <div class="row">
            <div class="cell">تعداد موجودی</div>
            <div class="cell"><input class="txt4" type="text" name="inventory" id="inventory" value="' . $row["inventory"] . '" style="width: 400px"></div>
        </div>
        <div class="row" style="height: 10px"></div>
        <div class="row">
            <div class="cell">نوع کالا</div>
            <select name="ptype" id="ptype" class="txt4" style="width: 400px">
                <option value="cpu"';
            if ($row["ptype"] == "cpu") echo "selected";
            echo '>پردازنده</option>
                <option value="main"';
            if ($row["ptype"] == "main") echo "selected";
            echo '>مادربورد</option>
                <option value="ram"';
            if ($row["ptype"] == "ram") echo "selected";
            echo '>رم کامپیوتر</option>
                <option value="gpu"';
            if ($row["ptype"] == "gpu") echo "selected";
            echo '>کارت گرافیک</option>
                 <option value="hard"';
            if ($row["ptype"] == "hard") echo "selected";
            echo '>هارد دیسک</option>
                 <option value="case"';
            if ($row["ptype"] == "case") echo "selected";
            echo '>کیس</option>
                 <option value="power"';
            if ($row["ptype"] == "power") echo "selected";
            echo '>پاور</option>
                 <option value="monitor"';
            if ($row["ptype"] == "monitor") echo "selected";
            echo '>مانیتور</option>
            </select>
        </div>
        <div class="row" style="height: 10px"></div>
        <div class="row">
            <div class="cell">انتخاب عکس جدید</div>
            <div class="cell" style="direction: ltr;"><input class="file" type="file" accept="image/*" name="pimage"  style="width: 400px"></div>
        </div>
        
        <!--<div class="row">
            <div class="cell">عکس کالا</div>
            <div class="cell"><img class="img-radius" src="' . $row["pimage"] . '" style="width: 400px;height: 300px"></div>
        </div>-->
        </div>
        <div class="tbl">
        <div class="row"><div class="cell">توضیحات</div></div>
        <div class="row">
            <div class="cell"><textarea class="txt3" name="comment" id="comment"  style="width: 400px">';
            echo $row["comment"];
            echo '</textarea></div>
        </div>
        <div class="row">
            <div class="cell" style="height:80px"><input class="btn6" type="submit" name="btn_editproduct" value="اعمال تغییرات"></div>
        </div>
    </div>
</form>
';
            $_SESSION['pimage'] = $row["pimage"];

        }

    } // ********* end function manage_reg_product *********


    /*================================================================================
     \                          function  manage_order                               \
     ================================================================================*/

    function manage_order()
    {

        if (isset($_SESSION['reguser']) && $_SESSION['reguser'] == 'admin') {

            if (isset($_GET['usermenu']) && $_GET['usermenu'] == 'order') {

                $_SESSION['menu'] = "userorder";
                $_SESSION['select'] = "order";
                header("refresh:0;");
                $url = basename($_SERVER['PHP_SELF']) . "?pageorder=1";
                header("location: $url");

            } else if (isset($_GET['usermenu']) && $_GET['usermenu'] == 'adminpayment') {

                $_SESSION['menu'] = "userorder";
                $_SESSION['select'] = "adminpayment";
                header("refresh:0;");
                $url = basename($_SERVER['PHP_SELF']) . "?pageorder=1";
                header("location: $url");

            } else if (isset($_GET['usermenu']) && $_GET['usermenu'] == 'paid') {

                $_SESSION['menu'] = "userorder";
                $_SESSION['select'] = "paid";
                header("refresh:0;");
                $url = basename($_SERVER['PHP_SELF']) . "?pageorder=1";
                header("location: $url");

            } else if (isset($_GET['usermenu']) && $_GET['usermenu'] == 'send') {

                $_SESSION['menu'] = "userorder";
                $_SESSION['select'] = "send";
                header("refresh:0;");
                $url = basename($_SERVER['PHP_SELF']) . "?pageorder=1";
                header("location: $url");

            } else if (isset($_GET['usermenu']) && $_GET['usermenu'] == 'sended') {

                $_SESSION['menu'] = "userorder";
                $_SESSION['select'] = "sended";
                header("refresh:0;");
                $url = basename($_SERVER['PHP_SELF']) . "?pageorder=1";
                header("location: $url");

            } else if (isset($_GET['usermenu']) && $_GET['usermenu'] == 'delivered') {

                $_SESSION['menu'] = "userorder";
                $_SESSION['select'] = "delivered";
                header("refresh:0;");
                $url = basename($_SERVER['PHP_SELF']) . "?pageorder=1";
                header("location: $url");
            }
        } else {
            if (isset($_GET['usermenu']) && $_GET['usermenu'] == 'userorder') {

                $_SESSION['menu'] = "userorder";
                $_SESSION['select'] = "userorder";
                header("refresh:0;");
                $url = basename($_SERVER['PHP_SELF']) . "?pageorder=1";
                header("location: $url");

            } elseif (isset($_GET['usermenu']) && $_GET['usermenu'] == 'paid') {

                $_SESSION['menu'] = "userorder";
                $_SESSION['select'] = "userpaid";
                header("refresh:0;");
                $url = basename($_SERVER['PHP_SELF']) . "?pageorder=1";
                header("location: $url");

            } elseif (isset($_GET['usermenu']) && $_GET['usermenu'] == 'sended') {

                $_SESSION['menu'] = "userorder";
                $_SESSION['select'] = "usersended";
                header("refresh:0;");
                $url = basename($_SERVER['PHP_SELF']) . "?pageorder=1";
                header("location: $url");

            } elseif (isset($_GET['usermenu']) && $_GET['usermenu'] == 'delivered') {

                $_SESSION['menu'] = "userorder";
                $_SESSION['select'] = "userdelivered";
                header("refresh:0;");
                $url = basename($_SERVER['PHP_SELF']) . "?pageorder=1";
                header("location: $url");

            }
        }


        if (isset($_SESSION['menu']) && $_SESSION['menu'] == "userorder" && isset($_GET['pageorder'])) {
            echo "<div class='form2'><form action='' method='post'><table name='tbl1' id='tbl1' style='width: 95%;'>";
            if ($_SESSION['select'] == 'order' || $_SESSION['select'] == 'userorder') {
                echo "<tr><td colspan='9' class='caption'>سفارش های ثبت شده</td></tr>";

            } else if ($_SESSION['select'] == 'paid' || $_SESSION['select'] == "userpaid") {
                echo "<tr><td colspan='9' class='caption'>سفارش های پرداخت شده</td></tr>";
            } else if ($_SESSION['select'] == 'adminpayment') {
                echo "<tr><td colspan='9' class='caption'>پرداخت سفارش ها</td></tr>";
            } else if ($_SESSION['select'] == 'send') {
                echo "<tr><td colspan='9' class='caption'>سفارش های آماده ارسال</td></tr>";
            } else if ($_SESSION['select'] == 'sended' || $_SESSION['select'] == 'usersended') {
                echo "<tr><td colspan='9' class='caption'>سفارش های ارسال شده</td></tr>";
            } else if ($_SESSION['select'] == 'delivered' || $_SESSION['select'] == 'userdelivered') {
                echo "<tr><td colspan='9' class='caption'>سفارش های تحویل داده شده</td></tr>";
            }

            echo "
          <tr style='background-color: #4b4b4b;color: #04e1ef'>
            
          	<td height='50' style='width:8%;'>شماره فاکتور</td>
          	<td style='width:10%;'>تاریخ</td>
            <td style='width:10%;'>قیمت کل</td>
            <td style='width:10%;'>نام کاربری</td>
            <td style='width:30%;'>آدرس</td>
            <td style='width:12%;'></td>
			<td style='width:12%;'></td>
			<td style='width:4%;'></td>
			<td style='width:4%;'></td>
          </tr>
          ";
            //-----------admin -----------------------
            if ($_SESSION['select'] == 'order') {

                $sql = "paid='0' && confirm=0 && sended='0' && delivered='0'";
                $this->ShowOrder($sql);

            } elseif ($_SESSION['select'] == 'adminpayment') {

                $sql = "paid='0' && confirm=0 && sended='0' && delivered='0'";
                $this->ShowOrder($sql);

            } elseif ($_SESSION['select'] == 'paid') {

                $sql = 'paid=1 && confirm=0 && sended=0 && delivered=0';
                $this->ShowOrder($sql);

            } elseif ($_SESSION['select'] == 'send') {

                $sql = 'paid=1 && confirm=1 && sended=0 && delivered=0';
                $this->ShowOrder($sql);

            } elseif ($_SESSION['select'] == 'sended') {

                $sql = 'paid=1 && confirm=1 && sended=1 && delivered=0';
                $this->ShowOrder($sql);

            } elseif ($_SESSION['select'] == 'delivered') {

                $sql = 'paid=1 && confirm=1 && sended=1 && delivered=1';
                $this->ShowOrder($sql);

                //-----------------user ----------------------------

            } elseif ($_SESSION['select'] == 'userorder') {

                $sql = 'user="' . $_SESSION['reguser'] . '" && paid=0 && sended=0 && delivered=0';
                $this->ShowOrder($sql);

            } elseif ($_SESSION['select'] == 'userpaid') {

                $sql = 'user="' . $_SESSION['reguser'] . '" && paid=1 && sended=0 && delivered=0';
                $this->ShowOrder($sql);

            } elseif ($_SESSION['select'] == 'usersended') {

                $sql = 'user="' . $_SESSION['reguser'] . '"&& paid=1 && sended=1 && delivered=0';
                $this->ShowOrder($sql);

            } elseif ($_SESSION['select'] == 'userdelivered') {

                $sql = 'user="' . $_SESSION['reguser'] . '" && paid=1 && sended=1 && delivered=1';
                $this->ShowOrder($sql);

            }

        }

        if (isset($_GET['invoiceid']) && $_SESSION['menu'] != "showinvoice") {
            $_SESSION['menu'] = "showinvoice";
            header("refresh:0;");
        }

        if (isset($_SESSION["reguser"]) && $_SESSION["reguser"] == "admin") {
            if ($_SESSION['menu'] == "showinvoice") {

                $invoiceid = $_GET['invoiceid'];
                $sql = "SELECT `user`, `date` FROM `invoice` WHERE invoiceid='$invoiceid'";
                $this->showinvoice($sql, $invoiceid);
            }
        } else {
            if (isset($_SESSION['menu']) && $_SESSION['menu'] == "showinvoice") {

                $invoiceid = $_GET['invoiceid'];
                $sql = "SELECT `user`, `date` FROM `invoice` WHERE user='" . $_SESSION['reguser'] . "' && invoiceid='$invoiceid'";
                $this->showinvoice($sql, $invoiceid);
            }
        }


        if (isset($_GET['usermenu']) && $_GET['usermenu'] == 'search' && $_SESSION['menu'] != "search") {

            $_SESSION['menu'] = "search";
            header("refresh:0;");

        }

        //--------------------------removeproductadmin-------------------------------------


        if (isset($_POST['removeproductadmin']) && $_SESSION['reguser'] == 'admin') {
            
            $id = $_POST["removeproductadmin"];
            $sql = "DELETE FROM `productorder` WHERE invoiceid='$id'";
            mysqli_query($this->link, $sql) or die();
            $sql = "DELETE FROM `invoice` WHERE invoiceid='$id'";
            mysqli_query($this->link, $sql) or die();
            header("refresh:0;");

        }

        //--------------------------removeproductgreen-------------------------------------

        if (isset($_POST['removeproductgreen']) && $_SESSION['reguser'] == 'admin') {
            
            $id = $_POST["removeproductgreen"];
            $sql = "SELECT * FROM `productorder` WHERE invoiceid='$id'";
            $result = mysqli_query($this->link, $sql) or die();
            while ($row = mysqli_fetch_assoc($result)) {
                $sql = "UPDATE product SET inventory = (inventory+$row[qty]) WHERE productid = $row[productid]";
                mysqli_query($this->link, $sql);
            }
            $sql = "DELETE FROM `productorder` WHERE invoiceid='$id'";
            mysqli_query($this->link, $sql) or die();
            $sql = "DELETE FROM `invoice` WHERE invoiceid='$id'";
            mysqli_query($this->link, $sql) or die();
            header("refresh:0;");

        }

        //---------------------------------removeproductuser-------------------------------------

        if (isset($_POST['removeproductuser']) && $_SESSION['reguser'] != 'admin') {
            
            $id = $_POST["removeproductuser"];
            $sql = "SELECT * FROM `invoice` WHERE invoiceid='$id'";
            $result = mysqli_query($this->link, $sql) or die();
            $row = mysqli_fetch_assoc($result);
            if ($row['user'] == $_SESSION['reguser']) {
                $sql = "SELECT * FROM `productorder` WHERE invoiceid='$id'";
                $result = mysqli_query($this->link, $sql) or die();
                while ($row = mysqli_fetch_assoc($result)) {
                    $sql = "UPDATE product SET inventory = (inventory+$row[qty]) WHERE productid = $row[productid]";
                    mysqli_query($this->link, $sql);
                }

                $sql = "DELETE FROM `productorder` WHERE invoiceid='$id'";
                mysqli_query($this->link, $sql) or die();
                $sql = "DELETE FROM `invoice` WHERE invoiceid='$id'";
                mysqli_query($this->link, $sql) or die();
                header("refresh:0;");
            }

        }

        //----------------------confirmadmin-------------------------------------

        if (isset($_POST['confirmadmin']) && $_SESSION['reguser'] == 'admin') {
            
            $id = $_POST["confirmadmin"];
            $sql3 = "UPDATE `invoice` SET `confirm` = '1' WHERE `invoice`.`invoiceid` ='$id'";
            mysqli_query($this->link, $sql3);
            header("refresh:0;");

        }


        //-----------------------sended-------------------------------------

        if (isset($_POST['sended']) && $_SESSION['reguser'] == 'admin') {
            
            $id = $_POST["sended"];
            $sql3 = "UPDATE `invoice` SET `sended` = '1' WHERE `invoice`.`invoiceid` ='$id'";
            mysqli_query($this->link, $sql3);
            header("refresh:0;");

        }

        //-------------------------delivered------------------------------------

        if (isset($_POST['delivered']) && $_SESSION['reguser'] == 'admin') {
            
            $id = $_POST["delivered"];
            $sql3 = "UPDATE `invoice` SET `delivered` = '1' WHERE `invoice`.`invoiceid` ='$id'";
            mysqli_query($this->link, $sql3);
            header("refresh:0;");

        }

        //---------------------------adminpayment----------------------------------

        if (isset($_POST['adminpayment']) && $_SESSION['reguser'] == 'admin') {
            
            $id = $_POST["adminpayment"];
            $sql3 = "UPDATE `invoice` SET `paid` = '1' WHERE `invoice`.`invoiceid` ='$id'";
            mysqli_query($this->link, $sql3);
            header("refresh:0;");

        }

        //-------------------------payment------------------------------------

        if (isset($_POST['payment'])) {
            
            $id = $_POST["payment"];
            //$sql3 = "UPDATE `invoice` SET `paid` = '1' WHERE `invoice`.`invoiceid` ='$id'";
            // mysqli_query($this->link, $sql3);
            $_SESSION['invoiceid'] = $id;
            header("location:./bank");


        }


    } // ********* end function  manage_order *********


    /*================================================================================
     \                          function  search_order                               \
     ================================================================================*/

    function search_order()
    {

        if (isset($_POST['btn_search']) && $_SESSION['menu'] == "search" && $_SESSION['reguser'] == 'admin') {
            $id = $_POST['invoiceid'];
            $sql = "SELECT * FROM invoice WHERE invoiceid=$id";
            $result = mysqli_query($this->link, $sql) or die();

            if (mysqli_num_rows($result) != 0) {
                header("location:?invoiceid=$id");
            } else {
                echo "<p class='msgerror'>این شماره فاکتور وجود ندارد</p>";
            }
        }


        if (isset($_SESSION['menu']) && $_SESSION['menu'] == "search") {

            echo '<form accept-charset="utf-8" action="" method="post" id="form1" style="margin-top: 5%">
        <fieldset id="field1" class="field">
            <table dir="rtl" align="center"  style="margin:11% 9% auto auto">
                <tr >
                <td></td>
                    <td style="text-align:center;font-size: 14px">جستجوی سفارش</td>		
                </tr>
                
                <tr style="height: 100px">
                    <td>شماره فاکتور  </td>
                    <td><input type="text" name="invoiceid" id="invoiceid" class="txt3" style="width:200px;"/></td>		
                </tr>
                
                <tr>
                    <td></td>
                    <td height="50px"><input type="submit" value="جستجو" name="btn_search" class="btn11"/></td>
                </tr>
                
        </table>
        </fieldset>
	</form> ';
        }

    } // ********* end function  search_order *********


    /*================================================================================
     \                          function  logout                                     \
     ================================================================================*/


    function logout()
    {
        if (isset($_GET['usermenu']) && $_GET['usermenu'] == 'logout') {

            session_destroy();
            header("refresh:0;");
            header('location:?logout=1');

        }

    } // ********* end function  edit_profile *********


    /*================================================================================
     \                          function  login                                     \
     ================================================================================*/

    function login()
    {

        if (isset($_POST['user'])) $username_space = strrpos($_POST['user'], " ");
        if (isset($_POST['user'])) {
            if ($username_space === false) {
                $sql = "SELECT * FROM `user` WHERE username='$_POST[user]' and password='$_POST[pass]'";
                //echo $sql;
                $result = mysqli_query($this->link, $sql) or die();
                //var_dump(mysqli_fetch_assoc($result));
                $row = mysqli_fetch_assoc($result);
                if ($row['username'] == $_POST['user'] && $row['password'] == $_POST['pass']) {
                    $_SESSION["reguser"] = $_POST['user'];
                    $_SESSION["menu"] = "editprofile";
                    header('location:?usermenu=editprofile');
                    header('refresh:0;');
                } else {
                    echo "<p class='msgerror' style='margin-bottom: 30px'>نام کاربری یا پسورد شما اشتباه است</p>";
                }
            } else {
                echo "<p class='msgerror' style='margin-bottom: 30px'>نام کاربری یا پسورد شما اشتباه است</p>";
            }
        }

        if (!isset($_SESSION["reguser"])){
            echo '<form action="" method="post" style="margin-top: 70px">
                    <fieldset class="field">
                        <table style="margin-right: 40px;margin-top: 35px">
                            <tr>
                                <td></td>
                                    <td style="text-align:left ">نام کاربری ورمز عبور خود را وارد کنید</td>		
                                </tr>
                                <tr><td height="15px"></td></tr>
                                <tr>
                            <tr>
                                <td>نام کاربری</td>
                                <td><input type="text" class="txt2" name="user" id="user"></td>
                            </tr>
                            <tr>
                                <td width="70px">رمز عبور</td>
                                <td><input type="password" class="txt2" name="pass" id="pass"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td height="50px"><input type="submit" name="submit" class="btn2" d="submit" value="ورود" ></td>
                            </tr>
                        </table>
                    </fieldset>
                </form>';
        }
    }  // ********* end function  login *********


    /*================================================================================
     \                          function ShowOrder                                     \
     ================================================================================*/

    function ShowOrder($condition)
    {
        mysqli_query($this->link, "SET NAMES 'UTF8'");
        $i = 0;
        $j = 0;
        $color = "#bfbfbf";


        //------------------------------------------------------

        $per_page = 12;
        $pageadmin = new page_class($per_page, 'pageorder');

        //error_reporting(0); // disable error report
        $sql = "SELECT * FROM `invoice` WHERE $condition GROUP BY invoiceid";

        $result = mysqli_query($this->link, $sql) or die();
        // paging start
        $row_counts = mysqli_num_rows($result);
        $pageadmin->specify_row_counts($row_counts);
        $starting_record = $pageadmin->get_starting_record();

        $sql = "SELECT * FROM `invoice` WHERE $condition GROUP BY invoiceid LIMIT $starting_record, $per_page";

        $result = mysqli_query($this->link, $sql) or die();
        $number = $starting_record; //numbering
        $num_rows = mysqli_num_rows($result);
        if ($num_rows == 0) {   // if no result is found
            echo "<tr class='notice' style=' height: 50px'>
     <td colspan='8' class=note>اطلاعاتی برای نمایش وجود ندارد</td>
     </tr></table> </form>";

            if ($_GET['pageorder'] > 1) {
                $page = $_GET['pageorder'] - 1;
                header('location:?pageorder=' . $page . '');
            }

        } else {
            if ($_GET['pageorder'] == 1) {
                $starting_record = 0;

            } else {
                $starting_record = ($_GET['pageorder'] * 12) - 12;
            }
        }

        $sql = "SELECT * FROM `invoice` WHERE $condition GROUP BY invoiceid LIMIT $starting_record, 12";


        //------------------------------------------------------

        $result = mysqli_query($this->link, $sql) or die();
        mysqli_query($this->link, "SET NAMES 'UTF8'");

        while ($row = mysqli_fetch_assoc($result)) {

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
            } else if ($j == 6) {
                $color = "#eaeaea";
            } else if ($j == 7) {
                $color = "#f0f0f0";
            } else if ($j == 8) {
                $color = "#f5f5f5";
            } else if ($j == 9) {
                $color = "#f9f8f8";
            } else if ($j == 10) {
                $color = "#fefdfd";
            } else if ($j == 11) {
                $color = "#fefefe";
            } else if ($j == 12) {
                $color = "#fdfdfd";
                $j = -1;
            }
            $j++;

            $sql1 = "SELECT `address` FROM `user` WHERE username='" . $row["user"] . "'";
            $result1 = mysqli_query($this->link, $sql1);
            $row1 = mysqli_fetch_assoc($result1);

            $_SESSION['invoicedate'] = date('M Y', strtotime($row["date"]));


            $price = $row['price'] / 1000;
            if ($price < 1000 && $price > 1)
                $price = $price . " هزار تومان";
            elseif ($price < 1)
                $price = $price * 1000 . " تومان";
            else {
                $price = ($price / 1000) . " میلیون تومان";
            }

            echo "
				  <tr bgcolor=$color style=' height: 50px;'> 
				  <td><p style='font-size: 12px'>" . $row["invoiceid"] . "</p></td>";
            echo "<td><p style='font-size: 12px'>" . $row["date"] . "</p></td>";
            echo "<td><p style='font-size: 12px'>" . $price . "</p></td>";
            echo "<td><p style='font-size: 12px'>" . $row["user"] . "</p></td>";
            echo "<td><p style='font-size: 12px'>" . $row1["address"] . "</p></td>";

            if ($_SESSION['select'] == 'adminpayment')
                echo "<td><button type='submit' value='$row[invoiceid]' class='btn14' name='payment'>پرداخت آنلاین</button></td>";
            else
                echo "<td><a class='btn8' style='font-size: 11px;padding: 6px;padding-left: 24px;padding-right: 24px;' href='?invoiceid=$row[invoiceid]'>مشاهده فاکتور<a></td>";

            if ($_SESSION['select'] == 'order')
                echo "<td><button class='btn9' name='notpaid' style='background-color: firebrick;'>پرداخت نشده</button></td>";
            elseif ($_SESSION['select'] == 'adminpayment' && $_SESSION['reguser'] == 'admin') {
                echo "<td><button type='submit' value='$row[invoiceid]' class='btn9' name='adminpayment'>پرداخت شده</button></td>";
            } else if ($_SESSION['select'] == 'send')
                echo "<td><button type='submit' value='$row[invoiceid]' class='btn9' name='sended' >ارسال شد</button></td>";
            else if ($_SESSION['select'] == 'sended')
                echo "<td><button type='submit' value='$row[invoiceid]' class='btn9' name='delivered' >تحویل داده شد</button></td>";
            else if ($_SESSION['select'] == 'delivered')
                echo "<td ><button value='$row[invoiceid]' class='btn13' name='delivered' style='background-color: green;'>تحویل داده شده</button></td>";

            //------------------------user menu -------------------------------
            else if ($_SESSION['select'] == 'userpaid')
                echo "<td colspan='3'><button  class='btn13' style='width: 150px;color: black;background-color: green;color: white;'>پرداخت شده</button></td></tr>";
            else if ($_SESSION['select'] == 'usersended')
                echo "<td colspan='3'><button class='btn13' style='width: 150px;color: black;background-color: gold;' >ارسال شده</button></td></tr>";
            else if ($_SESSION['select'] == 'userdelivered')
                echo "<td colspan='3'><button class='btn13' style='width: 150px;background-color: green;'>تحویل داده شده</button></td></tr>";
            elseif ($_SESSION['reguser'] != 'admin')
                echo "<td><button type='submit' value='$row[invoiceid]' class='btn9' name='payment'>پرداخت</button></td>";

            elseif ($_SESSION['reguser'] == 'admin' && $row["confirm"] != '1')
                echo "<td><button type='submit' value='$row[invoiceid]' class='btn15' name='confirmadmin'>تایید پرداخت</button></td>";

            if ($_SESSION['reguser'] == 'admin')
                echo "<td><button type='submit' value='$row[invoiceid]' class='btn20' name='removeproductgreen' >X</button></td>";
            if ($_SESSION['reguser'] == 'admin')
                echo "<td><button type='submit' value='$row[invoiceid]' class='btn7' name='removeproductadmin' >X</button></td></tr>";

            if (isset($_SESSION['select']) && $_SESSION['select'] == 'userorder')
                echo "<td colspan='2' ><button type='submit' value='$row[invoiceid]' class='btn7' name='removeproductuser' style='width: 35px;height: 32px;font-size: 18px'>X</button></td></tr>";
        }
        echo "</table></form></div> ";
        echo "<div style='margin-top: 2%;direction: ltr'>";
        $pageadmin->show_pages_link('pageorder');
        echo "</div>";


    }  // ********* end function  ShowOrder *********


    /*================================================================================
     \                          function validate                                     \
     ================================================================================*/


    function validate($allSubmitted)
    {
        $message = "";
        if (isset($allSubmitted["name"])) {
            $fn_flag = 0;
            $firstname = $allSubmitted["name"];

            if ($firstname == '') {
                $fn_flag++;
                $message = $message . "شما نام خود را وارد نکرده اید<br/>";
            }

            if ($fn_flag > 0)
                echo '<style>#firstname {background-color: #ffcece;}</style>';

        }

        if (isset($allSubmitted["family"])) {
            $ln_flag = 0;
            $lastname = $allSubmitted["family"];
            if ($lastname == '') {
                $ln_flag++;
                $message = $message . "شما نام خانوادگی خود را وارد نکرده اید<br/>";
            }

            if ($ln_flag > 0)
                echo '<style>#lastname {background-color: #ffcece;}</style>';
        }

        if (isset($allSubmitted["email"])) {
            $mail_flag = 0;
            $email = $allSubmitted["email"];
            if ($email == '') {
                $mail_flag++;
                $message = $message . "ایمیل خود را وارد کنید<br/>";
            }

            if ($mail_flag > 0)
                echo '<style>#email {background-color: #ffcece;}</style>';
        }


        if (isset($allSubmitted["password"])) {
            $pass_flag = 0;
            $passwords = $allSubmitted["password"];
            $firstPass = $passwords[0];
            $secondPass = $passwords[1];

            if ($firstPass == '') {
                $pass_flag++;
                $message = $message . "یک رمز عبور حداقل 8 رقمی وارد کنید<br/>";
            } elseif (strlen($firstPass) < 8) {
                $pass_flag++;
                $message = $message . "طول کلمه عبور حداقل باید 8 کارکتر باشد<br/>";
            } elseif ($secondPass == '') {
                $pass_flag++;
                $message = $message . "ورود تکرار رمز عبور الزامی است<br/>";
            } elseif ($firstPass != $secondPass) {
                $pass_flag++;
                $message = $message . "کلمه عیور وارد شده با هم یکی نیست<br/>";
            }

            if ($pass_flag > 0)
                echo '<style>#pass1,#pass2 {background-color: #ffcece;}</style>';

        }

        if (isset($allSubmitted["postalcode"])) {
            $post_flag = 0;
            $postalcode = $allSubmitted["postalcode"];
            if ($postalcode == '') {
                $post_flag++;
                $message = $message . "کدپستی خود را وارد کنید<br/>";
            }

            if ($post_flag > 0)
                echo '<style>#postalcode {background-color: #ffcece;}</style>';
        }

        if (isset($allSubmitted["address"])) {
            $adrs_flag = 0;
            $address = $allSubmitted["address"];
            if ($address == '') {
                $adrs_flag++;
                $message = $message . "آدرس خود را وارد کنید<br/>";
            }

            if ($adrs_flag > 0)
                echo '<style>#address {background-color: #ffcece;}</style>';
        }

        if (isset($allSubmitted["tel"])) {
            $tel_flag = 0;
            $tel = $allSubmitted["tel"];
            if ($tel == '') {
                $tel_flag++;
                $message = $message . "شماره تلفن خود را وارد کنید<br/>";
            }

            if ($tel_flag > 0)
                echo '<style>#tel {background-color: #ffcece;}</style>';
        }

        if ($message == "") {
            $message = "OK";
        }
        return $message;
    }// ********* end function  validate *********


    /*================================================================================
     \                          function showinvoice                                 \
     ================================================================================*/

    function showinvoice($sql, $invoiceid)
    {
        mysqli_query($this->link, "SET NAMES 'UTF8'");
        $result = mysqli_query($this->link, $sql) or die();
        $row = mysqli_fetch_assoc($result);

        $date = date('D M Y', strtotime($row["date"]));

        $sql = "SELECT * FROM `user` WHERE username='$row[user]'";
        $result = mysqli_query($this->link, $sql) or die();
        $row_user = mysqli_fetch_assoc($result);

        $sql = "SELECT * FROM `invoice` WHERE invoiceid='$invoiceid'";
        $result = mysqli_query($this->link, $sql) or die();
        $row = mysqli_fetch_assoc($result);
        $status = '';
        if ($row['paid'] == 0 && $row['confirm'] == 0 && $row['sended'] == 0 && $row['delivered'] == 0) {
            $status = '<span style="color:red;">پرداخت نشده</span>';

        } elseif ($row['paid'] == 1 && $row['confirm'] == 0 && $row['sended'] == 0 && $row['delivered'] == 0) {

            $status = '<span style="color:limegreen;">پرداخت شده</span>';

        } elseif ($row['paid'] == 1 && $row['confirm'] == 1 && $row['sended'] == 0 && $row['delivered'] == 0) {

            $status = '<span style="color:limegreen;">آماده ارسال</span>';

        } elseif ($row['paid'] == 1 && $row['confirm'] == 1 && $row['sended'] == 1 && $row['delivered'] == 0) {

            $status = '<span style="color:limegreen;">ارسال شده</span>';

        } elseif ($row['paid'] == 1 && $row['confirm'] == 1 && $row['sended'] == 1 && $row['delivered'] == 1) {

            $status = '<span style="color:limegreen;">دریافت شده</span>';

        }

        echo '
        <fieldset style="width: 62%;background-color: #ececec;margin: 2% auto 5% 15% ;border-radius: 50px;padding: 20px">
            <form method="post">
            
            <table style="width: 100%;margin-top: 10px;">
            <tr style="height: 60px">
                <td colspan="6" style="font-weight: bold;font-size: large;color: #535353">فاکتور فروش </td>
            </tr>
            <tr>
                <td colspan="6" ><img style="width: 220px;height: 38px" src="img/logo.png" ></td>
             </tr>
             <tr style="height: 80px">
                 <td COLSPAN="6" >
                 <fieldset style="color: #000000;background-color: #ffffff;width: 200px;margin: auto;padding: 10px;border-radius: 20px">وضعیت سفارش : ';
        echo $status;
        echo '</fieldset>
                 </td>        
             </tr>
             
              <tr >
                 <td COLSPAN="6" >
                 <fieldset style="color: #000000;background-color: #dedede;width: 160px;padding: 10px;border-radius: 30px">شماره فاکتور : ';
        echo $invoiceid;
        echo '</fieldset>
                 </td>        
              </tr>
              
               <tr style="height: 50px">
                 <td COLSPAN="6" >
                 <fieldset style="color: #000000;background-color: #dedede;width: 160px;padding: 10px;border-radius: 30px">تاریخ : ';
        echo $date;
        echo '</fieldset>
                 </td>        
              </tr>
             

            <tr>
            <td colspan="6" style="background-color: gold">مشخصات خریدار</td>
        </tr>

        <tr style="background-color: #7b7b7b;color: white;height: 30px">
            
            <td>نام</td>
            <td>نام خانوادگی</td>
            
            <td colspan="2">آدرس</td>
            <td>کد پستی</td>
            <td>شماره تماس</td>
        </tr>

        <tr style="background-color: whitesmoke;height: 40px">
            
            <td>' . $row_user['name'] . '</td>
            <td>' . $row_user['family'] . '</td>
            
            <td colspan="2">' . $row_user['address'] . '</td>
            <td>' . $row_user['postalcode'] . '</td>
            <td>' . $row_user['tel'] . '</td>
        </tr>
        <tr>
            <td colspan="6" style="height: 20px"></td>
        </tr>


        <tr>
            <td colspan="6" style="background-color: gold">لیست کالاهای خریداری شده</td>
        </tr>
        <tr style="background-color: #7b7b7b;color: white; height: 30px">
            
            <td style="width: 10%">شماره کالا</td>
            <td style="width: 15%">نوع کالا</td>
            <td style="width: 30%">نام  کالا</td>
            <td style="width: 5%">تعداد</td>
            <td style="width: 20%">قیمت واحد</td>
            <td style="width: 20%">جمع</td>
        </tr>';
        $sql = "SELECT * FROM `productorder` WHERE invoiceid='$invoiceid'";
        $result = mysqli_query($this->link, $sql) or die();
        $totalprice = 0;
        $qty = 0;
        while ($row_order = mysqli_fetch_assoc($result)) {
            $sql = "SELECT * FROM `product` WHERE productid='$row_order[productid]'";
            $result2 = mysqli_query($this->link, $sql) or die();
            $row_product = mysqli_fetch_assoc($result2);


            echo '
            <tr style="background-color: whitesmoke;height: 30px">
                <td>' . $row_order['productid'] . '</td>
                <td>' . $this->TypeConvertor($row_product['ptype']) . '</td>
                <td>' . $row_product['pname'] . '</td>
                <td>' . $row_order['qty'] . '</td>
                <td>' . $this->priceConvertor($row_product['price']) . '</td>
                <td>' . $this->priceConvertor($row_order['totalprice']) . '</td>
             </tr>
            
            ';
            $totalprice += $row_order['totalprice'];
            $qty += $row_order['qty'];
        }


        echo '
        
        <tr style="height: 60px">
                 <td COLSPAN="6" >
                 <fieldset style="color: black;background-color: #ffffff;width: 220px;padding: 10px;border-radius: 5px;">جمع تعداد : ';
        echo $qty . '  عدد';
        echo '</fieldset>
                 </td>        
         </tr>
    
        <tr >
                 <td COLSPAN="6" >
                 <fieldset style="color: orangered;background-color: #ffffff;width: 220px;padding: 10px;border-radius: 5px;"">قیمت کل : ';
        echo $this->priceConvertor($totalprice);
        echo '</fieldset>
                 </td>        
        </tr>
        
        <tr style="height: 70px">
                 <td COLSPAN="6" >
                    <fieldset style="background-color: #dedede;width: 650px;margin: auto;padding: 5px;border-radius: 20px">
                        <pre> فروشگاه اکسیژن کامپیوتر     تلفن: 09368412027       آدرس : اهواز - پردیس- خیابان گلدسته 9</pre>
                     </fieldset>
                 </td>        
        </tr>

        </table>';

    }  // ********* end function showinvoice *********


    /*================================================================================
     \                          function priceConvertor                                 \
     ================================================================================*/

    function priceConvertor($input)
    {
        $price = $input / 1000;
        if ($price < 1000 && $price > 1)
            $price = $price . " هزار تومان";
        elseif ($price < 1)
            $price = $price * 1000 . " تومان";
        else {
            $price = ($price / 1000) . " میلیون تومان";
        }

        return $price;

    }// ********* end function priceConvertor *********


    /*================================================================================
     \                          function TypeConvertor                                 \
     ================================================================================*/

    function TypeConvertor($input)
    {
        $ptype = $input;

        switch ($ptype) {
            case 'main': {
                $ptype = "مادربورد";
                break;
            }
            case 'cpu': {
                $ptype = "پردازنده";
                break;
            }
            case 'ram': {
                $ptype = "رم کامپیوتر";
                break;
            }
            case 'hard': {
                $ptype = "هارد دیسک";
                break;
            }
            case 'gpu': {
                $ptype = "کارت گرافیک";
                break;
            }
            case 'case': {
                $ptype = "کیس";
                break;
            }
            case 'power': {
                $ptype = "پاور";
                break;
            }
            case 'monitor': {
                $ptype = "مانیتور";
                break;
            }
        }

        return $ptype;


    } // ********* end function TypeConvertor *********

}// ==================// END ProfileClass //==================

?>