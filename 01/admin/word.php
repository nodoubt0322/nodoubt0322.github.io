<?include ("session.php"); 
   include ("title.php"); 
	
	$kind=$_GET["kind"];    
	if ($kind=="") $kind=$_POST["kind"];    
    if ($kind=="") $kind="1";

		$sql = "SELECT * FROM `tb_word` ".
			   "where kind='$kind'";

$rs=mysql_query($sql);
$row = mysql_fetch_array($rs);

$memo=$row["memo"];   

$say="";
if ($kind=="1") $say="訂購說明";

?><div  class="right">
  <div class="right01"> <?=$say;?></div>
  
<ul>
      
      <li>
<script src="ckeditor/ckeditor.js" type="text/javascript"></script>
<form name="form1" method="post" action="word_ok.php" enctype="multipart/form-data">
<input type=hidden name="kind" value="<?=$kind;?>"> 
<table align=center border="0" width="950">
    

<tr>
	<td align="left">
	<textarea id="editor" class="ckeditor" style="width:900px;height:400px;" name="editor"><?=$row["memo"];?></textarea><BR>
    </td>
</tr>

<tr>
	<td align="middle" colSpan="2">
	<input type="button" value="修改" onclick="javascript:check();">　
	&nbsp;&nbsp; </font>
	<input type="button" value=" 返回 " name="ok2" onclick="location.replace('post.php?srhcid=<?=$srhcid;?>&srhkind=<?=$srhkind;?>&page=<?=$page;?>&page2=<?=$page2;?>')">
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
  
  
 </body>
</html>