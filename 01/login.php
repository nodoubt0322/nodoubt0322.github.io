<?
   include ("title.php");
   
if ($islogin=="Y")
 {
 ?>
	 <script language=javascript>
			document.location.href="member.php";
	 </script>
 <?
	exit;
 }
 
 $sel="";
 $u="";
 $p="";
 $uu="";
 
 if ($_COOKIE["nod_cookie_autologin"]=="Y")
 {
   $sel=" checked";
   $u=$_COOKIE["nod_cookie_cid"];
   $p=$_COOKIE["nod_cookie_pass"];	
 }
   ?>
   <div id="container">
      <div class="contentpage-c">
      	<h2 class="titlestyle">會員中心 /</h2>
        <div class="word">
        <div id="member">
	  <div class="login">
        <div class="memberlogin">
          <div class="titlestyle-s">
            <span class="title">會員登入 / <span class="titleE"> Login</span></span>
          </div>
		  <form name="loginforms" action="login_check.php" method="post">	
          <div class=" titlestyle02 b6">請先登入會員帳號即可開始結帳</div>
          <div class="block">電子郵件: 
            <input name="cid2" type="text" class="text01" id="cid2" value="<?=$u;?>" />
          </div>
          <div class="block">密　　碼: 
            <input name="pass2" type="password" class="text01" id="pass2" value="<?=$p;?>"  />
          </div>
          <div class="block">記住帳號
            <input name="autologin" type="checkbox" value="autologin" value="Y"<?=$sel;?> />
          | <a href="forgetpass.php">忘記密碼</a></div>
          <div class="block t8"> 
            <input name="button2" type="submit" class="btt2" id="button2" value="送出" onclick="javascript:checkqq();" />
          </div>
          <script language="javascript">
		function checkqq()
		{
		            if (document.getElementById("cid2").value==""){
						alert ("請輸入帳號.");
						document.loginforms.cid2.focus();
						return;
					}
					 
					 if (document.getElementById("pass2").value==""){
						alert ("請輸入密碼.");
						document.loginforms.pass2.focus();
						return;
					}		                     
					document.forms['loginforms'].submit();
		}
		</script>
		</form>
          <div class="block t8"><img src="images/or.png" width="200" height="24" /></div>
          
          <div class="block t8">
		  <? if ($ip=="220.133.44.52") { ?>
		         <a href="facebook2/index.php"><img src="images/fb.png" width="220" height="45" border=0 /></a>
		  <? } ?>
		  </div>
          
          
        </div>
        <div class="joinmember">
          <div class="titlestyle-s">
            <span class="title">加入會員 / <span class="titleE"> Join</span></span>
          </div>
<form name="form1" action="join_ok.php" method="post">	
<script LANGUAGE="javascript">  
function Buildkey(nums) {
//alert (nums);
    p=nums.split("_");
	kind=p[0];
	num=p[1];
	var ctr=1;
	document.form1.subtype.selectedIndex=0;
	if (kind=="1") document.form1.zip.value="";  
	document.form1.subtype.options[0]=new Option("請選擇區域...","");

<? 

$s=explode(",","台北市,新北市,基隆市,桃園市,新竹市,新竹縣,苗栗縣,台中市,彰化縣,南投縣,雲林縣,嘉義市,嘉義縣,".
           "台南市,高雄市,屏東縣,宜蘭縣,花蓮縣,台東縣,澎湖縣,金門縣,連江縣");
   $ccc="";
   for ($i=0;$i<sizeOf($s);$i++){
         $citys=$s[$i];
		 if ($city22!=""){
		     if ($citys==$city22) $city=$i+1;
		 }
         $sql="select * from tb_zipcode where country='$citys' order by zip";
         $rs=mysql_query($sql);
         $ii=1;
		 
         while ($row= mysql_fetch_array($rs)){
             $ii++;
             if ($zip!=""){
                if ((int)$row["zip"]==(int)$zip) {
				    $ccc=$ii;
				}	
             }
?>	
	         if(num=="<?=$i+1;?>") {document.form1.subtype.options[ctr]=new Option("<?=$row["town"];?>","<?=$row["zip"];?>");ctr=ctr+1;}
<?       }
   } 
?>	

	document.form1.subtype.length=ctr;
	
	if (kind=="1"){
   	       document.form1.subtype.options[0].selected=true;
	}else{
         document.form1.subtype.options[<?=$ccc-1;?>].selected=true;
	}
} 

</script> 
<?
$pass=carhow($_POST["pass"]);
$cname=carhow($_POST["cname"]);
$nickname=carhow($_POST["nickname"]);

$email=carhow($_POST["email"]);
$mobile=carhow($_POST["mobile"]);

$zip=carhow($_POST["zip"]);	
	
