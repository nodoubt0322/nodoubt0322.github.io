<?include ("session.php"); 
   include ("title.php"); 
   
$cid=$_GET["cid"];
$sql="select * from tb_item_kindQA where cid=$cid";
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
  <div class="right01"> 關於我們-修改</div>
  
<ul>
      
      <li>
<table border="0" align=center>
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
<script src="ckeditor/ckeditor.js" type="text/javascript"></script>	 
<form name=form1 method=post action="item_kindQA_edit_ok.php" enctype="multipart/form-data">
<input type=hidden name="cid" value="<?=$cid; ?>">  
<center>
<table width=900 border='1' cellspacing='0' cellpadding='1' bordercolorlight='#006699' bordercolordark='#FFFFFF' align='center'>
<td align=right bgcolor="#C9C9C9">標題名稱</td>
<td align=left>
<input type=text name="cname_ct" id="cname_ct" size=50 value="<?=$row["cname"];?>">
</td>
</tr>


<tr>
	<td align="right" bgcolor="#C9C9C9"><font color=black>內容:</font></td>
	<td align="left">
	<textarea id="editor" class="ckeditor" name="editor"><?=$row["memo"];?></textarea>
	</td>
</tr>

	<input type=hidden name="isshow" value="Y">

<tr><td colspan=2 align=center>
<input type="button" value="確定修改" onclick="javascript:check();">　
<input type=reset value="清除重填">　
<input type=button value="放棄修改.." onclick="location.replace('item_kindQA.php')">
</td></tr>
</table>
			<script language=javascript>
			function check(){
			if (document.getElementById("cname_ct").value==""){
			   alert ("請輸入標題名稱.");
			   document.form1.cname_ct.focus();
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
  
  
 </body>
</html>