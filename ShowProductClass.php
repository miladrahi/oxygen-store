<?php


class ShowProductClass
{
    /*
      ======== function list ========

      ShowProduct
      SelectProductType
      ShowProductPage

      ================================
       */

// Properties
    var $link;

// Constructor
    function ShowProductClass(){
        $this->link = mysqli_connect("localhost", "root", "", "oxygen");
    }

    /*================================================================================
  \                          function ShowProduct                                    \
  ================================================================================*/

    function ShowProduct($condition)
    {


        if (isset($_GET['page'])) {

            $per_page = 16;

            $pageadmin = new page_class($per_page, 'page');

            //error_reporting(0); // disable error report

            if (isset($_SESSION['showproduct']) && $_SESSION['showproduct'] == "searchproduct") {
                $sql = "SELECT * FROM `product` WHERE pname LIKE '%$condition%' GROUP BY productid";

            } else {
                $sql = "SELECT * FROM `product` WHERE $condition GROUP BY productid";
            }

            $result = mysqli_query($this->link, $sql) or die();

            // paging start
            $row_counts = mysqli_num_rows($result);
            $pageadmin->specify_row_counts($row_counts);
            $starting_record = $pageadmin->get_starting_record();

            if (isset($_SESSION['showproduct']) && $_SESSION['showproduct'] == "searchproduct") {
                $sql = "SELECT * FROM `product` WHERE pname LIKE '%$condition%' GROUP BY productid LIMIT $starting_record, $per_page";
            } else {
                $sql = "SELECT * FROM `product` WHERE $condition GROUP BY productid LIMIT $starting_record, $per_page";

            }

            $result = mysqli_query($this->link, $sql) or die();
            $number = $starting_record; //numbering

            $num_rows = mysqli_num_rows($result);
            if ($num_rows == 0) {   // if no result is found
                echo "<tr class='notice' style=' height: 50px'>
                                 <td  colspan='8' class='note'><p class='msgerror'>در این بخش محصولی جهت نمایش وجود ندارد</p></td>
                                 </tr></table> </form>";

                if ($_GET['page'] > 1) {
                    $page = $_GET['page'] - 1;
                    header('location:?page=' . $page . '');
                }

            } else {
                if ($_GET['page'] == 1) {
                    $starting_record = 0;

                } else {
                    $starting_record = ($_GET['page'] * 16) - 16;
                }
            }

            if (isset($_SESSION['showproduct']) && $_SESSION['showproduct'] == "searchproduct") {
                $sql = "SELECT * FROM `product` WHERE pname LIKE '%$condition%' GROUP BY productid LIMIT $starting_record, 16";
            } else {
                $sql = "SELECT * FROM `product` WHERE $condition GROUP BY productid LIMIT $starting_record, 16";

            }

            //------------------------------------------------------*/

            echo '
                            <div style="width: 500px;margin-right:270px ;padding: 0;">
                                <form action="" method="post">
                                    <div class="tbl3">
                    ';

            $result = mysqli_query($this->link, $sql) or die();

            if (mysqli_num_rows($result) != null) {
                $num_rows = ceil(mysqli_num_rows($result) / 4);
                for ($i = 0; $i < $num_rows; $i++) {
                    echo '<div class="row">';
                    for ($j = 0; $j < 4; $j++) {
                        if ($row = mysqli_fetch_assoc($result)) {
                            $price = $row['price'] / 1000;
                            if ($price < 1000 && $price > 1)
                                $price = $price . " هزار تومان";
                            elseif ($price < 1)
                                $price = $price * 1000 . " تومان";
                            else {
                                $price = ($price / 1000) . " میلیون تومان";
                            }
                            echo '
                                <div class="cell">
                                    <fieldset class="field3">
                                        <div class="tbl4">
                                            <div class="row2"><a href="?product=' . $row['productid'] . '"><img src="' . $row['pimage'] . '" id="product" class="img-radius"></a></div>
                                            <div class="row2"><span class="cell2"><a href="?product=' . $row['productid'] . '" style=" color: #3e3e3e;">' . $row['pname'] . '</a></span></div>            
                                            <div class="row2" style="color: #3e3e3e"><span class="cell2">' . $price . '</span></div>
                                            <div class="row2">
                                                <span style="align-items: center;color: #3e3e3e">تعداد </span><span><input type="text" name="qty' . $row['productid'] . '" id="qty" value="1" class="product-qty"></span>';
                            if($row['inventory']>0 ) {
                                echo '<span style = "align-items: center" > <button type = "submit" value = "' . $row['productid'] . '" name = "buybtn" class="btn8" > خرید</button > </span >';
                            } else {
                                echo '<span style = "align-items: center" > <button   class="btn8" style="background-color: rgba(242,242,242,0.45);color: rgba(0,0,0,0.62)" > خرید</button > </span >';
                            }
                            echo '
                    
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>';
                        }
                    }
                    echo ' </div>';
                }
                echo '
                    </div>
                 </form>
                </div>
                    ';

                echo "<div style='margin-top: 2%;direction: ltr'>";
                $pageadmin->show_pages_link('page');
                echo "</div>";
            }

        }


    }// ********* end function  ShowProduct *********


