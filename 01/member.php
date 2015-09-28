<?
   include ("title.php");
   

if ($isfblogin=="Y")
{
?>
        <script language=javascript>
		document.location.href="index.php";
		</script>
<?	
	    exit;
}
	
$flag=carhow($_POST["flag"]);

if ($flag=="999")
{
	$zip=carhow($_POST["zip"]);	
	
	$sql="select * from tb_zipcode where zip='$zip'";
	$rs=mysql_query($sql);
	
	$row= mysql_fetch_array($rs);
	$city22=$row["country"];
	$town22=$row["town"];
	
	$pass=carhow($_POST["pass"]);
	$cname=carhow($_POST["cname"]);
	$nickname=carhow($_POST["nickname"]);
	
	$tel=carhow($_POST["tel"]);
	$mobile=carhow($_POST["mobile"]);
	$email=carhow($_POST["email"]);
	$addr=carhow($_POST["addr"]);
	$bdate=carhow($_POST["bdate"]);
}else{
	$sql= "select * from tb_member where cid = '$mycid'";		
	$rs=mysql_query($sql);
	$rowm = mysql_fetch_array($rs);
    
	$zip=carhow($rowm["zip"]);	
	$sql="select * from tb_zipcode where zip='$zip'";
	$rs=mysql_query($sql);
	
	$row= mysql_fetch_array($rs);
	$city22=$row["country"];
	$town22=$row["town"];
	$pass=carhow($rowm["pass"]);
	$cname=carhow($rowm["cname"]);
	$nickname=carhow($rowm["nickname"]);
	
	
	$tel=carhow($rowm["tel"]);
	$mobile=carhow($rowm["mobile"]);
	$email=carhow($rowm["email"]);
	$addr=carhow($rowm["addr"]);
	$bdate=carhow($rowm["birthday"]);
}

if ($bdate=="0000-00-00") $bdate="";
   ?>
            <div id="container">
                <div class="ind-menu">
                    <div class="menu-title">會員中心 /</div>
                    <ul class="menu-list">
                        <li><a href="member.php">密碼/資料修改</a>
                        </li>
                        <li><a href="order.php">訂單查詢</a>
                        </li>
                        <li><a href="logout.php">登出</a>
                        </li>
                    </ul>
                    <div id="side_bom"></div>
                   <? include ("ksdfhsdf.php");?> 
                </div>


                <form name="form1" method="post" action="member_ok.php">	
<input type="hidden" name="flag" value="999">
				
<script LANGUAGE="javascript">  
function Buildkey(nums) {
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
      <div class="contentpage">
      	<div class="page-title-r">密碼 | 資料修改 /</div>
        <div class="word">
        <div id="member">
	  <div class="login">
	    <div class="memberdata">
          <div class=" titlestyle02 b6">修改密碼</div>
	      <div class="block2">
	        <table border="0" align="center" cellpadding="0" cellspacing="0">
	          <tr>
	            <td width="70">原本密碼:</td>
	            <td  width="420"><input name="old_pass" type="password" class="text01" id="old_pass" value="<?=$pass;?>" /></td>
              </tr>
	          <tr>
	            <td>新密碼: </td>
	            <td><input name="pass" type="password" class="text01" id="pass" /></td>
              </tr>
	          <tr>
	            <td>新密碼確認: </td>
	            <td><input name="repass" type="password" class="text01" id="repass" /></td>
              </tr>
            </table>
	      </div>
          <div class=" titlestyle02 b6">修改基本資料</div>
          <div class="block2">
            <table border="0" align="center" cellpadding="0" cellspacing="0">
             <tr>
                <td width="70">姓　　名:</td>
                <td width="420"><input name="cname" id="cname" value="<?=$cname;?>" type="text" class="text01" /></td>
              </tr>
			  <tr>
                <td width="70">暱　　稱:</td>
                <td width="420"><input name="nickname" id="nickname" value="<?=$nickname;?>" type="text" class="text01" /></td>
              </tr>
			  
			  <tr>
                <td width="70">生　　日:</td>
                <td width="420">
			      <input name="bdate" type="text" id="bdate" size="10" value="<?=$bdate;?>" onclick="javascript:void(0);if(self.gfPop)gfPop.fPopCalendar(document.form1.bdate);return false;" style="font-family:arial;">　<a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.bdate);return false;" ><img class="PopcalTrigger" src="HelloWorld2/calbtn.gif" border=0></a>
			    </td>
		      </tr>
		  
              <tr>
                <td>電子郵件:</td>
                <td><?=$email;?></td>
              </tr>
              <tr>
                <td>手　　機:</td>
                <td><input name="mobile" id="mobile" value="<?=$mobile;?>" type="text" class="text01" /></td>
              </tr>
              <tr>
                <td>電　　話:</td>
                <td><input id="tel" name="tel" reqmsg="電話" type="text"  class="sss42" value="<?=$tel;?>" /></td>
              </tr>
              <tr>
                <td>地　　址:</td>
                <td>
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
                </select>
                <input name="addr" type="text" class="text03" id="addr" value="<?=$addr;?>" maxlength="200" /></td>
              </tr>
            </table>
          </div>
          <div class="blockcenter"> 
            <input type="button" class="btt2" onclick="javascript:check();" value="儲存修改" />　　<input type="reset" class="btt2" value="取　　消" />
          </div>
	    </div>
	  </div>
      <div style="clear:both"></div>
    </div>
      </div>
      </div>
      
       <input type=hidden name="zip" id="zip" size=5 value="<?=$zip;?>">
<script language=javascript>
		  <? if ($city!="") { ?>
       Buildkey("0_<?=$city;?>");
<? } ?>
		  function check(){
			 if (document.getElementById("pass").value!="")
			 {	
				 if (! (document.getElementById("pass").value.length>=4 && document.getElementById("pass").value.length<=10)){
					alert ("密碼請填入4至10個字元的英文字母、數字.");
					document.form1.pass.focus();
					return;
				 }
					
				 for (i=1;i<=document.getElementById("pass").value.length;i++){
					 a=document.getElementById("pass").value.substr(i-1,1);
					 b=a.charCodeAt(0);			 
					 if (! ((b>=65 && b<=90) || (b>=97 && b<=122) || (b>=48 && b<=57))){
						alert ("密碼必需為英文字母、數字的組合.");
						document.form1.pass.focus();
						return;
					 }
					 
				 }
				 
				 if (document.getElementById("repass").value==""){
					alert ("請輸入確認密碼.");
					document.form1.pass.focus();
					return;
				 }
				 
				 if (document.getElementById("pass").value!=document.getElementById("repass").value){
					alert ("新密碼必須和確認密碼一致.");
					document.form1.pass.focus();
					return;
				 }
			 }
			 if (document.getElementById("cname").value==""){
				alert ("請輸入姓名...");
				document.form1.cname.focus();
				return;
			 } 
			 if (document.getElementById("nickname").value==""){
				alert ("請輸入暱稱...");
				document.form1.nickname.focus();
				return;
			 } 
			 
			 if (document.getElementById("bdate").value==""){
					alert ("請選擇生日.");
					return;
				 }
			 if (document.getElementById("mobile").value==""){
				alert ("請輸入行動電話...");
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
			 
			 if (confirm("是否確定修改?")){
				document.form1.submit();	 
			 }
		 }
		 </script>
</form>	 





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
	
	<iframe width=174 height=189 name="gToday:normal:HelloWorld2/agenda.js" id="gToday:normal:HelloWorld2/agenda.js" src="HelloWorld2/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">   
</body>

</html>
