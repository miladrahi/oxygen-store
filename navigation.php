<?php
if(isset($_GET['menu']))
{
    echo '

<div class="div_nav" style="margin-top: 0;line-height: 3;">

    <ul class="ul_nav" style="font-size: 14px">
        <li><a id="title" style="background-color: #404445;color: #00f0ff;font-size: small;font-weight: normal">گروه محصولات</a></li>
        <li><a '; if(basename($_SERVER['REQUEST_URI'])=="index.php" || $_GET['menu']=='all' ) echo "class='active'"; echo' href="?menu=all">نمایش تمامی محصولات</a></li>
        <li><a '; if($_GET['menu']=='main' ) echo "class='active'"; echo' href="?menu=main">مادربورد</a></li>
        <li><a '; if($_GET['menu']=='cpu' ) echo "class='active'"; echo' href="?menu=cpu">پردازنده</a></li>
        <li><a '; if($_GET['menu']=='ram' ) echo "class='active'"; echo' href="?menu=ram">رم کامپیوتر</a></li>
        <li><a '; if($_GET['menu']=='hard' ) echo "class='active'"; echo' href="?menu=hard">هارد دیسک</a></li>
        <li><a '; if($_GET['menu']=='gpu' ) echo "class='active'"; echo' href="?menu=gpu">کارت گرافیک</a></li>
        <li><a '; if($_GET['menu']=='case' ) echo "class='active'"; echo' href="?menu=case">کیس</a></li>
        <li><a '; if($_GET['menu']=='power' ) echo "class='active'"; echo' href="?menu=power">پاور</a></li>
        <li><a '; if($_GET['menu']=='monitor')echo "class='active'"; echo' href="?menu=monitor">مانیتور</a></li>
    </ul>
</div>';

} elseif (isset($_SESSION['showproduct']) && basename($_SERVER['REQUEST_URI'])!="index.php" )
{
    echo '

<div class="div_nav" style="margin-top: 0;line-height: 3;">

    <ul class="ul_nav" style="font-size: 14px">
        <li><a id="title" style="background-color: #404445;color: #00f0ff;font-size: small;font-weight: normal">گروه محصولات</a></li>
        <li><a '; if($_SESSION['showproduct']=='all' ) echo "class='active'"; echo' href="?menu=all">نمایش تمامی محصولات</a></li>
        <li><a '; if($_SESSION['showproduct']=='main') echo "class='active'"; echo' href="?menu=main">مادربورد</a></li>
        <li><a '; if($_SESSION['showproduct']=='cpu') echo "class='active'"; echo' href="?menu=cpu">پردازنده</a></li>
        <li><a '; if($_SESSION['showproduct']=='ram') echo "class='active'"; echo' href="?menu=ram">رم کامپیوتر</a></li>
        <li><a '; if($_SESSION['showproduct']=='hard') echo "class='active'"; echo' href="?menu=hard">هارد دیسک</a></li>
        <li><a '; if($_SESSION['showproduct']=='gpu') echo "class='active'"; echo' href="?menu=gpu">کارت گرافیک</a></li>
        <li><a '; if($_SESSION['showproduct']=='case') echo "class='active'"; echo' href="?menu=case">کیس</a></li>
        <li><a '; if($_SESSION['showproduct']=='power') echo "class='active'"; echo' href="?menu=power">پاور</a></li>
        <li><a '; if($_SESSION['showproduct']=='monitor')echo "class='active'"; echo' href="?menu=monitor">مانیتور</a></li>
    </ul>
</div>';


} else {

    echo '

<div class="div_nav" style="margin-top: 0;line-height: 3;">

    <ul class="ul_nav">
        <li><a id="title" style="background-color: #404445;color: #00f0ff;font-size: small;font-weight: normal">گروه محصولات</a></li>
        <li><a class="active" href="?menu=all">نمایش تمامی محصولات</a></li>
        <li><a  href="?menu=main">مادربورد</a></li>
        <li><a  href="?menu=cpu">پردازنده</a></li>
        <li><a  href="?menu=ram">رم کامپیوتر</a></li>
        <li><a  href="?menu=hard">هارد دیسک</a></li>
        <li><a  href="?menu=gpu">کارت گرافیک</a></li>
        <li><a  href="?menu=case">کیس</a></li>
        <li><a  href="?menu=power">پاور</a></li>
        <li><a  href="?menu=monitor">مانیتور</a></li>
    </ul>
</div>';

}
?>