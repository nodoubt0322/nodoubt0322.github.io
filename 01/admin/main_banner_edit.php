<?include ("session.php"); 
   include ("title.php"); 
$aid=$_GET["aid"];
$sql="select * from tb_main_banner where aid=$aid";
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
  <div class="right01"> 修改 BANNER 輪撥(980x400)</div>
  
<ul>
      
      <li>
<table width=900 border="0" style="color:black;">
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
<form name=form1 method=post action="main_banner_edit_ok.php" enctype="multipart/form-data">
<input type=hidden name="aid" value="<?=$aid; ?>">
<input type=hidden name="old_pic" value="<?=$row["pic"]; ?>">  
<center>
<table width=900 border='1' style="color:black;" cellspacing='0' cellpadding='1' bordercolorlight='#006699' bordercolordark='#FFFFFF' align='center'>
<td align=left bgcolor="#DAF5F8"><font color=black>標題</font></td>
<td align=left>
<input type=text name="subject_ct" id="subject_ct" size=50 value="<?=$row["subject"];?>">
</td>
</tr>

<tr>
<td align=left bgcolor="#DAF5F8"><font color=black>圖檔</font></td>
    <td align=left><input type=file name="myfile" size=60>
    (寬:980px 高:400px)
	</td>
</tr>


<tr>
	<td align=left bgcolor="#DAF5F8"><font color=black>網址(可空白)</font></td>
	<td align="left"><input size="60" name="url" value="<?=$row["url"];?>"></td>
</tr>
<? 
		  $sel11="";
		  $sel22="";
		  $openkind=$row["openkind"];
		  if ($openkind=="0") {
		      $sel11=" checked";
		  }else{
		      $sel22=" checked";
		  }
		  
	  
?>	
<tr>
<td align=left bgcolor="#DAF5F8"><font color=black>網址開啟方式</font></td>
<td align=left>
<input type=radio name="openkind" value="0"<?=$sel11;?>>同一視窗
<input type=radio name="openkind" value="1"<?=$sel22;?>>新視窗
</td>
</tr>
<tr><td colspan=2 align=center>
<input type="button" value="確定修改" onclick="javascript:check();">　
<input type=reset value="清除重填">　
<input type=button value="放棄修改.." onclick="location.replace('main_banner.php')">
</td></tr>
</table>
			<script language=javascript>
			function check(){
			if (document.getElementById("subject_ct").value==""){
			   alert ("請輸入標題.");
			   document.form1.subject_ct.focus();
			   return;
			}
			 if (document.form1.myfile.value!=""){
				 b=document.form1.myfile.value.toLowerCase();
				 if (b.indexOf(".jpg")<0 && b.indexOf(".gif")<0 && b.indexOf(".png")<0) {
					alert ("圖檔格式錯誤...");
					return;
				 }	
		 }
         
         if (document.form1.url.value!=""){
		    if (document.form1.url.value.indexOf("http")==-1 && document.form1.url.value.indexOf("HTTP")==-1) {
                alert ("網址必須包含http");
			    document.form1.url.focus();
                return;
			}
        }
			document.forms['form1'].submit();	 
			}
			</script>
</td>
	</tr>
</table>	
</form>
<font color=black>
目前圖檔:</font><BR>
			<img src="../pic/main_banner/<?=$row["pic"]; ?>" />
 </li> 
      
    </ul>
  </div>
  <?include ("bottom.php"); ?>