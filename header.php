
<header id="header"  style="font-family:IRANSans-web; font-size: 13px;margin-bottom: 0" >
    <div style="margin: 0 auto;text-align:center;margin-bottom: 30px;margin-top: 10px;">
        <img src="img/logo.png" alt="" >
    </div>
    <nav>
      <div class="container" >
        <ul>
          <li <?php if(basename($_SERVER['PHP_SELF'])=="about.php") echo "class='active'";?> ><a href="about.php">درباره ما</a></li>
          <li <?php if(basename($_SERVER['PHP_SELF'])=="profile.php") echo "class='active'";?> ><a  href="profile.php">ورود به پروفایل</a></li>
          <li <?php if(basename($_SERVER['PHP_SELF'])=="register.php") echo "class='active'";?> ><a href="register.php">ثبت نام</a></li>
          <li <?php if(basename($_SERVER['PHP_SELF'])=="cart.php") echo "class='active'";?> ><a href="cart.php">سبد خرید</a></li>
          <li <?php if(basename($_SERVER['PHP_SELF'])=="index.php") echo "class='active'";?> ><a href="index.php">صفحه اصلی فروشگاه</a></li>
        </ul>
      </div>
        <div <?php if(basename($_SERVER['PHP_SELF'])!="index.php") echo "style='display: none;'"?> style="margin-top: 0.4%">
            <form method="post" action="?menu=searchproduct">
                <input class="srchbox"  type="text" name="srchbox"><input type="submit" value="جستجو" class="srchbtn" style="font-size: 11px;width: 60px">
            </form>
        </div>
    </nav>
</header>

