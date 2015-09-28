<? include ("session.php");
    include ("title.php");
		
	$level1=$_POST["level1"];
$level2=$_POST["level2"];
$level3=$_POST["level3"];
$level4=$_POST["level4"];

	$subject=carhow($_POST["subject"]);
?>
<script src="ckeditor/ckeditor.js" type="text/javascript"></script>
<div  class="right">
  <div class="right01"> 寄信-信件內容設定</div>
<ul>
<li>


<table border="0" width="910" id="table10" align=center>
<form method="POST" action="edm_send.php" name="form1">
<input type=hidden name="level1" value="<?=$level1;?>">
<input type=hidden name="level2" value="<?=$level2;?>">
<input type=hidden name="level3" value="<?=$level3;?>">
<input type=hidden name="level4" value="<?=$level4;?>">
				
				<tr>
					<td>
						<font size="4"><b>主旨</b></font><input size="50" name="subject" value="<?=$subject;?>">
						<p><font size="4"><b>內容:<BR>
						
						<textarea id="memo" class="ckeditor" cols="80" rows="5" name="memo"></textarea>
						</p>
						<p><input type="button" value="送出" name="B3" onclick="javascript:check();">　
						<input type="reset" value="重新設定" name="B4">　
						</p>
<script language=javascript>
function check(){
        if (document.form1.subject.value==""){
		     alert ("請輸入主旨.");
			  document.form1.subject.focus();
			  return;
		 }
        
	   if (confirm("開始寄送後,請不要關閉視窗\r\n\r\n是否確定開始寄送?"))
	   {
		    document.form1.submit(); 		 
		}
}
</script>						
</form>
					</td>
					<td>　</td>
				</tr>
</table>
</li> 
      
    </ul>
  
  
 </body>
</html>