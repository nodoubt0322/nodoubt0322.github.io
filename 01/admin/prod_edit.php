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

$page=$_GET["page"];  
if ($page=="") $page=$_POST["page"];

$page2=$_GET["page2"];  
if ($page2=="") $page2=$_POST["page2"];

		$sql = "SELECT a.*,b.cname as cn1,c.cname as cn2 FROM 
		       `tb_prod` a 
		       left join `tb_item_kind` b on a.cid=b.cid 
			   left join `tb_item_kind2` c on a.ccid=c.ccid 
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
  <div class="right01"> 修改商品</div>
  
<ul>
      
      <li>
<form name="form1" method="post" enctype="multipart/form-data">
<input type=hidden name="focuspid" value="<?=$pid;?>"> 
<input type=hidden name="pid" value="<?=$pid;?>"> 
<input type=hidden name="page" value="<?=$page;?>"> 
<input type=hidden name="srhcid" value="<?=$srhcid;?>">
<input type=hidden name="srhcid2" value="<?=$srhcid2;?>">
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

<tr>
	<td align="right" bgcolor="#C9C9C9" width=180><font color=black>第1層分類:</font></td>
	<td align="left">
<select name="cid" id="cid" onchange="javascript:document.form1.ccid.value='';document.form1.action='prod_edit.php';document.form1.submit();">
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
	
	<input size="60" name="subject" id="subject" value="<?=$row["subject"];?>">
	</td>
</tr>

<tr>
	<td align="right" bgcolor="#C9C9C9"><font color=black>商品描述:</font></td>
	<td align="left" valign=top>
	<textarea cols=50 rows=5 name="memo2" id="memo2"><?=str_replace("<BR>","\r\n",$row["memo2"]);?></textarea>
	</td>
</tr>
<tr height=50>
	<td align="right" bgcolor="#C9C9C9"><font color=black>規格及對應價格:</font></td>
	<td align="left" valign=middle><BR><font style="font-size:24px;">
	　規　格:<input size="30" name="spec" id="spec" value="<?=$row["spec"];?>" style="font-size:24px;">(以,隔開;例:大,中,小)<BR><BR>
	　售　價:<input size="30" name="price2" id="price2" value="<?=$row["price2"];?>" style="font-size:24px;">(以,隔開;例:500,400,300)<BR><BR>
	　會員價:<input size="30" name="price" id="price" value="<?=$row["price"];?>" style="font-size:24px;">(以,隔開;例:299,199,99)</font>
	<BR><BR>
	</td>
</tr>
<tr>
<TD align=right bgcolor="#C9C9C9"><font color=black>列表圖檔:</font></td>
    <td align=left><input type=file name="myfile" size=60>(格式:jpg/png,寬高比例需為1:1)
<?	
	    
		if ($row["pic"]!=""){ ?>
	<BR><img src="../pic/prod/s_<?=$row["pic"]; ?>" width=200>
	<?//	<input type=button value="刪除圖片" onclick="javascript:delpic();">?>
	<? } ?>
	</td>
</tr>
<? 
				  $sel1="";
				  $pp=$row["ishot"];
				  
				  if ($pp=="Y") $sel1=" checked";
		          ?>
<tr>
<td align=right bgcolor="#C9C9C9">熱銷商品?</td>
<td align=left>
<input type=checkbox name="ishot" value="Y"<?=$sel1;?>>是
</td>
</tr>
<? 
				  $sel1="";
				  $pp=$row["isintro"];
				  
				  if ($pp=="Y") $sel1=" checked";
		          ?>
<tr>
<td align=right bgcolor="#C9C9C9">推薦商品?</td>
<td align=left>
<input type=checkbox name="isintro" value="Y"<?=$sel1;?>>是
</td>
</tr>
<? 
		  $sel1="";
		  $sel2="";
		  if ($row["isshow"]=="Y") {
		      $sel1=" checked";
		  }else{
		      $sel2=" checked";
		  }
		  
	  
?>	
<tr>
<td align=right bgcolor="#C9C9C9">狀態</td>
<td align=left><input type=radio name="isshow" value="Y"<?=$sel1;?>>上架
<input type=radio name="isshow" value="N"<?=$sel2;?>>下架
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
	<input type="button" value=" 返回 " name="ok2" onclick="javascript:bk();">
	</td></tr></table>
<script language=javascript>
function bk()
{
        document.form1.action="prod.php#prod<?=$pid;?>";
		document.form1.submit();
}
function check(){
       if (document.form1.cid.value==""){
            alert ("請選擇第一層分類...");
            return;
         }	
         //if (document.form1.ccid.value==""){
            //alert ("請選擇第二層分類...");
            //return;
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
		 
		 if (document.form1.myfile.value!=""){
		     b=document.form1.myfile.value.toLowerCase();
            if (b.indexOf(".jpg")<0 && b.indexOf(".png")<0) {
                alert ("列表圖檔:圖檔格式錯誤(jpg/png).");
                return;
            } 
		 }	
		 
		 
		 if (confirm("是否確定修改?"))
		 {
		 document.form1.action="prod_edit_ok.php";
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
