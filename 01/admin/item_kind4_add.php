<? include ("session.php"); 
   include ("title.php"); 
?>
<div  class="right">
  <div class="right01"> 最新消息-新增分類</div>
  
<ul>
      
      <li>
<form name=form1 method=post action="item_kind4_add_ok.php">

<table width=650 border="0" style="color:black;">
    <tr>
      <td align=center><BR>
<table border='1' cellspacing='0' style="color:black;" cellpadding='1' bordercolorlight='#006699' bordercolordark='#FFFFFF' align='center'>
<tr>
<td align=left bgcolor="#cccccc">分類名稱</td>
<td align=left>
<input type=text name="cname" id="cname" size=50>
</td>
</tr>



<tr>
<td align=left bgcolor="#cccccc">狀態</td>
<td align=left>
<input type=radio name="isshow" value="Y" checked>顯示
<input type=radio name="isshow" value="N">不顯示
</td>
</tr>

<tr><td colspan=2 align=center>
<input type="button" value="新增" onclick="javascript:check();">　
<input type=reset value="清除重填">　
<input type=button value="放棄新增" onclick="location.replace('item_kind4.php')">
</td></tr>
</table>
<BR><BR>
			<script language=javascript>
			function check(){
		
			if (document.getElementById("cname").value==""){
			   alert ("請輸入分類名稱.");
			   document.form1.cname.focus();
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
  </div>
  <?include ("bottom.php"); ?>