    /*================================================================================
  \                          function SelectProductType                             \
  ================================================================================*/

    function SelectProductType()
    {
        if (basename($_SERVER['REQUEST_URI']) == "index.php" || basename($_SERVER['REQUEST_URI']) == "oxygen" || !isset($_SESSION['showproduct']) ) {
            $_SESSION['showproduct'] = "all";
            $url = basename($_SERVER['PHP_SELF']) . "?page=1";
            header("location: $url");
        }

        if (isset($_GET['menu'])) {
            switch ($_GET['menu']) {
                case 'all': {
                    $_SESSION['showproduct'] = "all";
                    //header("refresh:0;");
                    $url = basename($_SERVER['PHP_SELF']) . "?page=1";
                    header("location: $url");
                    break;
                }
                case 'main': {
                    $_SESSION['showproduct'] = "main";
                    $url = basename($_SERVER['PHP_SELF']) . "?page=1";
                    header("location: $url");
                    break;
                }
                case 'cpu': {
                    $_SESSION['showproduct'] = "cpu";
                    $url = basename($_SERVER['PHP_SELF']) . "?page=1";
                    header("location: $url");
                    break;
                }
                case 'ram': {
                    $_SESSION['showproduct'] = "ram";
                    $url = basename($_SERVER['PHP_SELF']) . "?page=1";
                    header("location: $url");
                    break;
                }
                case 'hard': {
                    $_SESSION['showproduct'] = "hard";
                    $url = basename($_SERVER['PHP_SELF']) . "?page=1";
                    header("location: $url");
                    break;
                }
                case 'gpu': {
                    $_SESSION['showproduct'] = "gpu";
                    $url = basename($_SERVER['PHP_SELF']) . "?page=1";
                    header("location: $url");
                    break;
                }
                case 'case': {
                    $_SESSION['showproduct'] = "case";
                    $url = basename($_SERVER['PHP_SELF']) . "?page=1";
                    header("location: $url");
                    break;
                }
                case 'power': {
                    $_SESSION['showproduct'] = "power";
                    $url = basename($_SERVER['PHP_SELF']) . "?page=1";
                    header("location: $url");
                    break;
                }
                case 'monitor': {
                    $_SESSION['showproduct'] = "monitor";
                    $url = basename($_SERVER['PHP_SELF']) . "?page=1";
                    header("location: $url");
                    break;
                }
                case 'searchproduct': {
                    $_SESSION['srchbox'] = $_POST['srchbox'];
                    $_SESSION['showproduct'] = "searchproduct";
                    $url = basename($_SERVER['PHP_SELF']) . "?page=1";
                    header("location: $url");
                    break;
                }
            }
        }


        if (isset($_SESSION['showproduct'])) {
            if ($_SESSION['showproduct'] == 'all') {

                $condition = "1";
                $this->ShowProduct($condition);


            } elseif ($_SESSION['showproduct'] == 'main') {

                $condition = "ptype='main'";
                $this->ShowProduct($condition);

            } elseif ($_SESSION['showproduct'] == 'cpu') {

                $condition = "ptype='cpu'";
                $this->ShowProduct($condition);

            } elseif ($_SESSION['showproduct'] == 'ram') {

                $condition = "ptype='ram'";
                $this->ShowProduct($condition);

            } elseif ($_SESSION['showproduct'] == 'hard') {

                $condition = "ptype='hard'";
                $this->ShowProduct($condition);

            } elseif ($_SESSION['showproduct'] == 'gpu') {

                $condition = "ptype='gpu'";
                $this->ShowProduct($condition);

            } elseif ($_SESSION['showproduct'] == 'case') {

                $condition = "ptype='case'";
                $this->ShowProduct($condition);

            } elseif ($_SESSION['showproduct'] == 'power') {

                $condition = "ptype='power'";
                $this->ShowProduct($condition);

            } elseif ($_SESSION['showproduct'] == 'monitor') {

                $condition = "ptype='monitor'";
                $this->ShowProduct($condition);

            } elseif (isset($_SESSION['srchbox']) && $_SESSION['showproduct'] == 'searchproduct') {

                $this->ShowProduct($_SESSION['srchbox']);

            }

        }
    }// ********* end function  SelectProductType *********


