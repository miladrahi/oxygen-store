<?php
if(isset($_SESSION['reguser']) && $_SESSION['reguser']=='admin' ) {

        if(isset($_GET['usermenu'] ))
        {
                echo '
            <div class="div_nav" style="float: right;width: 30%;margin-top: 0;line-height: 2.4;">
                <ul class="ul_nav" >
                    <li><a id="title" style="background-color: #404445;color: #00f0ff;font-size: small;font-weight: normal">مدیریت فروشگاه</a></li>
             <li><a ';if ($_GET['usermenu']=='editprofile') echo "class='active'";echo ' href="?usermenu=editprofile">تغییر پروفایل کاربری</a></li>
             <li><a ';if ($_GET['usermenu'] == 'manageuser') echo "class='active'";echo ' href="?usermenu=manageuser">مدیریت کاربران</a></li> 
             <li><a ';if ($_GET['usermenu'] == 'regproduct') echo "class='active'"; echo ' href="?usermenu=regproduct">ثبت اجناس</a></li>
             <li><a ';if ($_GET['usermenu'] == 'editproduct') echo "class='active'";echo ' href="?usermenu=editproduct">مدیریت اجناس ثبت شده</a></li>
             <li><a ';if ($_GET['usermenu'] == 'order') echo "class='active'";echo ' href="?usermenu=order">سفارش های ثبت شده</a></li>
             <li><a ';if ($_GET['usermenu'] == 'adminpayment') echo "class='active'";echo ' href="?usermenu=adminpayment">پرداخت سفارش ها</a></li>
             <li><a ';if ($_GET['usermenu'] == 'paid') echo "class='active'";echo ' href="?usermenu=paid">سفارش های پرداخت شده</a></li>
             <li><a ';if ($_GET['usermenu'] == 'send') echo "class='active'";echo ' href="?usermenu=send">سفارش های آماده ارسال</a></li> 
             <li><a ';if ($_GET['usermenu'] == 'sended') echo "class='active'";echo ' href="?usermenu=sended">سفارش های ارسال شده</a></li>
             <li><a ';if ($_GET['usermenu'] == 'delivered') echo "class='active'";echo ' href="?usermenu=delivered">سفارش های تحویل داده شده</a></li> 
             <li><a ';if ($_GET['usermenu'] == 'search') echo "class='active'";echo ' href="?usermenu=search">جستجوی سفارش</a></li> 
             <li><a id="exit" href="?usermenu=logout">خروج</a></li>
             </ul>
            </div>
            ';

        }else if(isset($_SESSION['select'])) {
            echo '
            <div class="div_nav" style="float: right;width: 30%;margin-top: 0;line-height: 2.4;">
                <ul class="ul_nav" >
                    <li><a id="title" style="background-color: #404445;color: #00f0ff;font-size: small;font-weight: normal">مدیریت فروشگاه</a></li>
             <li><a  href="?usermenu=editprofile">تغییر پروفایل کاربری</a></li>
             <li><a ';if ($_SESSION['select'] == 'manageuser') echo "class='active'";echo ' href="?usermenu=manageuser">مدیریت کاربران</a></li> 
             <li><a href="?usermenu=regproduct">ثبت اجناس</a></li>
             <li><a ';if ($_SESSION['select'] == 'editproduct') echo "class='active'";echo ' href="?usermenu=editproduct">مدیریت اجناس ثبت شده</a></li>
             <li><a ';if ($_SESSION['select'] == 'order') echo "class='active'";echo ' href="?usermenu=order">سفارش های ثبت شده</a></li>
             <li><a ';if ($_SESSION['select'] == 'adminpayment') echo "class='active'";echo ' href="?usermenu=adminpayment">پرداخت سفارش ها</a></li>
             <li><a ';if ($_SESSION['select'] == 'paid') echo "class='active'";echo ' href="?usermenu=paid">سفارش های پرداخت شده</a></li>
             <li><a ';if ($_SESSION['select'] == 'send') echo "class='active'";echo ' href="?usermenu=send">سفارش های آماده ارسال</a></li> 
             <li><a ';if ($_SESSION['select'] == 'sended') echo "class='active'";echo ' href="?usermenu=sended">سفارش های ارسال شده</a></li>
             <li><a ';if ($_SESSION['select'] == 'delivered') echo "class='active'";echo ' href="?usermenu=delivered">سفارش های تحویل داده شده</a></li> 
             <li><a href="?usermenu=search">جستجوی سفارش</a></li> 
             <li><a id="exit" href="?usermenu=logout">خروج</a></li>
             </ul>
            </div>
            ';
        } else {
            echo '
            <div class="div_nav" style="float: right;width: 30%;margin-top: 0;line-height: 2.4;">
                <ul class="ul_nav" >
                    <li><a id="title" style="background-color: #404445;color: #00f0ff;font-size: small;font-weight: normal">مدیریت فروشگاه</a></li>
             <li><a class="active"  href="?usermenu=editprofile">تغییر پروفایل کاربری</a></li>
             <li><a href="?usermenu=manageuser">مدیریت کاربران</a></li> 
             <li><a href="?usermenu=regproduct">ثبت اجناس</a></li>
             <li><a href="?usermenu=editproduct">مدیریت اجناس ثبت شده</a></li>
             <li><a href="?usermenu=order">سفارش های ثبت شده</a></li>
             <li><a href="?usermenu=adminpayment">پرداخت سفارش ها</a></li>
             <li><a href="?usermenu=paid">سفارش های پرداخت شده</a></li>
             <li><a href="?usermenu=send">سفارش های آماده ارسال</a></li> 
             <li><a href="?usermenu=sended">سفارش های ارسال شده</a></li>
             <li><a href="?usermenu=delivered">سفارش های تحویل داده شده</a></li> 
             <li><a href="?usermenu=search">جستجوی سفارش</a></li> 
             <li><a id="exit" href="?usermenu=logout">خروج</a></li>
             </ul>
            </div>
            ';
        }

} else if(isset($_SESSION['reguser']) && $_SESSION['reguser']!='admin') {

    if(isset($_GET['usermenu'] ))
    {
        echo '
            <div class="div_nav" style="float: right;margin-top: 0;line-height: 3.4;">
                <ul class="ul_navuser" >
             <li><a id="title" style="background-color: #404445;color: #00f0ff;font-size: small;font-weight: normal">منوی کاربری</a></li>          
             <li><a ';if ($_GET['usermenu']=='editprofile') echo "class='active'";echo ' href="?usermenu=editprofile">تغییر پروفایل کاربری</a></li>
             <li><a ';if ($_GET['usermenu'] == 'userorder') echo "class='active'";echo ' href="?usermenu=userorder">سفارش های ثبت شده</a></li>
             <li><a ';if ($_GET['usermenu'] == 'paid') echo "class='active'";echo ' href="?usermenu=paid">سفارش های پرداخت شده</a></li>
             <li><a ';if ($_GET['usermenu'] == 'sended') echo "class='active'";echo ' href="?usermenu=sended">سفارش های ارسال شده</a></li>
             <li><a ';if ($_GET['usermenu'] == 'delivered') echo "class='active'";echo ' href="?usermenu=delivered">سفارش های تحویل داده شده</a></li> 
             <li><a id="exit" href="?usermenu=logout">خروج</a></li>  
             </ul>
            </div>
            ';

    }else if(isset($_SESSION['select'])) {
            echo '
            <div class="div_nav" style="float: right;margin-top: 0;line-height: 3.4;">
                <ul class="ul_navuser" >
                    <li><a id="title" style="background-color: #404445;color: #00f0ff;font-size: small;font-weight: normal">منوی کاربری</a></li>
             <li><a  href="?usermenu=editprofile">تغییر پروفایل کاربری</a></li>
             <li><a ';if ($_SESSION['select'] == 'userorder') echo "class='active'";echo ' href="?usermenu=userorder">سفارش های ثبت شده</a></li>
             <li><a ';if ($_SESSION['select'] == 'userpaid') echo "class='active'";echo ' href="?usermenu=paid">سفارش های پرداخت شده</a></li>
             <li><a ';if ($_SESSION['select'] == 'usersended') echo "class='active'";echo ' href="?usermenu=sended">سفارش های ارسال شده</a></li>
             <li><a ';if ($_SESSION['select'] == 'userdelivered') echo "class='active'";echo ' href="?usermenu=delivered">سفارش های تحویل داده شده</a></li>   
             <li><a id="exit" href="?usermenu=logout">خروج</a></li>
             </ul>
            </div>
            ';
        } else {
        echo '
            <div class="div_nav" style="float: right;margin-top: 10px;line-height: 3.4;">
                <ul class="ul_navuser" >
                    <li><a id="title" style="background-color: #404445;color: #00f0ff;font-size: small;font-weight: normal">منوی کاربری</a></li>
             <li><a class="active" href="?usermenu=editprofile">تغییر پروفایل کاربری</a></li>
             <li><a  href="?usermenu=userorder">سفارش های ثبت شده</a></li>
             <li><a  href="?usermenu=paid">سفارش های پرداخت شده</a></li>
             <li><a href="?usermenu=sended">سفارش های ارسال شده</a></li>
             <li><a  href="?usermenu=delivered">سفارش های تحویل داده شده</a></li>
             <li><a id="exit" href="?usermenu=logout">خروج</a></li>
             </ul>
            </div>
            ';
    }

}
?>
