<?include ("session.php"); 
   include ("title.php"); 

	
	$srhcid=$_GET["srhcid"];  
if ($srhcid=="") $srhcid=$_POST["srhcid"];
 	
	$srhcid2=$_GET["srhcid2"];  
if ($srhcid2=="") $srhcid2=$_POST["srhcid2"];

$srhcid3=$_GET["srhcid3"];  
if ($srhcid3=="") $srhcid3=$_POST["srhcid3"];

$srhkind=$_GET["srhkind"];     
if ($srhkind=="") $srhkind=$_POST["srhkind"];

 $pid=$_GET["pid"];
if ($pid=="") $pid=$_POST["pid"];

		$sql = "SELECT a.*,b.cname as cn1,c.cname as cn2 FROM 
		       `tb_news4` a 
		       left join `tb_item_kind5` b on a.cid=b.cid 
			   left join `tb_item_kind6` c on a.ccid=c.ccid 
			   where a.pid=$pid";
//echo $sql;
//exit;
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

$cid=$_POST["cid"]; 
$ccid=$_POST["ccid"]; 

if ($cid=="")
{
	$cid=$row["cid"];   
	$ccid=$row["ccid"];  
}else{
   $ccid=$_POST["ccid"];
}
?>
<script src="ckeditor/ckeditor.js" type="text/javascript"></script>
<div  class="right">
  <div class="right01"> 修改通路介紹</div>
  
<ul>
      
      <li>
<form name="form1" method="post" action="news4_edit_ok.php">
<input type=hidden name="pid" value="<?=$pid;?>"> 
<input type=hidden name="page" value="<?=$page;?>"> 
<input type=hidden name="srhcid" value="<?=$srhcid;?>">
<input type=hidden name="srhccid" value="<?=$srhccid;?>">
<input type=hidden name="srhcccid" value="<?=$srhcccid;?>">
<input type=hidden name="srhkind" value="<?=$srhkind;?>">
<input type=hidden name="page2" value="<?=$page2;?>"> 

<input type=hidden name="old_cid" value="<?=$cid; ?>">
<input type=hidden name="old_ccid" value="<?=$ccid; ?>">

<table align=center border="0" width="1100" style="color:black;">
    <tr>
      <td align=center>

	  
<table width="1100"  border="1" style="color:black;" cellpadding="0" cellspacing="0" align=center style="font-color:black;">

<tr>
	<td align="right" bgcolor="#C9C9C9" width=180><font color=black>第1層分類:</font></td>
	<td align="left">
<select name="cid" id="cid" onchange="javascript:document.form1.ccid.value='';document.form1.action='news4_edit.php';document.form1.submit();">
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
	
	<input size="60" name="subject" id="subject" value="<?=$row["subject"];?>">
	</td>
</tr>
<tr>
	<td align="right" bgcolor="#C9C9C9"><font color=black>地址:</font></td>
	<td align="left">
	<input size="60" name="addr" id="addr" value="<?=$row["addr"];?>">
	</td>
</tr>
<tr>
	<td align="right" bgcolor="#C9C9C9"><font color=black>電話:</font></td>
	<td align="left">
	<input size="60" name="tel" id="tel" value="<?=$row["tel"];?>">
	</td>
</tr>
<tr>
	<td align="right" bgcolor="#C9C9C9"><font color=black>網址:</font></td>
	<td align="left">
	<input size="80" name="url" id="url" value="<?=$row["url"];?>">
	</td>
</tr>
<tr>
	<td align="middle" colSpan="2">
	<input type="button" value="修改" onclick="javascript:check();">　
	&nbsp;&nbsp; </font>
	<input type="button" value=" 返回 " name="ok2" onclick="location.replace('news4.php?srhcid=<?=$srhcid;?>&srhkind=<?=$srhkind;?>&page=<?=$page;?>&page2=<?=$page2;?>')">
	</td></tr></table>
	
<script language=javascript>
function delpic(){
         if (confirm("是否確定刪除?")){
		     location.href="news4_del_pic.php?srhcid=<?=$srhcid;?>&srhkind=<?=$srhkind;?>&pid=<?=$pid;?>&page=<?=$page;?>&page2=<?=$page2;?>";
		 }	 
}

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
		 if (confirm("是否確定修改?"))
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
