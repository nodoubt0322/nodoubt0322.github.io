<?include ("session.php"); 
   include ("title.php"); 
?>
<div  class="right">
  <div class="right01"> 新增 BANNER 輪撥(980x400)</div>
  
<ul>
      
      <li>

<form name=form1 method=post action="main_banner_add_ok.php" enctype="multipart/form-data">
<body onload="document.form1.subject_ct.focus()" topmargin="0">
<table width=900 border="0" style="color:black;">
    <tr>
      <td align=center><BR>
<center>

<table width=900 border='1'  style="color:black;" cellspacing='0' cellpadding='1' bordercolorlight='#006699' bordercolordark='#FFFFFF' align='center'>
<tr><td align=left bgcolor="#DAF5F8">標題</td>
<td align=left>
<input type=text name="subject_ct" id="subject_ct" size=50>
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
	<td align="left"><input size="60" name="url"></td>
</tr>
<tr>
<td align=left bgcolor="#DAF5F8">網址開啟方式</td>
<td align=left>
<input type=radio name="openkind" value="0" checked>同一視窗
<input type=radio name="openkind" value="1">新視窗
</td>
</tr>
<tr><td colspan=2 align=center>
<input type="button" value="新增" onclick="javascript:check();">　
<input type=reset value="清除重填">　
<input type=button value="放棄新增" onclick="location.replace('main_banner.php')">
</td></tr>
</table>
<BR><BR>
			<script language=javascript>
			function check(){
		
			if (document.getElementById("subject_ct").value==""){
			   alert ("請輸入標題.");
			   document.form1.subject_ct.focus();
			   return;
			}
			 if (document.form1.myfile.value==""){
            alert ("請選擇圖檔...");
            return;
         }		 
		 
		 b=document.form1.myfile.value.toLowerCase();
         if (b.indexOf(".jpg")<0 && b.indexOf(".gif")<0 && b.indexOf(".png")<0) {
            alert ("圖檔格式錯誤...");
            return;
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

 </li> 
      
    </ul>
  </div>
  <?include ("bottom.php"); ?>