    /*================================================================================
  \                          function ShowProductPage                                \
  ================================================================================*/

    function ShowProductPage()
    {
        if (isset($_GET['product'])) {

            mysqli_query($this->link, "SET NAMES 'UTF8'");
            $id = $_GET['product'];

            $sql = "SELECT * FROM product WHERE productid=$id";
            $result = mysqli_query($this->link, $sql);
            $row = mysqli_fetch_assoc($result);

            $price = $row['price'] / 1000;
            if ($price < 1000 && $price > 1)
                $price = $price . " هزار تومان";
            elseif ($price < 1)
                $price = $price * 1000 . " تومان";
            else {
                $price = ($price / 1000) . " میلیون تومان";
            }

            $ptype = $row['ptype'];

            switch ($ptype) {
                case 'main': {
                    $ptype = "مادربورد";
                    break;
                }
                case 'CPU' || 'cpu': {
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


            echo '

    <form method="post" style="margin:50px 300px;width: 1000px;min-height: 900px;background: linear-gradient(to bottom,#f1f1f1,#f1f1f1,transparent);border-radius: 20px">
        <div style="font-size: 34px;font-family: Quicksand_Light;color: black;padding: 15px">' . $row['pname'] . '</div>
        <div class="tbl" style="width: 950px;">
            <div class="row" style="">
                <div class="cell" ><img src="' . $row['pimage'] . '"  style="margin: 10px 30px auto auto;width: 450px;height: 300px;border-radius: 5%;border: 2px solid #dddddd"></div>
                    <div class="cell">
                           <div class="row">
                               <div class="cell" style="width: 480px;font-size: 20px;font-family: BYEKAN;height: 300px;line-height: 50px;text-align: justify;">
                                   <div class="tbl" style="margin-right: 50px;">
                                       <div class="row" style= "border-bottom:2px solid white;border-top:2px solid white"><div class="cell" style="text-align: left;color: gray">کد کالا:</div><div class="cell" >' . $row['productid'] . '</div></div>
                                       <div class="row" style= "border-bottom:2px solid white;"><div class="cell" style="text-align: left;color: gray">نوع کالا :</div><div class="cell" >' . $ptype . '</div></div>
                                       <div class="row" style= "border-bottom:2px solid white;"><div class="cell" style="text-align: left;color: gray">موجودی :</div><div class="cell" >' . $row['inventory'] . ' عدد</div></div>
                                       <div class="row" style= "border-bottom:2px solid white;"><div class="cell" style="text-align: left;color: gray">قیمت :</div><div class="cell" >' . $price . '</div></div>         
                                  </div>
                              </div>
                           </div>      
                    </div>
            </div>
        </div>
            <div class="tbl" style="margin-right: 500px">
                <div class="row">
                    <div class="cell" >
                       <span style="align-items: center;color: #3e3e3e;font-size: 16px">تعداد </span>
                       <span style="margin-right: 10px"><input type="text" name="qty' . $row['productid'] . '" id="qty" value="1" class="product-qty2"></span>
                    </div>
                    <div class="cell" >';
            if($row['inventory']>0 ){
                echo'<span style="align-items: center"> <button type="submit" value="' . $row['productid'] . '" name="buybtn" class="btn17">افزودن به سبد خرید</button> </span>';}
            else {
                echo'<span style="align-items: center"> <button  class="btn19" >افزودن به سبد خرید</button> </span>';}
            echo '
                     </div>      
                </div>  
            </div>
            <div class="tbl" style="width: 800px;margin: 50px auto;border-radius: ">
                <hr style="width: 700px;height: 2px;color: white;background-color: white;border:none;margin-bottom: 50px">
                <div class="row" style="text-align: justify;line-height: 40px;margin-top: ">' . $row['comment'] . '</div>
            </div>
       
    </form>
    ';}

    }// ********* end function  ShowProductPage *********


}// ==================// END ShowProductClass //==================
?>