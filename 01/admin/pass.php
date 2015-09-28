<?include ("title.php"); ?>
<div  class="right">
  <div class="right01"> 帳號管理/系統設定</div>
  
<ul>
      
      <li>
	  <?
	  $sql="select * from tb_slogin";
$rs=mysql_query($sql);
$row = mysql_fetch_array($rs);
?>
<form name=form1 method=post action="pass_ok.php"><BR>

<table width=900 border='1' cellspacing='0' cellpadding='1' bordercolorlight='#006699' bordercolordark='#FFFFFF' align='center'>
<tr>
<td align=center bgcolor="#C9C9C9"><div align="center"><font color=black>後台登入帳號</font></div></td>
<td align=left><input type=text name="cid" id="cid" value="<?=$row["cid"];?>" size=90></td>
</tr>

<tr>
<td align=center bgcolor="#C9C9C9"><div align="center"><font color=black>後台登入密碼</font></div></td>
<td align=left><input type=password name="pass" id="pass" value="<?=$row["pass"];?>" size=90></td>
</tr>					

<tr>
<td align=center bgcolor="#C9C9C9"><div align="center"><font color=black>網站名稱</font></div></td>
<td align=left><input type=text name="wwwname" id="wwwname" value="<?=$row["wwwname"];?>" size=90></td>
</tr>					

<tr>
<td align=center bgcolor="#C9C9C9"><div align="center"><font color=black>寄件人顯示名稱</font></div></td>
<td align=left><input type=text name="cname" id="cname" value="<?=$row["cname"];?>" size=90></td>
</tr>

<tr>
<td align=center bgcolor="#C9C9C9"><div align="center"><font color=black>寄件人顯示Email</font></div></td>
<td align=left><input type=text name="email" id="email" value="<?=$row["email"];?>" size=90></td>
</tr>

<tr>
<td align=center bgcolor="#C9C9C9"><div align="center"><font color=black>網站網址</font><BR><font color=red><B>(最後一位不能為/)</B></font></div></td>
<td align=left><input type=text name="url" id="url" value="<?=$row["url"];?>" size=90></td>
</tr>

<tr>
<td align=center bgcolor="#C9C9C9"><div align="center"><font color=black>運費設定</font></B></font></div></td>
<td align=left>
	<font color=black>
	滿<input type=text name="fee11" id="fee11" value="<?=$row["fee11"];?>" size=10>元免運，
	未滿 + 運費<input type=text name="fee111" id="fee111" value="<?=$row["fee111"];?>" size=10>元

	<HR>
	<B>貨到付款加收手續費：</B><input type=text name="fee12" id="fee12" value="<?=$row["fee12"];?>" size=10>元<BR>

</font>
</td>
</tr>


<tr>
<td align=center bgcolor="#C9C9C9"><div align="center"><font color=black>貨到付款<BR>文字說明</font></B></font></div></td>
<td align=left><textarea name="paykind1" id="paykind1" cols=50 rows=6><?=str_replace("<BR>","\r\n",$row["paykind1"]);?></textarea></td>
</tr>

<tr>
<td align=center bgcolor="#C9C9C9"><div align="center"><font color=black>ATM轉帳<BR>文字說明</font></B></font></div></td>
<td align=left><textarea name="paykind2" id="paykind2" cols=50 rows=6><?=str_replace("<BR>","\r\n",$row["paykind2"]);?></textarea></td>
</tr>


<tr>
<td align=center bgcolor="#C9C9C9"><div align="center"><font color=black>銀行匯款<BR>文字說明</font></B></font></div></td>
<td align=left><textarea name="paykind3" id="paykind3" cols=50 rows=6><?=str_replace("<BR>","\r\n",$row["paykind3"]);?></textarea></td>
</tr>

<tr>
<td align=center bgcolor="#C9C9C9"><div align="center"><font color=black>門市取貨付款<BR>文字說明</font></B></font></div></td>
<td align=left><textarea name="paykind4" id="paykind4" cols=50 rows=6><?=str_replace("<BR>","\r\n",$row["paykind4"]);?></textarea></td>
</tr>

<tr><td align=center colspan=2><input name="cmdOK" type="button" value="送出" onclick="javascript:check();">　
<input type=reset value="重填"></td></tr>
</table>

<script language=javascript>
function check(){  

         cid=document.getElementById("cid").value;
         if (cid==""){
            alert ("請輸入帳號.");
            document.form1.cid.focus();
            return;
         }            

         if (document.getElementById("pass").value==""){
            alert ("請輸入密碼.");
            document.form1.pass.focus();
            return;
         }            

		 if (document.getElementById("wwwname").value==""){
            alert ("請輸入網站名稱.");
            document.form1.wwwname.focus();
            return;
         } 
		 
		 if (document.getElementById("cname").value==""){
            alert ("請輸入寄件人顯示名稱.");
            document.form1.cname.focus();
            return;
         } 
		 
		 if (document.getElementById("email").value==""){
            alert ("請輸入寄件人顯示Email.");
            document.form1.email.focus();
            return;
         } 
		 
		 if (document.getElementById("url").value==""){
            alert ("請輸入網站網址.");
            document.form1.url.focus();
            return;
         } 
		 
		 if (document.form1.url.value.toLowerCase().indexOf("http://")==-1) {
                alert ("網址必須包含http://");
			    document.form1.url.focus();
                return;
		 }
		 
		 if (document.form1.url.value.substring(document.form1.url.value.length, document.form1.url.value.length - 1)=="/"){
		        alert ("網址最後一位不能為 /");
			    document.form1.url.focus();
                return;
		 }

		
		 document.form1.submit();
}		 
</script>         
</form>
      </li> 
      
    </ul>
</div>
  <?include ("bottom.php"); ?>