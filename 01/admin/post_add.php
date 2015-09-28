<? include ("session.php"); 
   include ("title.php"); 

   
$cid=$_GET["cid"];   
if ($cid=="") $cid=$_POST["cid"];   

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
<script src="ckeditor/ckeditor.js" type="text/javascript"></script>
<div  class="right">
  <div class="right01"> 新增最新消息</div>
  
<ul>
      
      <li>
<form name="form1" method="post" action="post_add_ok.php" enctype="multipart/form-data">
<table align=center border="0" width="1100" style="color:black;">
    <tr>
      <td align=center>

	  <font color=red><B>圖片若超過兩2mb請先縮圖再上傳!</B></font></center>

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
	<input size="60" name="subject" id="subject" value="<?=$subject;?>">
	</td>
</tr>

<tr>
<TD align=right bgcolor="#C9C9C9"><font color=black>圖檔(jpg/png):</font></td>
    <td align=left><input type=file name="myfile" size=60>(限制 寬:180px 高:180px)

	</td>
</tr>

<tr>
	<td align="right" bgcolor="#C9C9C9"><font color=black>最新消息內容:</font></td>
	<td align="left">
	<textarea id="editor" class="ckeditor" style="width:900px;height:150px;" name="editor"></textarea>
	</td>
</tr>

<tr>
	<td align="middle" colSpan="2">
	<input type="button" value="新增" onclick="javascript:check();">　
	&nbsp;&nbsp; </font>
	<input type="button" value=" 放棄新增 " name="ok2" onclick="location.replace('post.php?srhcid=<?=$srhcid;?>&srhkind=<?=$srhkind;?>&page=<?=$page;?>&page2=<?=$page2;?>')">
	</td>
</tr></table>	
<script language=javascript>
function check(){
<?
            if ($a=="111111111"){?>
         if (document.form1.cid.value==""){
            alert ("請選擇分類...");
            return;
         }	
<? } ?>		 
         if (document.form1.subject.value==""){
            alert ("請輸入主題...");
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
