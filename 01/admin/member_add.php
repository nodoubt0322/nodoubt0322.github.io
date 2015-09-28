<? include ("session.php"); 
   include ("title.php");
   ?>
<div  class="right">
  <div class="right01"> 新增會員</div>
  
<ul>
      
      <li>
<?
   
   $keys=$_POST["keys"];
   
   if ($keys=="") $keys=$_GET["keys"];
   
   $srhdate1=$_POST["srhdate1"];
   if ($srhdate1=="") $srhdate1=$_GET["srhdate1"];
   
   $srhdate2=$_POST["srhdate2"];
   if ($srhdate2=="") $srhdate2=$_GET["srhdate2"];
   
   $srhlevel=$_POST["srhlevel"];
   if ($srhlevel=="") $srhlevel=$_GET["srhlevel"];
   
   $srhstatus=$_POST["srhstatus"];
   if ($srhstatus=="") $srhstatus=$_GET["srhstatus"];
   
   $srhtime1=$_POST["srhtime1"];
   if ($srhtime1=="") $srhtime1=$_GET["srhtime1"];
   
   $srhtime2=$_POST["srhtime2"];
   if ($srhtime2=="") $srhtime2=$_GET["srhtime2"];
   
	$page=$_GET["page"];
	$page2=$_GET["page2"];
	$id=$_GET["id"];
	
	if ($cid=="") $cid=$_POST["cid"];
	if ($page=="") $page=$_POST["page"];
	if ($page2=="") $page2=$_POST["page2"];
	
?>
<form name="form1" method="post" action="member_add_ok.php">	
<input type="hidden" name="flag" value="999">				
<?
$pass=carhow($_POST["pass"]);
$cname=carhow($_POST["cname"]);
$nickname=carhow($_POST["nickname"]);
$sex=carhow($_POST["sex"]);
$email=carhow($_POST["email"]);

$zip=carhow($_POST["zip"]);
$city=carhow($_POST["city"]);
$town=carhow($_POST["subtype"]);
$addr=carhow($_POST["addr"]);

$tel=carhow($_POST["tel"]);
$mobile=carhow($_POST["mobile"]);			
?>
<script LANGUAGE="javascript">  
function Buildkey(num) {
	var ctr=1;
	document.form1.subtype.selectedIndex=0;
	document.form1.zip.value="";  
	document.form1.subtype.options[0]=new Option("請選擇區域...","");

<? 

$s=explode(",","台北市,新北市,基隆市,桃園市,新竹市,新竹縣,苗栗縣,台中市,彰化縣,南投縣,雲林縣,嘉義市,嘉義縣,".
           "台南市,高雄市,屏東縣,宜蘭縣,花蓮縣,台東縣,澎湖縣,金門縣,連江縣");
   $ccc="";
   for ($i=0;$i<sizeOf($s);$i++){
         $citys=$s[$i];
         $sql="select * from tb_zipcode where country='$citys' order by zip";
         $rs=mysql_query($sql);
         $ii=1;
		 
         while ($row= mysql_fetch_array($rs)){
             $ii++;
             if ($zip!=""){
                if ((int)$row["zip"]==(int)$zip) $ccc=$ii;
             }
?>	
	         if(num=="<?=$i+1;?>") {document.form1.subtype.options[ctr]=new Option("<?=$row["town"];?>","<?=$row["zip"];?>");ctr=ctr+1;}
<?       }
   } 
?>	

	document.form1.subtype.length=ctr;
	
	<? if ($zip==""){ ?>
	       document.form1.subtype.options[0].selected=true;
	<? }else{ ?>
           document.form1.subtype.options[<?=$ccc-1;?>].selected=true;
	<? } ?>
} 

</script> 

<input type="hidden" name="keys" value="<?=$keys;?>">

<input type="hidden" name="srhdate1" value="<?=$srhdate1;?>">
<input type="hidden" name="srhdate2" value="<?=$srhdate2;?>">
<input type="hidden" name="srhlevel" value="<?=$srhlevel;?>">
<input type="hidden" name="srhstatus" value="<?=$srhstatus;?>">
<input type="hidden" name="srhtime1" value="<?=$srhtime1;?>">
<input type="hidden" name="srhtime2" value="<?=$srhtime2;?>">

<input type="hidden" name="page" value="<?=$page;?>">
<input type="hidden" name="page2" value="<?=$page2;?>">

