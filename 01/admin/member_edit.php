<? include ("session.php"); 
   include ("title.php");
   ?>
<div  class="right">
  <div class="right01"> 會員修改</div>
  
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
<form name="form1" method="post" action="member_edit_ok.php">	
<input type="hidden" name="flag" value="999">				
<?
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
	$sex=carhow($_POST["sex"]);
	$tel=carhow($_POST["tel"]);
	$mobile=carhow($_POST["mobile"]);
	$email=carhow($_POST["email"]);
	$addr=carhow($_POST["addr"]);
	
	$status=carhow($_POST["status"]);
}else{
	$sql= "select * from tb_member where id = $id";		
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
	
	$sex=carhow($rowm["sex"]);
	$tel=carhow($rowm["tel"]);
	$mobile=carhow($rowm["mobile"]);
	$email=carhow($rowm["email"]);
	$addr=carhow($rowm["addr"]);
	
	$status=carhow($rowm["status"]);
}
         		//echo $city22."<BR>";
				//echo $town22."<BR>";

    $sql3= "select * from tb_member where id = $id";		
	$rs3=mysql_query($sql3);
	$row3 = mysql_fetch_array($rs3);
	$cid=$row3["cid"];				
?>
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
<input type="hidden" name="old_email" value="<?=$email;?>">
<input type="hidden" name="id" value="<?=$id;?>">
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
<table border=1 align=center style="color:black;" width="900">
<tr><td align=left bgcolor="#cccccc">登入帳號:</td><td align=left>
  <?=$cid;?>
</td></tr>

<tr><td align=left bgcolor="#cccccc">密碼:</td><td align=left>
  <input type="text" name="pass" id="pass" value="<?=$pass;?>" style="width:290px; color:#000; background-color:#efefef;"/>
</td></tr>
<tr><td align=left bgcolor="#cccccc">姓名:</td><td align=left>
            <input type="text" name="cname" id="cname" value="<?=$cname;?>" style="width:290px; color:#000; background-color:#efefef;"/> 
            
<tr><td align=left bgcolor="#cccccc">暱稱:</td><td align=left>
  <input type="text" name="nickname" id="nickname" value="<?=$nickname;?>" style="width:290px; color:#000; background-color:#efefef;"/>
</td></tr>
      <tr><td align=left bgcolor="#cccccc">住址:</td><td align=left>
            <select name=city id=city size=1 class="style11" onChange="Buildkey('1_'+this.options[this.options.selectedIndex].value);">
	    <option value="">-選擇縣市-</option>
		<? for ($i=0;$i<sizeOf($s);$i++){ 
		        $sel="";
				if ($city!=""){
				    if ((int)$city==$i+1) $sel=" selected";
				}
		?>
	    <option value="<?=$i+1;?>"<?=$sel;?>><?=$s[$i];?></option>
	    <? } ?>
	    </select>
		<select name=subtype id=subtype class="style11" size=1 onChange="document.form1.zip.value=this.options[this.options.selectedIndex].value;">
	    <option value="">-選擇區域-</option>
   	    </select>	
              <input name="addr" type="text" class="style11" id="addr" value="<?=$addr;?>" maxlength="200" style="width:260px; color:#000; background-color:#efefef;"/>
      <input type=hidden name="zip" id="zip" size=5 value="<?=$zip;?>">
</td></tr>
          
		  <tr><td align=left bgcolor="#cccccc">電話:</td><td align=left>
            <input type="text" name="tel" id="tel" value="<?=$tel;?>" style="width:290px; color:#000; background-color:#efefef; " />
          </td></tr>
		  <tr><td align=left bgcolor="#cccccc">手機:</td><td align=left>
            <input type="text" name="mobile" id="mobile" value="<?=$mobile;?>" style="width:290px; color:#000; background-color:#efefef; " />
          </td></tr>
         
	 
	
          <tr><td align=left bgcolor="#cccccc">註冊時間:</td><td align=left>
            <?=$row3["reg_time"];?>
          </td></tr>
		  
		  <tr><td align=left bgcolor="#cccccc">註冊確認時間:</td><td align=left>
            <?=str_replace("0000-00-00 00:00:00","未確認",$row3["confirm_time"]);?>
          </td></tr>
		  
		  <tr><td align=left bgcolor="#cccccc">最後登入時間:</td><td align=left>
            <?=str_replace("0000-00-00 00:00:00","未登入",$row3["last_login"]);?>
          </td></tr>
		  
		  
		<? 
			$sel1="";
			$sel2="";
			if ($status=="Y") $sel1=" checked"; 
			if ($status=="N") $sel2=" checked"; 
			?>
       <tr><td align=left bgcolor="#cccccc">狀態:</td><td align=left>
<input type="radio" name="status" id="status" value="Y"<?=$sel1;?>>正常
<input type="radio" name="status" id="status" value="N"<?=$sel2;?>><font color=red>未認證</font>
    </td></tr>   
            
			
       <tr><td align=center colspan=2>
         <input type="button" value="確定修改" onclick="javascript:check();" />　
         <input type="button" onclick="location.replace('member_edit.php?id=<?=$id;?>&srhdate1=<?=$srhdate1;?>&srhdate2=<?=$srhdate2;?>&srhlevel=<?=$srhlevel;?>&srhstatus=<?=$srhstatus;?>&srhtime1=<?=$srhtime1;?>&srhtime2=<?=$srhtime2;?>&keys=<?=$keys;?>&cid=<?=$cid;?>&page=<?=$page;?>&page2=<?=$page2;?>')" value="恢復" />　
		 <input type="button" onclick="location.replace('member.php?srhdate1=<?=$srhdate1;?>&srhdate2=<?=$srhdate2;?>&srhlevel=<?=$srhlevel;?>&srhstatus=<?=$srhstatus;?>&srhtime1=<?=$srhtime1;?>&srhtime2=<?=$srhtime2;?>&keys=<?=$keys;?>&page=<?=$page;?>&page2=<?=$page2;?>')" value="回首頁" />
       
</td></tr>
</table>  

<script language=javascript>
<? if ($city!="") { ?>
       Buildkey("0_<?=$city;?>");
<? } ?>

function check(){
         
         if (document.getElementById("pass").value==""){
            alert ("請輸入密碼.");
            document.form1.pass.focus();
            return;
         }            
                
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
		
		                                         	
         if (document.getElementById("tel").value=="" && document.getElementById("mobile").value==""){
				alert ("請輸入電話或手機...");
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
		 
         if (document.getElementById("addr").value.length<5){
            alert ("請輸入完整的住址...");
            document.form1.addr.focus();
            return;
         }	
		 
         if (confirm("是否確定修改?")){
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