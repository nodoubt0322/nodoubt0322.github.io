<?include ("title.php"); 
	
	$kind=$_GET["kind"];    
	if ($kind=="") $kind=$_POST["kind"];    
    if ($kind=="") $kind="1";

		$sql = "SELECT * FROM `tb_slogin` ";

$rs=mysql_query($sql);
$row = mysql_fetch_array($rs);

$memo=$row["ordermemo"];   

$say="訂購說明";

?><div  class="right">
  <div class="right01"> <?=$say;?></div>
  
<ul>
      
      <li>
<script src="ckeditor/ckeditor.js" type="text/javascript"></script>
<form name="form1" method="post" action="ordermemo_ok.php" enctype="multipart/form-data">
<table align=center border="0" width="1100">
    
<tr>
	<td align="right" bgcolor="#C9C9C9"><font color=black>訂購說明:</font></td>
	<td align="left">
	<textarea id="editor" class="ckeditor" style="width:900px;height:400px;" name="editor"><?=$memo;?></textarea><BR>
    </td>
</tr>
<tr>
	<td align="middle" colSpan="2">
	<input type="button" value="修改" onclick="javascript:check();">
	</td>
<script language=javascript>

function check(){
       
       
		 document.form1.submit();
}
</script>        
</tr></table>
</td>
	</tr>
</table>	
</form>
</li> 
      
    </ul>
</div>
  <?include ("bottom.php"); ?>