<center>
 <TABLE cellSpacing=0 cellPadding=0 width="900" style="color:black;" align=center border=1>

              <TBODY>

			    <TR>

                <TD height=15 align="left"  bgcolor="#cccccc">帳號/電子郵件</TD>

                <TD align="left"><input class=fillForm type="text" name="cid" id="cid" value="<?=$cid;?>"></TD>

                </TR>
				
              <TR>

                <TD height=15 align="left"  bgcolor="#cccccc">姓名</TD>

                <TD align="left"><input class=fillForm type="text" name="cname" id="cname" value="<?=$cname;?>"></TD>

                </TR>
				
				<TR>

                <TD height=15 align="left"  bgcolor="#cccccc">暱稱</TD>

                <TD align="left"><input class=fillForm type="text" name="nickname" id="nickname" value="<?=$nickname;?>"></TD>

                </TR>

              <TR>

                <TD height=15 align="left"  bgcolor="#cccccc">密碼</TD>

                <TD align="left"><input class=fillForm type="password" name="pass" id="pass" value="<?=$pass;?>"></TD>

                </TR>

              <TR>

                <TD height=15 align="left"  bgcolor="#cccccc">密碼確認</TD>

                <TD align="left"><input class=fillForm type="password" name="repass" id="repass" value="<?=$pass;?>"></TD>

                </TR>

              <TR id=rowTelephone height=30>

                <TD height=15 align="left"  bgcolor="#cccccc"><SPAN

                  id=spTelephoneTitle>電話</SPAN></TD>

                <TD height="30" align="left">
				<input class=fillForm type="text" name="tel" id="tel" value="<?=$tel;?>"></TD>
</TR>

               <TR id=rowTelephone height=30>

                <TD height=15 align="left"  bgcolor="#cccccc"><SPAN

                  id=spTelephoneTitle>手機</SPAN></TD>

                <TD height="30" align="left">
				<input class=fillForm type="text" name="mobile" id="mobile" value="<?=$mobile;?>"></TD>
</TR>

<TR id=rowAddress height=30>

                <TD height="15" align="left"  bgcolor="#cccccc">地址</TD>

                <TD colSpan=2 align="left">

				<select name="city" id="city" size="1" onchange="Buildkey(this.options[this.options.selectedIndex].value);">
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
							  <select name="subtype" id="subtype" size="1" onchange="document.form1.zip.value=this.options[this.options.selectedIndex].value;">
								<option value="">-選擇區域-</option>
							  </select>
							  <input name="addr" type="text" id="addr" value="<?=$addr;?>" maxlength="200" class=fillForm style="WIDTH: 250px" />
							  </TD></TR>

              
	 
          
		<? 
			$sel1="";
			$sel2="";
			if ($status=="Y") $sel1=" checked"; 
			if ($status=="N") $sel2=" checked"; 
			?>
       <tr><td align=left bgcolor="#cccccc">狀態:</td><td colSpan=2 align=left>
<input type="radio" name="status" id="status" value="Y"<?=$sel1;?>>正常
<input type="radio" name="status" id="status" value="N"<?=$sel2;?>><font color=red>未認證</font>
    </td></tr>   
            
			
       <tr><td align=center colspan=4>
         <input type="button" value="確定新增" onclick="javascript:check();" />　         
		 <input type="button" onclick="location.replace('member.php?srhdate1=<?=$srhdate1;?>&srhdate2=<?=$srhdate2;?>&srhlevel=<?=$srhlevel;?>&srhstatus=<?=$srhstatus;?>&srhtime1=<?=$srhtime1;?>&srhtime2=<?=$srhtime2;?>&keys=<?=$keys;?>&page=<?=$page;?>&page2=<?=$page2;?>')" value="回首頁" />
       
</td></tr>
</table>  
<input type=hidden name="zip" id="zip" size=5 value="<?=$zip;?>">
<script language=javascript>
		  <? if ($city!="") { ?>
				   Buildkey("<?=$city;?>");
		  <? } ?>
		  function check()
		  { 
                     if (document.getElementById("cid").value==""){
						alert ("請輸入帳號...");
						document.form1.cid.focus();
						return;
					 } 
					 if ((document.getElementById("cid").value.length<=5) || (document.getElementById("cid").value.indexOf("@")<0) || (document.getElementById("cid").value.indexOf(".")<0)){
						alert ("請輸入正確的E-mail...");
						document.form1.cid.focus();
						return;
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
					 
                     if (document.getElementById("pass").value==""){
						alert ("請輸入密碼.");
						document.form1.pass.focus();
						return;
					 }            
							
					 if (! (document.getElementById("pass").value.length>=4 && document.getElementById("pass").value.length<=20)){
						alert ("密碼請填入4至20個字元的英文字母、數字.");
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
						alert ("請輸入密碼確認.");
						document.form1.repass.focus();
						return;
					 } 	

                     if (document.getElementById("pass").value!=document.getElementById("repass").value){
						alert ("密碼必須和密碼確認一致.");
						document.form1.repass.focus();
						return;
					 } 
  
                     if (document.getElementById("tel").value==""){
						alert ("請輸入電話...");
						document.form1.tel.focus();
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
						alert ("請輸入住址...");
						document.form1.addr.focus();
						return;
					 }	

		 if (document.form1.status[0].checked==false && document.form1.status[1].checked==false)
		 {
		     alert ("請選擇狀態...");
             return;
		 }
		 
         if (confirm("是否確定新增?")){
            document.form1.submit();	 
         }
         
}
</script> 
</form>
</td>
</tr>
</table>
 </li> 
      
    </ul>
  </div>
  <?include ("bottom.php"); ?>