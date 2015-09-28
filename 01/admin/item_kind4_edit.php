<? include ("session.php"); 
   include ("title.php");
   
$cid=$_GET["cid"];
$sql="select * from tb_item_kind4 where cid=$cid";
$rs=mysql_query($sql);
$findtot=mysql_num_rows($rs);

if ($findtot==0){
?>
    <script language=javascript>
            location.href="main.php";
    </script>
<?
    exit;	
}	

$row = mysql_fetch_array($rs);	
?>
  
<div  class="right">
  <div class="right01"> 最新消息-修改分類</div>
  
<ul>
      
      <li>
<table width=650 align=center border="0" style="color:black;">
    <tr>
      <td align=center><BR>  
<? 
		  $sel1="";
		  $sel2="";
		  if ($row["isshow"]=="Y") {
		      $sel1=" checked";
		  }else{
		      $sel2=" checked";
		  }
		  
	  
?>		 
<form name=form1 method=post action="item_kind4_edit_ok.php">
<input type=hidden name="cid" value="<?=$cid; ?>">  

<table border='1' cellspacing='0' style="color:black;" cellpadding='1' bordercolorlight='#006699' bordercolordark='#FFFFFF' align='center'>
<tr><td align=left bgcolor="#cccccc">分類名稱</td>
<td align=left>
<input type=text name="cname" id="cname" size=50 value="<?=$row["cname"];?>">
</td>
</tr>

	
  
<tr>
<td align=left bgcolor="#cccccc">狀態</td>
<td align=left><input type=radio name="isshow" value="Y"<?=$sel1;?>>顯示
<input type=radio name="isshow" value="N"<?=$sel2;?>>不顯示
</td>
</tr>

<tr><td colspan=2 align=center>
<input type="button" value="確定修改" onclick="javascript:check();">　
<input type=reset value="清除重填">　
<input type=button value="放棄修改.." onclick="location.replace('item_kind4.php')">
</td></tr>
</table>
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