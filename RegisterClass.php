<?php

class RegisterClass
{

    /*
   ======== function list ========

   Reset
   Register
   checkRegistration
   validate

   ================================
    */

// Properties
    var $link;

// Constructor
    function RegisterClass(){
        $this->link = mysqli_connect("localhost", "root", "", "oxygen");
    }


    /*================================================================================
  \                          function Reset                                        \
  ================================================================================*/


    function Reset()
    {
        if (isset($_REQUEST["exit"])) {
            unset($_SESSION["reguser"]);
            header("refresh:0;");
        }

        if (isset($_GET["reset"])) {
            if(isset($_SESSION["username"]))unset($_SESSION["username"]);
            if(isset($_SESSION["email"]))unset($_SESSION["email"]);
            unset($_SESSION["registermenu"]);
            header("location: register.php");
        }
    } // ********* end function  Reset *********


    /*================================================================================
  \                          function Register                                   \
  ================================================================================*/

    function Register()
    {

        if(isset($_SESSION["username"]))unset($_SESSION["username"]);
        if(isset($_SESSION["email"]))unset($_SESSION["email"]);

       /*if (isset($_POST['btn_reguser'])) {
            mysqli_query($this->link, "SET NAMES 'UTF8'");
            if ($_POST['firstname'] == "" || $_POST['lastname'] == "" || $_POST['username2'] == ""
                || $_POST['email2'] == "" || $_POST['pass'] == "" || $_POST['tel'] == "" || $_POST['postalcode'] == ""|| $_POST['address'] == "") {
                echo "<p id='regmsg' class='msgerror' style='margin-bottom: 30px'>اطلاعات تمام فیلد ها را تکمیل کنید</p>";
            } */
       if(isset($_POST['btn_reguser'])) {
                if ($this->validate($_POST) == "OK") {

                    $sql = "INSERT INTO `user` VALUES ('$_POST[username2]','$_POST[email2]','" . $_POST["pass"][0] . "','$_POST[firstname]','$_POST[lastname]','$_POST[gender]','$_POST[address]','$_POST[postalcode]','$_POST[tel]')";


                    if (mysqli_query($this->link, $sql)) {

                       header('location: ?registerok');
                        $_SESSION["reginfo"]=$_SESSION["username"];
                        unset($_SESSION["username"]);
                        unset($_SESSION["email"]);


                    } else {
                        echo "<p style='margin-bottom: 30px' class='msgerror'>مشکل در ثبت اطلاعات</p>";
                    }
                } else {

                    echo "<div style='line-height: 30px; margin-bottom: 30px'>";
                    echo "<p id='msgerror1' class='msgerror'>" . $this->validate($_POST) . "</p>";
                    echo "<p id='msgerror2' class='msgerror'>لطفا دوباره امتحان کنید</p></div>";
                }
            }
        //}
        if(isset($_GET['registerok'])){
            echo '
                            <form accept-charset="utf-8" action="" method="post" id="form1" style="margin-top: 70px">
                                <fieldset id="field1" class="field">
                                    <table dir="rtl" align="center"  style="margin:auto; margin-top: 60px;">
                                        <tr>
                                            <td >ثبت نام شما با موفقیت انجام شد</td>		
                                        </tr>
                                        <tr style="height: 40px"><td></td></tr>
                                        
                                        <tr>
                                            <td >شما با نام کاربری '.$_SESSION["reginfo"].' در سایت ثبت نام کردید </td>
                                            
                                        </tr>
                                        <tr style="height: 40px"><td></td></tr>
                                        <tr>
                                            <td height="50px"><input type="submit" value="تایید" name="confirmreg" class="btn2" style="width: 150px"></td>
                                        </tr>
                                        
                                </table>
                                </fieldset>
                                </form> ';

        }
        if(isset($_POST['confirmreg']))
        {
            header('location: register.php');
        }

        //-------------------------------------------------------------------------------------



        mysqli_query($this->link, "SET NAMES 'UTF8'");
        if (isset($_POST['btn_checkreg'])) {
            $this->checkRegistration($_POST['username'], $_POST['email']);
        }

        if (isset($_SESSION["reguser"])) {
            echo "<div class='field' style='width: 560px;margin-top: 70px'><div style='margin:12% auto 15% auto'>کاربر گرامی برای مشاهده صفحه ثبت نام ابتدا باید از حساب کاربری خود خارج شوید</div>";
            echo '<div><form action="" method="post">
	<input type="submit" class="btn11" value="خروج" name="exit" >
	</form></div></div>';

        } else if (isset($_SESSION["registermenu"])) {
            echo '<div class="msgerror" style="line-height: 25px" > <p id="fnmsg"></p><p id="lnmsg"></p><p id="usermsg"></p>
                              <p id="emailmsg"></p><p id="pass1msg"></p><p id="pass2msg"></p><p id="addressmsg"></p><p id="postmsg"></p><p id="telmsg"></p> </div>
    <div><form accept-charset="utf-8" action="" method="post"  id="form2"  >
	<fieldset class="field2" style="height: 730px" >
		<table dir="rtl" align="center" style="margin-right: 65px;">

			<tr>
			    <td></td>
                <td height="50px">لطفا کلیه اطلاعات زیر را تکمیل کنید</td>
			</tr>
			<tr>
                <td><label for="ftname">نام</label></td>	
                <td height="35px"><input  name="firstname" type="text" id="firstname" value="';if(isset($_POST['firstname']))echo $_POST['firstname']; echo '" class="txt3" </td>   
			</tr>
			<tr>
				<td>نام خانوادگی</td>
				
				<td height="40px"><input type="text" name="lastname" id="lastname" value="';if(isset($_POST['lastname']))echo $_POST['lastname']; echo '" class="txt3"</td>
			</tr>
	        <tr>
				<td>جنسیت</td>
				<td height="40px">
                    <select name="gender" class="txt3">>
                        <option name="Male" ';if(isset($_POST['gender']) && $_POST['gender']=='0')echo 'selected'; echo ' value=0>مرد</option>
                        <option name="Female" ';if(isset($_POST['gender']) && $_POST['gender']=='1')echo 'selected'; echo ' value=1>زن</option>
                    </select>
                 </td>
			</tr>
			
	        <tr>
				<td>نام کاربری</td>
				
				<td height="40px"><input type="text" name="username2" id="user" value="';if(isset($_SESSION['username']))echo $_SESSION['username'];elseif(isset($_POST['username2'])) echo $_POST['username2']; echo '" class="txt3"</td>
			</tr>	
			<tr>
				<td>آدرس ایمیل</td>
				<td height="40px"><input type="email" name="email2" id="email" value="';if(isset($_SESSION['email']))echo $_SESSION['email'];elseif(isset($_POST['email2'])) echo $_POST['email2']; echo '" class="txt3"</td>
			</tr>
			<tr>
				<td>رمز عبور</td>
				
				<td height="40px"><input type="password"  name="pass[]" id="pass1" class="txt3"</td>
			</tr>
			<tr>
				<td>تکرار رمز عبور</td>
				
				<td height="40px"><input type="password"  name="pass[]" id="pass2"  class="txt3"</td>
			</tr>
			<tr>
				<td>آدرس</td>
				
				<td height="40px"><input type="text" value="';if(isset($_POST['address']))echo $_POST['address']; echo '" name="address" id="address" class="txt3"/></td>
			</tr>	
			<tr>
				<td>کدپستی</td>
				
				<td height="40px"><input type="text" value="';if(isset($_POST['postalcode']))echo $_POST['postalcode']; echo '" name="postalcode" id="postalcode" class="txt3"/></td>
			</tr>
			<tr>
				<td>تلفن</td>
				<td height="40px"><input type="text" value="';if(isset($_POST['tel']))echo $_POST['tel']; echo '" name="tel" id="tel" class="txt3"</td>
			</tr>
			<tr>
				<td></td>
				<td height="70x"><input type="submit" value="انجام ثبت نام" name="btn_reguser" class="btn6" style="height: 45px;width: 180px;"/></td>	
			</tr>
			<tr>
				<td></td>
				<td height="40px"><a href="?reset" class="btn16" style="padding: 12px;">بررسی یک نام کاربری دیگر</a> </td>				
			</tr>
	</form>
	
	</table>';
        } elseif(!isset($_SESSION["username"]) && !isset($_SESSION["email"]) && !isset($_GET['registerok']) ) {
            echo '<form accept-charset="utf-8" action="" method="post" id="form1" style="margin-top: 70px">
	<fieldset id="field1" class="field">
		<table dir="rtl" align="center"  style="margin-right: 40px;margin-top: 35px">
			<tr>
			<td></td>
				<td style="text-align:left ">نام کاربری و ایمیل خود را وارد کنید</td>		
			</tr>
			<tr><td height="15px"></td></tr>
			<tr>
				<td>نام کاربری</td>
				<td><input type="text" name="username" id="username" class="txt" style="width:200px;"/></td>		
			</tr>
			<tr>
				<td width="74px" >آدرس ایمیل</td>
				<td><input type="email" name="email" id="email" class="txt" style="width:200px;"/></td>
			</tr>
			
			<tr>
				<td></td>
				<td height="50px"><input type="submit" value="بررسی" name="btn_checkreg" class="btn2"/></td>
			</tr>
			
	</table>
	</fieldset>
	</form> ';

        }



    }// ********* end function  Register *********


