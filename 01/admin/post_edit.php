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

		$sql = "SELECT a.*,b.cname as cn1 FROM 
		       `tb_post` a 
		       left join `tb_item_kind4` b on a.cid=b.cid 
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
  <div class="right01"> 修改最新消息</div>
  
<ul>
      
      <li>
<form name="form1" method="post" action="post_edit_ok.php" enctype="multipart/form-data">
<input type=hidden name="pid" value="<?=$pid;?>"> 
<input type=hidden name="page" value="<?=$page;?>"> 
<input type=hidden name="srhcid" value="<?=$srhcid;?>">
<input type=hidden name="srhccid" value="<?=$srhccid;?>">
<input type=hidden name="srhcccid" value="<?=$srhcccid;?>">
<input type=hidden name="srhkind" value="<?=$srhkind;?>">
<input type=hidden name="page2" value="<?=$page2;?>"> 
<input type=hidden name="old_pic" value="<?=$row["pic"]; ?>">
<input type=hidden name="old_cid" value="<?=$cid; ?>">
<input type=hidden name="old_ccid" value="<?=$ccid; ?>">

<table align=center border="0" width="1100" style="color:black;">
    <tr>
      <td align=center>

	  <center><font color=red><B>圖片若超過兩2mb請先縮圖再上傳!</B></font></center>
<table width="1100"  border="1" style="color:black;" cellpadding="0" cellspacing="0" align=center style="font-color:black;">
<?
            if ($a=="111111111"){?>
<tr>
	<td align="right" bgcolor="#C9C9C9" width=180><font color=black>分類:</font></td>
	<td align="left">
<select name="cid" id="cid">
<option value="">-請選擇-</option>
<? 
$sql2="select * from tb_item_kind4 order by standing";
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
<? } ?>
<tr>
	<td align="right" bgcolor="#C9C9C9"><font color=black>主題:</font></td>
	<td align="left">
	
	<input size="60" name="subject" id="subject" value="<?=$row["subject"];?>">
	</td>
</tr>

<tr>
<TD align=right bgcolor="#C9C9C9"><font color=black>圖檔(jpg/png):</font></td>
    <td align=left><input type=file name="myfile" size=60>(限制 寬:180px 高:180px)
<?	
	    
		if ($row["pic"]!=""){ ?>
	<BR><img src="../pic/post/<?=$row["pic"]; ?>">
		<input type=button value="刪除圖片" onclick="javascript:delpic();">
	<? } ?>
	</td>
</tr>

<tr>
	<td align="right" bgcolor="#C9C9C9"><font color=black>內容:</font></td>
	<td align="left"><textarea id="editor" class="ckeditor" style="width:900px;height:150px;" name="editor"><?=$row["memo"];?></textarea>

	</td>
</tr>

<tr>
	<td align="middle" colSpan="2">
	<input type="button" value="修改" onclick="javascript:check();">　
	&nbsp;&nbsp; </font>
	<input type="button" value=" 返回 " name="ok2" onclick="location.replace('post.php?srhcid=<?=$srhcid;?>&srhkind=<?=$srhkind;?>&page=<?=$page;?>&page2=<?=$page2;?>')">
	</td></tr></table>
	
<script language=javascript>
function delpic(){
         if (confirm("是否確定刪除?")){
		     location.href="post_del_pic.php?srhcid=<?=$srhcid;?>&srhkind=<?=$srhkind;?>&pid=<?=$pid;?>&page=<?=$page;?>&page2=<?=$page2;?>";
		 }	 
}

function check(){
<?
            if ($a=="111111111"){?>
       if (document.form1.cid.value==""){
            alert ("請選擇分類...");
            return;
         }	 
		 <? } ?>
         if (document.form1.subject.value==""){
            alert ("請輸入主題..");
			document.form1.subject.focus();
            return;
         }	
         	 
		 if (document.form1.myfile.value!=""){
		     b=document.form1.myfile.value.toLowerCase();
            if (b.indexOf(".jpg")<0 && b.indexOf(".png")<0) {
                alert ("圖檔:圖檔格式錯誤(jpg/png).");
                return;
            } 
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
