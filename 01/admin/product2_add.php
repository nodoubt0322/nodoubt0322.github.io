<?include ("session.php"); 
   include ("title.php"); 
$srhcid=carhow($_GET["srhcid"]);
   if ($srhcid=="") $srhcid=carhow($_POST["srhcid"]);
   
   
   $srhccid=carhow($_GET["srhccid"]);
   if ($srhccid=="") $srhccid=carhow($_POST["srhccid"]);
   
   $srhcccid=carhow($_GET["srhcccid"]);
   if ($srhcccid=="") $srhcccid=carhow($_POST["srhcccid"]);
   
   $page=carhow($_GET["page"]);
   if ($page=="") $page=carhow($_POST["page"]);
   
   $page2=carhow($_GET["page2"]);
   if ($page2=="") $page2=carhow($_POST["page2"]);
   
   $pid=carhow($_GET["pid"]);
   if ($pid=="") $pid=carhow($_POST["pid"]);
   
   if ($pid=="")
   {
?>
        <script language=javascript>
		document.location.href="prod.php";
		</script>
<?	
       exit;
	}   

	$sql2 = "SELECT a.* FROM `tb_prod` a ".
		       "where a.pid=$pid";
    $rs2=mysql_query($sql2);
	$totnum2= mysql_num_rows($rs2);
	if ($totnum2==0)
	{
?>
        <script language=javascript>
		document.location.href="prod.php";
		</script>
<?	
       exit;	
	}
	$row2 = mysql_fetch_array($rs2);
?>
<div  class="right">
  <div class="right01"> 產品圖片-新增</div>
  
<ul>
      
      <li>
<form name=form1 method=post action="product2_add_ok.php" enctype="multipart/form-data">
<input type=hidden name="srhcid" value="<?=$srhcid;?>">
<input type=hidden name="srhccid" value="<?=$srhccid;?>">
<input type=hidden name="srhcccid" value="<?=$srhcccid;?>">
<input type=hidden name="page" value="<?=$page;?>">
<input type=hidden name="page2" value="<?=$page2;?>">
<input type=hidden name="pid" value="<?=$pid;?>">

<table border='0' align='center' style="color:black;">
    <tr>
      <td align=center><BR>
<center>產品名稱:<?=$row2["subject"];?>
<table width=900 border='1' cellspacing='0' style="color:black;" cellpadding='1' bordercolorlight='#006699' bordercolordark='#FFFFFF' align='center'>

<tr>
<TD align=center bgcolor="#6C6C6C"><font color=white>產品圖</font></td>
</tr>

<? for ($i=1;$i<=5;$i++){ ?>
		<tr>
			<td align=left><input type=file name="myfile<?=$i;?>" id="myfile<?=$i;?>" size=60>
		<?	
				echo " (格式:jpg/png,寬高比例需為1:1)";
		?>	
			</td>

		</tr>
<? } ?>

<tr><td colspan=2 align=center>
<input type="button" value="新增" onclick="javascript:check();">　
<input type=reset value="清除重填">　
<input type=button value="放棄新增" onclick="location.replace('product2.php?srhcid=<?=$srhcid;?>&page=<?=$page;?>&page2=<?=$page2;?>&pid=<?=$pid;?>')">
</td></tr>
</table>
<BR><BR>
			<script language=javascript>
			function check(){
			flag=0;
		 <? 		 
		        for ($i=1;$i<=5;$i++){
		 ?>
					 if (document.form1.myfile<?=$i;?>.value!="") 
					 {
						flag=1;
				 	 } 
		<?		} ?>
		
		        if (flag=="0") {
						alert ("請至少選擇一張圖片.");
						return;
				} 
				
		<?		 
		        for ($i=1;$i<=5;$i++){
		?>
					 if (document.form1.myfile<?=$i;?>.value!=""){
						 b=document.form1.myfile<?=$i;?>.value.toLowerCase();
						if (b.indexOf(".jpg")<0 && b.indexOf(".png")<0) {
							alert ("圖片<?=$i;?>格式錯誤(jpg/png/gif).");
							return;
						} 
					 }
         <?		} ?>
		 
			
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
