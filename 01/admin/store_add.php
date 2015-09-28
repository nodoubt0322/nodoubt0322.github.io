<?include ("title.php"); 
?>
<div  class="right">
  <div class="right01"> 新增到店取貨門市</div>
  
<ul>
      
      <li>
<form name=form1 method=post action="store_add_ok.php">

<table width=950 border="0">
    <tr>
      <td align=center><BR>
<table width=950 border='1' cellspacing='0' cellpadding='1' bordercolorlight='#006699' bordercolordark='#FFFFFF' align='center'>
<td align=left bgcolor="#cccccc">門市名稱</td>
<td align=left>
中文:<input type=text name="cname" id="cname" size=50><BR>
英文:<input type=text name="cname2" id="cname2" size=50>
</td>
</tr>


<tr>
<td align=left bgcolor="#cccccc">地址</td>
<td align=left>
中文:<input type=text name="addr" id="addr" size=70><BR>
英文:<input type=text name="addr2" id="addr2" size=70>
</td>
</tr>

<tr>
<td align=left bgcolor="#cccccc">取貨時段<BR>(一行一個時段)</td>
<td align=left>
中文:<BR>
<textarea name="get_time" id="get_time" cols=40 rows=10></textarea>
<HR>
英文:<BR>
<textarea name="get_time2" id="get_time2" cols=40 rows=10></textarea>
</td>
</tr>
<tr><td colspan=2 align=center>
<input type="button" value="新增" onclick="javascript:check();">　
<input type=reset value="清除重填">　
<input type=button value="放棄新增" onclick="location.replace('store.php')">
</td></tr>
</table>
<BR><BR>
			<script language=javascript>
			function check(){
		
			if (document.getElementById("cname").value==""){
			   alert ("請輸入門市名稱-中文.");
			   document.form1.cname.focus();
			   return;
			}
			if (document.getElementById("cname2").value==""){
			   alert ("請輸入門市名稱-英文.");
			   document.form1.cname2.focus();
			   return;
			}
			if (document.getElementById("addr").value==""){
			   alert ("請輸入地址-中文.");
			   document.form1.addr.focus();
			   return;
			}
			if (document.getElementById("addr2").value==""){
			   alert ("請輸入地址-英文.");
			   document.form1.addr2.focus();
			   return;
			}
			if (document.getElementById("get_time").value==""){
			   alert ("請輸入取貨時段-中文.");
			   document.form1.get_time.focus();
			   return;
			}
			if (document.getElementById("get_time2").value==""){
			   alert ("請輸入取貨時段-英文.");
			   document.form1.get_time2.focus();
			   return;
			}
			document.forms['form1'].submit();	 
			}
			</script>
</td>
	</tr>
</table>	
</form>
 </li> 
      
    </ul>
  
