<?
   include ("title.php");
   ?>
            <div id="container">
                <div class="ind-menu">
                    <div class="menu-title">聯絡我們 /</div>
                    <ul class="menu-list">
                        <li><a href="#">聯絡我們</a>
                        </li>
                        <li></li>
                    </ul>
                    <div id="side_bom"></div>
                    <? include ("ksdfhsdf.php"); ?> 
                </div>


                <div class="contentpage">
                    <div class="page-title-r inside-page">聯絡我們 /</div>
                    <div class="word">
                        <div class="contacts">
                            <div class="formBox">
                                <!--formBox-->
                                <form name="form1" method="post" action="contacts_ok.php">
 <div class="form">
 <label for="cname" class="leftside"><em>※</em>尊姓大名</label>
 <input type="text" id="cname" name="cname">
 </div>
  
 <div class="form">
 <label for="mobile" class="leftside"><em>※</em>行動電話</label>
 <input type="text" id="mobile" name="mobile">
 </div>                    
                    
 <div class="form">
 <label for="email" class="leftside"><em>※</em>電子信箱</label>
 <input type="text" id="email" name="email">
 </div>
 <div class="form">
 <label for="memo" class="leftside"><em>※</em>需求說明</label>
 <textarea id="memo" name="memo" cols="45" rows="7"></textarea>
 </div>
                    
 <div class="form">
 <label for="email" class="leftside"><em>※</em>驗證碼</label>
 <?
		  srand((double)microtime()*10000);
		   while(($authnum=rand()%10000)<1000);  
           $_SESSION["bowchan_contact_code"]=$authnum;
		   ?>
 <input name="CAPTCHA" type="text" id="CAPTCHA" style="width:80px;" />
	<img src="submit_check.php?authnum=<?=$authnum;?>" />
 </div>
    
                    
            <!--驗證區-->
            
                                
                    <!--送出按鈕--> 
 <div class="btn">
 <a style="cursor:pointer" href="javascript:check();">確認送出</a>
 <a style="cursor:pointer" href="contacts.php">清除重填</a>
 </div>
<script language=javascript>
function check(){
		 if (document.form1.cname.value==""){
            alert ("請輸入尊姓大名.");
            document.form1.cname.focus();
            return;
         } 
          if (document.getElementById("mobile").value==""){
		alert ("請輸入行動電話...");
				document.form1.mobile.focus();
				return;
         }
         if (document.form1.email.value==""){
            alert ("請輸入電子信箱.");
            document.form1.email.focus();
            return;
         }
		 
		 if ((document.form1.email.value.length<=5) || (document.form1.email.value.indexOf("@")<0) || (document.form1.email.value.indexOf(".")<0)){
            alert ("請輸入正確的電子信箱.");
            document.form1.email.focus();
            return;
         }
		
       if (document.form1.memo.value==""){
            alert ("請輸入需求說明.");
            document.form1.memo.focus();
            return;
         } 			 
		 if (document.form1.memo.value.length>500){
            alert ("需求說明限制為500字.");
            document.form1.memo.focus();
            return;
         } 
		if (document.form1.CAPTCHA.value==""){
				alert ("請輸入驗證碼.");
				document.form1.CAPTCHA.focus();
				return;
			 } 		 		 
			 
			 if (document.form1.CAPTCHA.value!="<?=$authnum;?>"){
				alert ("驗證碼輸入錯誤.");
				document.form1.CAPTCHA.focus();
				return;
			 }
         if (confirm("是否確定送出?")){
            document.form1.submit();		 
         }
    		 			 
}
</script>     


 </form>
                            </div>
                            <!--formBox end-->
                        </div>
                    </div>
                </div>





            </div>
        </div>
    </div>



    </div>
   <?
   include ("bottom.php");
   ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script> -->
    <script src="js/totop/js/jquery.ui.totop.js" type="text/javascript"></script>
    <!-- <script src="js/totop/js/easing.js" type="text/javascript" ></script> -->
    <script src="js/goodchange.js" type="text/javascript"></script>
    <!-- 選單js -->
    <script src="js/jqbanner/rotatingbanner.js" type="text/javascript"></script>
    <!-- banner輪轉js -->
    <script src="js/slick.min.js" type="text/javascript"></script>
    <!-- 熱門商品js -->
    <script src="js/main.js"></script>
</body>

</html>