    /*================================================================================
  \                          function checkRegistration                              \
  ================================================================================*/

    function checkRegistration($username, $email)
    {

        if ($_POST['username'] == "" || $_POST['email'] == "") {
            echo "<p class='msgok'>اطلاعات تمام فیلد ها را تکمیل کنید</p>";
        } else {


            $sql = "select * from user where username='" . $username . "' or email='" . $email . "'";

            $result = mysqli_query($this->link, $sql) or die();

            if (mysqli_num_rows($result) > 0) {
                echo "<p class='msgerror'>متاسفانه کاربر دیگری با این ایمیل یا نام کاربری ثبت نام کرده است</p>";

            } else {
                $_SESSION["username"] = $_REQUEST["username"];
                $_SESSION["email"] = $_REQUEST["email"];
                $_SESSION["registermenu"] = 1;

            }
        }
    }// ********* end function  checkRegistration *********


    /*================================================================================
  \                          function validate                                      \
  ================================================================================*/

    function validate($allSubmitted)
    {
        $message = "";
        if(isset($allSubmitted["firstname"]))
        {
            $fn_flag=0;
            $firstname=$allSubmitted["firstname"];

            if($firstname=='') {
                $fn_flag++;
                $message = $message . "شما نام خود را وارد نکرده اید<br/>";
            }

            if($fn_flag>0)
                echo '<style>#firstname {background-color: #ffcece;}</style>';

        }

        if(isset($allSubmitted["lastname"]))
        {
            $ln_flag=0;
            $lastname=$allSubmitted["lastname"];
            if($lastname=='') {
                $ln_flag++;
                $message = $message . "شما نام خانوادگی خود را وارد نکرده اید<br/>";
            }

            if($ln_flag>0)
                echo '<style>#lastname {background-color: #ffcece;}</style>';
        }

        if(isset($allSubmitted["email2"]))
        {
            $mail_flag=0;
            $email=$allSubmitted["email2"];
            if($email=='') {
                $mail_flag++;
                $message = $message . "ایمیل خود را وارد کنید<br/>";
            }
            else {
                $sql = "select * from user where email='" . $email . "'";
                $result = mysqli_query($this->link, $sql) or die();
                if (mysqli_num_rows($result) > 0) {
                    $mail_flag++;
                    $message = $message . "متاسفانه کاربر دیگری با این ایمیل ثبت نام کرده است<br/>";
                }
            }

            if($mail_flag>0)
                echo '<style>#email {background-color: #ffcece;}</style>';
        }

        if(isset($allSubmitted["username2"]))
        {
            $user_flag=0;
            $username = $allSubmitted["username2"];
            $username_space = strrpos($username," ");
            //var_dump($username_space) ;
            if (strlen($username) < 5 || strlen($username) > 50) {
                $user_flag++;
                $message = $message . "طول نام کاربری باید بین 5 تا 50 کارکتر باشد<br/>";
            }

            elseif($username_space!==false) {
                $user_flag++;
                $message = $message . "نام کاربری نمی تواند شامل فضای خالی باشد<br/>";
            }
            else {
                $sql = "select * from user where username='" . $username . "'";
                $result = mysqli_query($this->link, $sql) or die();
                if (mysqli_num_rows($result) > 0) {
                    $user_flag++;
                    $message = $message . "متاسفانه کاربر دیگری با این نام کاربری ثبت نام کرده است<br/>";
                }
            }

            if($user_flag>0)
                echo '<style>#user {background-color: #ffcece;}</style>';

        }

        if(isset($allSubmitted["pass"]))
        {
            $pass_flag=0;
            $passwords = $allSubmitted["pass"];
            $firstPass = $passwords[0];
            $secondPass = $passwords[1];

            if($firstPass=='') {
                $pass_flag++;
                $message = $message . "یک رمز عبور حداقل 8 رقمی وارد کنید<br/>";
            }

            elseif (strlen($firstPass) < 8) {
                $pass_flag++;
                $message = $message . "طول کلمه عبور حداقل باید 8 کارکتر باشد<br/>";
            }

            elseif($secondPass=='') {
                $pass_flag++;
                $message = $message . "ورود تکرار رمز عبور الزامی است<br/>";
            }

            elseif ($firstPass != $secondPass) {
                $pass_flag++;
                $message = $message . "کلمه عیور وارد شده با هم یکی نیست<br/>";
            }

            if($pass_flag>0)
                echo '<style>#pass1,#pass2 {background-color: #ffcece;}</style>';

        }

        if(isset($allSubmitted["postalcode"]))
        {
            $post_flag=0;
            $postalcode=$allSubmitted["postalcode"];
            if($postalcode=='') {
                $post_flag++;
                $message = $message . "کدپستی خود را وارد کنید<br/>";
            }

            if($post_flag>0)
                echo '<style>#postalcode {background-color: #ffcece;}</style>';
        }

        if(isset($allSubmitted["address"]))
        {
            $adrs_flag=0;
            $address=$allSubmitted["address"];
            if($address=='') {
                $adrs_flag++;
                $message = $message . "آدرس خود را وارد کنید<br/>";
            }

            if($adrs_flag>0)
                echo '<style>#address {background-color: #ffcece;}</style>';
        }

        if(isset($allSubmitted["tel"]))
        {
            $tel_flag=0;
            $tel=$allSubmitted["tel"];
            if($tel=='') {
                $tel_flag++;
                $message = $message . "شماره تلفن خود را وارد کنید<br/>";
            }

            if($tel_flag>0)
                echo '<style>#tel {background-color: #ffcece;}</style>';
        }

        if ($message == "") {
            $message = "OK";
        }
        return $message;
    }// ********* end function  validate *********

}// ==================// END RegisterClass //==================
?>