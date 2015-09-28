<? include ("session.php"); 
   include ("title.php");
   
$cid=$_GET["cid"];	
$sql="select * from tb_item_kind where cid=$cid";
$rs2=mysql_query($sql);
$totnum= mysql_num_rows($rs2);  

if ($totnum<=0) {
   exit;
}	
$row = mysql_fetch_array($rs2);	
?>
<div  class="right">
  <div class="right01"> 產品-新增第2層分類</div>
  
<ul>
      
      <li>
<form name=form1 method=post action="item_kind2_add_ok.php">
<input type=hidden name="cid" value="<?=$cid;?>">

<table border='0' align='center' style="color:black;">
    <tr>
      <td align=center><BR>

<table border='1' width=650  style="color:black;" cellspacing='0' cellpadding='1' bordercolorlight='#006699' bordercolordark='#FFFFFF' align='center'>
<tr>
<td align=left bgcolor="#6C6C6C"><font color=white>第1層分類名稱：</td>
<td align=left><?=$row["cname"];?></td>
</tr>

<tr>
<td align=left bgcolor="#6C6C6C"><font color=white>第2層分類名稱</td>
<td align=left>
<input type=text name="cname" id="cname" size=50>
</td>
</tr>

<tr>
<td align=left bgcolor="#6C6C6C"><font color=white>狀態</td>
<td align=left>
<input type=radio name="isshow" value="Y" checked>顯示
<input type=radio name="isshow" value="N">不顯示
</td>
</tr>


<tr><td colspan=2 align=center>
<input type="button" value="新增" onclick="javascript:check();">　
<input type=reset value="清除重填">　
<input type=button value="放棄新增" onclick="location.replace('item_kind2.php?cid=<?=$cid;?>')">
</td></tr>
</table>
<BR><BR>
			<script language=javascript>
			function check(){
			if (document.getElementById("cname").value==""){
			   alert ("請輸入第2層分類名稱.");
			   document.form1.cname.focus();
			   return;
			}
	        document.form1.submit();
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