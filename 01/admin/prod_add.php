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
<script src="ckeditor/ckeditor.js" type="text/javascript"></script>
<div  class="right">
  <div class="right01"> 新增商品</div>
  
<ul>
      
      <li>
<form name="form1" method="post" action="prod_add_ok.php" enctype="multipart/form-data">
<table align=center border="0" width="1100" style="color:black;">
    <tr>
      <td align=center>

	  <font color=red><B>圖片若超過兩2mb請先縮圖再上傳!</B></font></center>

<table width="1100"  border="1" style="color:black;" cellpadding="0" cellspacing="0" align=center style="font-color:black;">
<tr>
	<td align="right" bgcolor="#C9C9C9" width=180><font color=black>第1層分類:</font></td>
	<td align="left">
<select name="cid" id="cid" onchange="javascript:document.form1.ccid.value='';document.form1.action='prod_add.php';document.form1.submit();">
<option value="">-請選擇-</option>
<? 
$sql2="select * from tb_item_kind order by standing";
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
	$sql2="select * from tb_item_kind2 where cid=$cid order by standing";
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
</select>　（可不選）
</td></tr>

<tr>
	<td align="right" bgcolor="#C9C9C9"><font color=black>產品名稱:</font></td>
	<td align="left">
	<input size="60" name="subject" id="subject" value="<?=$subject;?>">
	</td>
</tr>

<tr>
	<td align="right" bgcolor="#C9C9C9"><font color=black>商品描述:</font></td>
	<td align="left" valign=top>
	<textarea cols=50 rows=5 name="memo2" id="memo2"></textarea>
	</td>
</tr>

<tr height=50>
	<td align="right" bgcolor="#C9C9C9"><font color=black>規格及對應價格:</font></td>
	<td align="left" valign=middle><BR><font style="font-size:24px;">
	　規　格:<input size="30" name="spec" id="spec" value="<?=$spec;?>" style="font-size:24px;">(以,隔開;例:大,中,小)<BR><BR>
	　售　價:<input size="30" name="price2" id="price2" value="<?=$price2;?>" style="font-size:24px;">(以,隔開;例:500,400,300)<BR><BR>
	　會員價:<input size="30" name="price" id="price" value="<?=$price;?>" style="font-size:24px;">(以,隔開;例:299,199,99)</font>
	<BR><BR>
	</td>
</tr>
<tr>
<TD align=right bgcolor="#C9C9C9"><font color=black>列表圖檔:</font></td>
    <td align=left><input type=file name="myfile" size=60>(格式:jpg/png,寬高比例需為1:1)

	</td>
</tr>


<tr>
<td align=right bgcolor="#C9C9C9">熱銷商品?</td>
<td align=left>
<input type=checkbox name="ishot" value="Y">是
</td>
</tr>

<tr>
<td align=right bgcolor="#C9C9C9">推薦商品?</td>
<td align=left>
<input type=checkbox name="isintro" value="Y">是
</td>
</tr>

<tr>
<td align=right bgcolor="#C9C9C9">狀態</td>
<td align=left>
<input type=radio name="isshow" value="Y" checked>上架
<input type=radio name="isshow" value="N">下架
</td>
</tr>
<tr>
	<td align="right" bgcolor="#C9C9C9"><font color=black>內容:</font></td>
	<td align="left">
	<textarea id="editor" class="ckeditor" style="width:900px;height:150px;" name="editor"></textarea>
	</td>
</tr>

<tr>
	<td align="middle" colSpan="2">
	<input type="button" value="新增" onclick="javascript:check();">　
	&nbsp;&nbsp; </font>
	<input type="button" value=" 放棄新增 " name="ok2" onclick="location.replace('prod.php?srhcid=<?=$srhcid;?>&srhcid2=<?=$srhcid2;?>&srhkind=<?=$srhkind;?>&page=<?=$page;?>&page2=<?=$page2;?>')">
	</td>
</tr></table>	
<script language=javascript>
function check(){
         if (document.form1.cid.value==""){
            alert ("請選擇第一層分類...");
            return;
         }	
         //if (document.form1.ccid.value==""){
         //   alert ("請選擇第二層分類...");
         //   return;
         //}		 
         if (document.form1.subject.value==""){
            alert ("請輸入產品名稱...");
			document.form1.subject.focus();
            return;
         }	
         
         aa=document.form1.spec.value;
		 if (aa==""){
			alert ("請輸入規格");
			document.form1.spec.focus();
			return;
		 } 
		 
	    bb=document.form1.price2.value;
		 if (bb==""){
			alert ("請輸入售價");
			document.form1.price2.focus();
			return;
		 } 
         cc=document.form1.price.value;
		 if (cc==""){
			alert ("請輸入會員價");
			document.form1.price.focus();
			return;
		 } 
　　　　     aaa=aa.split(",");
			 aaaa=aaa.length; 
			 
			 bbb=bb.split(",");
			 bbbb=bbb.length;  		 			 
			 
			 ccc=cc.split(",");
			 cccc=ccc.length;  
			 
			 if (aaaa!=bbbb || cccc!=bbbb || cccc!=aaaa){
				alert ("規格及與對應的售價／會員會數量不相同.");
				document.form1.spec.focus();
				return;
			 }
			 
			 for (i=0;i<aaaa;i++)
			 {
					  q=bbb[i];
					  if (q!="")
					  {
						 if (isNaN(q)){
						  alert ("售價:"+q+"---必須為數字.");
						  document.form1.price2.focus();
						  return;
						 }
					   
						 if (q.indexOf(".")>=0) {
						   alert ("售價"+q+"---必須為正整數.");
						   document.form1.price2.focus();
						   return;
						 }
						
						 if (parseInt(q)<=0) {
						   alert ("售價"+q+"---必須大於0.");
						   document.form1.price2.focus();
						   return;
						 }
					  }
					  
					  q=ccc[i];
					  if (q!="")
					  {
						 if (isNaN(q)){
						  alert ("會員價:"+q+"---必須為數字.");
						  document.form1.price.focus();
						  return;
						 }
					   
						 if (q.indexOf(".")>=0) {
						   alert ("會員價"+q+"---必須為正整數.");
						   document.form1.price.focus();
						   return;
						 }
						
						 if (parseInt(q)<=0) {
						   alert ("會員價"+q+"---必須大於0.");
						   document.form1.price.focus();
						   return;
						 }
					  }
　　　　      }


		 if (document.form1.myfile.value==""){
		        alert ("請選擇列表圖檔.");
                return;
		 }	
		 
		 if (document.form1.myfile.value!=""){
		     b=document.form1.myfile.value.toLowerCase();
            if (b.indexOf(".jpg")<0 && b.indexOf(".png")<0) {
                alert ("列表圖檔:圖檔格式錯誤(jpg/png).");
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