if ($zip!="")
{	
	$sql="select * from tb_zipcode where zip='$zip'";
	$rs=mysql_query($sql);
	
	$row= mysql_fetch_array($rs);
	$city22=$row["country"];
	$town22=$row["town"];
}	
?>			  
          <div class=" titlestyle02 b6">如果您是第一次來請先加入會員喔!</div>
          <div class="block">電子郵件: 
            <input name="email" type="text" class="text01" id="email" value="<?=$email;?>" />
          </div>
          <div class="block">密　　碼: 
            <input name="pass" type="password" class="text01" id="pass" value="<?=$pass;?>" />
          </div>
          <div class="block2">密碼確認: 
            <input name="repass" type="password" class="text01" id="repass" value="<?=$pass;?>" />
          </div>
          <div class=" titlestyle02 b6">基本資料</div>
          <div class="block">姓　　名:  
            <input name="cname" type="text" class="text01" id="cname" value="<?=$cname;?>" />
          </div>
          <div class="block">暱　　稱:  
            <input name="nickname" type="text" class="text01" id="nickname" value="<?=$nickname;?>" />
          </div>
		  
		  <div class="block" style="text-align:left;">　　生　　日:
          <input name="bdate" type="text" id="bdate" size="10" value="<?=$bdate;?>" onclick="javascript:void(0);if(self.gfPop)gfPop.fPopCalendar(document.form1.bdate);return false;" style="font-family:arial;">　<a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.bdate);return false;" ><img class="PopcalTrigger" src="HelloWorld2/calbtn.gif" border=0></a>
          </div>
		  
		  <div class="block">手　　機: 
            <input name="mobile" type="text" class="text01" id="mobile" value="<?=$mobile;?>" />
          </div>
          
          <div class="block">地　　址: 
		  <select name="city" class="text02" id="city" onChange="Buildkey('1_'+this.options[this.options.selectedIndex].value);">
                  <option value="">-選擇縣市-</option>
                  <? for ($i=0;$i<sizeOf($s);$i++){ 
		        $sel="";
				if ($city!=""){
				    if ((int)$city==$i+1) $sel=" selected";
				}
		?>
                  <option value="<?=$i+1;?>"<?=$sel;?>>
                    <?=$s[$i];?>
                    </option>
                  <? } ?>
                </select>
                  <select name="subtype" class="text02" id="subtype" onChange="document.form1.zip.value=this.options[this.options.selectedIndex].value;">
                    <option value="">-選擇區域-</option>
                </select><BR>
            <input name="addr" type="text" class="text01" id="addr" value="<?=$addr;?>" maxlength="200" />
			<input type=hidden name="zip" id="zip" size=5 value="<?=$zip;?>">
          </div>
          <div class="block t8"> 
		  
            <input type="button" class="btt2" value="加入會員" onclick="javascript:check();" />
          </div>
          <div class="block"> 
            如有會員資料異動，請隨時至會員中心修改更新唷
          </div>
        </div>
	  </div>
<script language=javascript>
 <? if ($city!="") { ?>
       Buildkey("0_<?=$city;?>");
<? } ?>
		function check(){
				  if (document.getElementById("email").value==""){
					alert ("請輸入E-mail...");
					document.form1.email.focus();
					return;
				 }

				 if ((document.getElementById("email").value.length<=5) || (document.getElementById("email").value.indexOf("@")<0) || (document.getElementById("email").value.indexOf(".")<0)){
					alert ("請輸入正確的E-mail...");
					document.form1.email.focus();
					return;
				 }
				 
				 if (document.getElementById("pass").value==""){
					alert ("請輸入密碼.");
					document.form1.pass.focus();
					return;
				 }	

                 if (document.getElementById("repass").value==""){
					alert ("請輸入密碼確認.");
					document.form1.repass.focus();
					return;
				 }					 
				
				 if (document.getElementById("pass").value!=document.getElementById("repass").value){
					alert ("密碼確認與設定的密碼不一致.");
					document.form1.repass.focus();
					return;
				 }
				 
				  if (document.getElementById("cname").value==""){
					alert ("請輸入姓名.");
					document.form1.cname.focus();
					return;
				 }
				 if (document.getElementById("nickname").value==""){
					alert ("請輸入暱稱.");
					document.form1.nickname.focus();
					return;
				 }
				if (document.getElementById("bdate").value==""){
					alert ("請選擇生日.");
					return;
				 }
			     if (document.getElementById("mobile").value==""){
					alert ("請輸入手機.");
					document.form1.mobile.focus();
					return;
				 }
				 if(document.getElementById("city").options[0].selected) {
				alert('請選擇縣市');
				return;
			 }
		   
	         if(document.getElementById("city").value!="5" && document.getElementById("city").value!="12")
			 {
			   
				 if(document.getElementById("subtype").options[0].selected) {
					alert('請選擇區域');
					return;
				}
			 }
			 
			 if(document.getElementById("city").value=="5")  document.getElementById("zip").value="300";
			 if(document.getElementById("city").value=="12")  document.getElementById("zip").value="600";
		
             if (document.getElementById("addr").value==""){
				alert ("請輸入地址...");
				document.form1.addr.focus();
				return;
			 }
				 
				 if (confirm("是否確定送出?")){
					document.form1.submit();	 
				 }	
		}
		</script>
		
		
</form>	  
      <div style="clear:both"></div>
    </div>
      </div>
      <div style="clear:both"></div>
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
<script src="js/totop/js/jquery.ui.totop.js" type="text/javascript" ></script>
<!-- <script src="js/totop/js/easing.js" type="text/javascript" ></script> -->
<script src="js/goodchange.js" type="text/javascript" ></script> <!-- 選單js -->
<script src="js/jqbanner/rotatingbanner.js" type="text/javascript"></script><!-- banner輪轉js -->
<script src="js/slick.min.js" type="text/javascript"></script><!-- 熱門商品js --> 
<script src="js/main.js"></script>
<iframe width=174 height=189 name="gToday:normal:HelloWorld2/agenda.js" id="gToday:normal:HelloWorld2/agenda.js" src="HelloWorld2/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">   
</body>
</html>