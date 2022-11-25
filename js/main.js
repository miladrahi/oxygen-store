// JavaScript Document


    /*
    ======== function list ========

    regproductform
	editproductform
	form
	
    ================================
     */

/*================================================================
                    function regproductform
================================================================*/

function regproductform()
{
	var pname=document.getElementById('pname');
	var price=document.getElementById('price');
	var inventory=document.getElementById('inventory');
	var pimage=document.getElementById('pimage');

	var i=0;
//-------------------------------------------------		
	if(pname.value=="")
	{
		pname.style.backgroundColor="#ffcece";

        pnamemsg.innerHTML="لطفا نام کالا را وراد کنید";
		i++;
	}
	else
	{
		pname.style.backgroundColor="";
        pnamemsg.innerHTML="";
	}
	
//-------------------------------------------------		
	
	if(price.value=="")
	{
		price.style.backgroundColor="#ffcece";

        pricemsg.innerHTML="قیمت کالا را مشخص کنید";
		i++;
	
		
	}
	else
	{
		price.style.backgroundColor="";
        pricemsg.innerHTML="";
	}

//-------------------------------------------------		
	if(inventory.value=="")
	{
		inventory.style.backgroundColor="#ffcece";

        inventorymsg.innerHTML="موجودی کالا را اعلام کنید";
		i++;
	
		
	}
	else
	{
		inventory.style.backgroundColor="";
        inventorymsg.innerHTML="";
	}
//-------------------------------------------------		

	
	if(pimage.value=="")
	{
		pimage.style.backgroundColor="#ffcece";

        pimagemsg.innerHTML="یک عکس برای کالای مورد نظر انتخاب کنید";
		i++;
	
		
	}
	else
	{
		pimage.style.backgroundColor="";
        pimagemsg.innerHTML="";
	}
	
//-------------------------------------------------	

	
	if(i!=0)
		return false;
	
	
	
}// ********* end function  regproductform *********



/*================================================================
                    function editproductform
================================================================*/

function editproductform()
{
    var pname=document.getElementById('pname');
    var price=document.getElementById('price');
    var inventory=document.getElementById('inventory');


    var i=0;
//-------------------------------------------------
    if(pname.value=="")
    {
        pname.style.backgroundColor="#ffcece";

        pnamemsg.innerHTML="لطفا نام کالا را وراد کنید";
        i++;
    }
    else
    {
        pname.style.backgroundColor="";
        pnamemsg.innerHTML="";
    }

//-------------------------------------------------

    if(price.value=="")
    {
        price.style.backgroundColor="#ffcece";

        pricemsg.innerHTML="قیمت کالا را مشخص کنید";
        i++;


    }
    else
    {
        price.style.backgroundColor="";
        pricemsg.innerHTML="";
    }

//-------------------------------------------------
    if(inventory.value=="")
    {
        inventory.style.backgroundColor="#ffcece";

        inventorymsg.innerHTML="موجودی کالا را اعلام کنید";
        i++;


    }
    else
    {
        inventory.style.backgroundColor="";
        inventorymsg.innerHTML="";
    }
//-------------------------------------------------
    if (document.getElementById("eidtmsg"))
                eidtmsg.innerHTML='';

    if(i!=0){

        return false;
    }


}// ********* end function  editproductform *********

/*================================================================
                          function form
================================================================*/


function form()
{
    var fn=document.getElementById('firstname');
    var ln=document.getElementById('lastname');
    var user=document.getElementById('user');
    var email=document.getElementById('email');
    var pass1=document.getElementById('pass1');
    var pass2=document.getElementById('pass2');
    var address=document.getElementById('address');
    var postalcode=document.getElementById('postalcode');
    var tel=document.getElementById('tel');

    var i=0;
//-------------------------------------------------
    if(fn.value=="")
    {
        fn.style.backgroundColor="#ffcece";

        fnmsg.innerHTML="شما نام خود را وارد نکرده اید";
        i++;
    }
    else
    {
        fn.style.backgroundColor="";
        fnmsg.innerHTML="";
    }

//-------------------------------------------------

    if(ln.value=="")
    {
        ln.style.backgroundColor="#ffcece";

        lnmsg.innerHTML="شما نام خانوادگی خود را وارد نکرده اید";
        i++;


    }
    else
    {
        ln.style.backgroundColor="";
        lnmsg.innerHTML="";
    }

//-------------------------------------------------
    if(user.value=="")
    {
        user.style.backgroundColor="#ffcece";

        usermsg.innerHTML="ورود نام کاربری الزامی است";
        i++;


    }
    else
    {
        user.style.backgroundColor="";
        usermsg.innerHTML="";
    }

//-------------------------------------------------
    if(email.value=="")
    {
        email.style.backgroundColor="#ffcece";

        emailmsg.innerHTML="ایمیل خود را وارد کنید";
        i++;


    }
    else
    {
        email.style.backgroundColor="";
        emailmsg.innerHTML="";
    }


//-------------------------------------------------
    if(pass1.value=="")
    {
        pass1.style.backgroundColor="#ffcece";

        pass1msg.innerHTML="یک رمز عبور حداقل 8 رقمی وارد کنید";

        i++;

    }

//-------------------------------------------------
    else if(pass1.value.length<8)
    {
        pass1.style.backgroundColor="#ffcece";

        pass1msg.innerHTML="پسورد شما حداقل باید 8 کارکتر باشد";

        i++;

    }

//-------------------------------------------------
    else if(pass1.value!=pass2.value)
    {
        pass1.style.backgroundColor="#ffcece";


        pass1msg.innerHTML="پسور شما با تکرار آن برابر نیست";

        i++;

    }
    else
    {
        pass1.style.backgroundColor="";
        pass1msg.innerHTML="";
    }
//-------------------------------------------------

    if(pass2.value=="")
    {
        pass2.style.backgroundColor="#ffcece";

        pass2msg.innerHTML="ورود تکرار رمز عبور الزامی است";

        i++;

    }
    else
    {
        pass2.style.backgroundColor="";
        pass2msg.innerHTML="";
    }

    //-------------------------------------------------
    if(address.value=="")
    {
        address.style.backgroundColor="#ffcece";

        addressmsg.innerHTML="آدرس خود خود را وارد کنید";
        i++;


    }
    else
    {
        address.style.backgroundColor="";
        addressmsg.innerHTML="";
    }

    //-------------------------------------------------
    if(postalcode.value=="")
    {
        postalcode.style.backgroundColor="#ffcece";

        postmsg.innerHTML="کدپستی خود را وارد کنید";
        i++;


    }
    else
    {
        postalcode.style.backgroundColor="";
        postmsg.innerHTML="";
    }


//-------------------------------------------------
    if(tel.value=="")
    {
        tel.style.backgroundColor="#ffcece";

        telmsg.innerHTML="شماره تلفن خود را وارد کنید";
        i++;


    }
    else
    {
        tel.style.backgroundColor="";
        telmsg.innerHTML="";
    }
//---------------------------------------------------

    if (document.getElementById("regmsg"))
        regmsg.innerHTML='';

    if (document.getElementById("msgerror1"))
        msgerror1.innerHTML='';

    if (document.getElementById("msgerror2"))
        msgerror2.innerHTML='';


    if(i!=0)
        return false;

}// ********* end function  form *********

