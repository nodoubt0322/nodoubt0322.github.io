<?include ("session.php"); 
   include ("title.php"); 
$cid=$_GET["cid"];
$ccid=$_GET["ccid"];
$sql="select * from tb_item_kind5 where cid=$cid";
$rs2=mysql_query($sql);
$totnum= mysql_num_rows($rs2);  

if ($totnum<=0) {
   exit;
}	
$row2 = mysql_fetch_array($rs2);	
$cname=$row2["cname"];

$sql="select * from tb_item_kind6 where ccid=$ccid";
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
$sel1="";
$sel2="";
			  if ($row["isshow"]=="Y") $sel1=" checked";
			  if ($row["isshow"]=="N") $sel2=" checked";
?>
<div  class="right">
  <div class="right01"> 通路介紹-修改第2層分類</div>
  
<ul>
      
      <li>
<body onload="form1.cname.focus()" topmargin="0">
<table width="650" border="0" style="color:black;">
    <tr>
      <td align=center>
<form name=form1 method=post action="item_kind6_edit_ok.php">
<input type=hidden name="cid" value="<?=$cid; ?>"> 
<input type=hidden name="ccid" value="<?=$ccid;?>">	  
<center>
<table border='1' cellspacing='0' style="color:black;" cellpadding='1' bordercolorlight='#006699' bordercolordark='#FFFFFF' align='center'>

<tr>
<td align=left bgcolor="#6C6C6C"><font color=white>第1層分類名稱：</td>
<td align=left><?=$cname;?></td>
</tr>  


<tr>
<td align=left bgcolor="#6C6C6C"><font color=white>第2層分類名稱</td>
<td align=left>
<input type=text name="cname" id="cname" size=50 value="<?=$row["cname"];?>">
</td>
</tr>

<tr>
<td align=left bgcolor="#6C6C6C"><font color=white>狀態：</td>
<td align=left><input type=radio name="isshow" value="Y"<?=$sel1;?>>顯示
<input type=radio name="isshow" value="N"<?=$sel2;?>>不顯示</td>
</tr>

<tr><td colspan=2 align=center>
<input type="button" value="確定修改" onclick="javascript:check();">　
<input type=reset value="清除重填">　
<input type=button value="放棄修改.." onclick="location.replace('item_kind6.php?cid=<?=$cid;?>')">
</td></tr>
</table>

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