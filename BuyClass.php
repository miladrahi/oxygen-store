<?php
class BuyClass
{
    /*
       ======== function list ========

       BuyProduct
       ShowMSG

       ================================
        */


// Properties
    var $link;

// Constructor
    function BuyClass(){
        $this->link = mysqli_connect("localhost", "root", "", "oxygen");
    }


    /*================================================================================
  \                          function BuyProduct                                   \
  ================================================================================*/

	function BuyProduct()
	{
			if(isset($_POST['buybtn']))
		{

            $id=$_POST['buybtn'];

			if(isset($_SESSION['p'.$id]))
				$_SESSION['p'.$id]+=$_POST['qty'.$id];
			else
				$_SESSION['p'.$id]=$_POST['qty'.$id];

			
		}
	}// ********* end function  BuyProduct *********


    /*================================================================================
  \                          function ShowMSG                                   \
  ================================================================================*/
	
	function ShowMSG()
	{
		if(isset($_POST['buybtn']))
		{
			$id=$_POST['buybtn'];
			$sql="SELECT `pname` FROM `product` WHERE productid='$id'";
			$result=mysqli_query($this->link,$sql) or die();
			$row=mysqli_fetch_assoc($result);

            echo "<p class='msgok'>"."کالای مورد نظر با نام ".$row['pname']." به سبد خرید شما اضافه شد "."</p>";
			
		}
	}// ********* end function  ShowMSG *********

}// ==================// END BuyClass //==================
?>