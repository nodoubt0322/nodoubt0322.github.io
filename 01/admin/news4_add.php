<? include ("session.php"); 
   include ("title.php"); 

   
$cid=$_GET["cid"];   
if ($cid=="") $cid=$_POST["cid"];   

$ccid=$_GET["ccid"];   
if ($ccid=="") $ccid=$_POST["ccid"]; 

$srhcid=$_GET["srhcid"];
if ($srhcid=="") $srhcid=$_POST["srhcid"];   

$srhcid2=$_GET["srhcid2"];
if ($srhcid2=="") $srhcid2=$_POST["srhcid2"];   

$srhcid3=$_GET["srhcid3"];
if ($srhcid3=="") $srhcid3=$_POST["srhcid3"];   

$srhkind=$_GET["srhkind"];   
if ($srhkind=="") $srhkind=$_POST["srhkind"];   

$subject=carhow($_GET["subject"]);
if ($subject=="") $subject=$_POST["subject"];   

$isshow=$_GET["isshow"];
if ($isshow=="") $isshow=$_POST["isshow"];   
?>

<div  class="right">
  <div class="right01"> 新增通路介紹</div>
  
<ul>
      
      <li>
<form name="form1" method="post" action="news4_add_ok.php">
<table align=center border="0" width="1100" style="color:black;">
    <tr>
      <td align=center>

<table width="1100"  border="1" style="color:black;" cellpadding="0" cellspacing="0" align=center style="font-color:black;">
<tr>
	<td align="right" bgcolor="#C9C9C9" width=180><font color=black>第1層分類:</font></td>
	<td align="left">
<select name="cid" id="cid" onchange="javascript:document.form1.ccid.value='';document.form1.action='news4_add.php';document.form1.submit();">
<option value="">-請選擇-</option>
<? 
$sql2="select * from tb_item_kind5 order by standing";
$rs2=mysql_query($sql2);

  while ( $row2 = mysql_fetch_array($rs2)) 
  {          
          $sel="";
		  if ($cid!=""){
		  if ((int)$row2["cid"]==(int)$cid){
		      $sel=" selected";
		  }
		  }
?>
          <option value="<?=$row2["cid"];?>"<?=$sel;?>><?=$row2["cname"];?></option>

<?
  }  
?>
</select>
</td></tr>
<tr>
	<td align="right" bgcolor="#C9C9C9"><font color=black>第2層分類:</font></td>
	<td align="left">
<select name="ccid" id="ccid">
<option value="">-請選擇-</option>
<? 
if ($cid!="")
{
	$sql2="select * from tb_item_kind6 where cid=$cid order by standing";
	$rs2=mysql_query($sql2);

	  while ( $row2 = mysql_fetch_array($rs2)) 
	  {          
			  $sel="";
			  if ($ccid!=""){
			  if ((int)$row2["ccid"]==(int)$ccid){
				  $sel=" selected";
			  }
			  }
			  
	?>
			  <option value="<?=$row2["ccid"];?>"<?=$sel;?>><?=$row2["cname"];?></option>

	<?
	  }  
}  
?>
</select>
</td></tr>

<tr>
	<td align="right" bgcolor="#C9C9C9"><font color=black>機構名稱:</font></td>
	<td align="left">
	<input size="60" name="subject" id="subject" value="<?=$subject;?>">
	</td>
</tr>
<tr>
	<td align="right" bgcolor="#C9C9C9"><font color=black>地址:</font></td>
	<td align="left">
	<input size="60" name="addr" id="addr" value="<?=$addr;?>">
	</td>
</tr>
<tr>
	<td align="right" bgcolor="#C9C9C9"><font color=black>電話:</font></td>
	<td align="left">
	<input size="60" name="tel" id="tel" value="<?=$tel;?>">
	</td>
</tr>
<tr>
	<td align="right" bgcolor="#C9C9C9"><font color=black>網址:</font></td>
	<td align="left">
	<input size="80" name="url" id="url" value="<?=$url;?>">
	</td>
</tr>

<tr>
	<td align="middle" colSpan="2">
	<input type="button" value="新增" onclick="javascript:check();">　
	&nbsp;&nbsp; </font>
	<input type="button" value=" 放棄新增 " name="ok2" onclick="location.replace('news4.php?srhcid=<?=$srhcid;?>&srhkind=<?=$srhkind;?>&page=<?=$page;?>&page2=<?=$page2;?>')">
	</td>
</tr></table>	
<script language=javascript>
function check(){
         if (document.form1.cid.value==""){
            alert ("請選擇第一層分類...");
            return;
         }	
         if (document.form1.ccid.value==""){
            alert ("請選擇第二層分類...");
            return;
         }		 
         if (document.form1.subject.value==""){
            alert ("請輸入機構名稱...");
			document.form1.subject.focus();
            return;
         }	
          if (document.form1.addr.value==""){
            alert ("請輸入地址...");
			document.form1.addr.focus();
            return;
         }		 
		 
		  if (document.form1.tel.value==""){
            alert ("請輸入電話..");
			document.form1.tel.focus();
            return;
         }		
		 
		 if (confirm("是否確定新增?"))
		 {
		     document.form1.submit();
		 }
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
