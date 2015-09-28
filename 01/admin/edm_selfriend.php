<? include ("session.php");
    include ("title.php");

	$level1=$_POST["level1"];
	$level2=$_POST["level2"];
	$level3=$_POST["level3"];
	$level4=$_POST["level4"];
?>
<form name="form1" action="edm_selfriend2.php" method="post">
<div  class="right">
  <div class="right01"> 寄信-選擇寄送條件</div>
<ul>
<li>

<table width="910" border="0" align="center">
<tr>
	<td width="99%" colspan="2" align=center>選擇寄送條件<BR><BR>
	
	<table align=center border=1>
		
			
<tr>
			
			<td align=center>會員身份</td>
			<td>
			<? 
			$sel1="";
			$sel2="";
			$sel3="";
			$sel4="";
			if ($level1=="1") $sel1=" checked";
			if ($level2=="2") $sel2=" checked";
			if ($level3=="3") $sel3=" checked";
			if ($level4=="4") $sel4=" checked";
			?>
			
			<input type=checkbox name="level1" value="1"<?=$sel1;?>>網路會員
			<input type=checkbox name="level2" value="2"<?=$sel2;?>>VIP會員
			<input type=checkbox name="level3" value="3"<?=$sel3;?>>廠商
			<input type=checkbox name="level4" value="4"<?=$sel4;?>>白金會員
           </td>
		</tr>
	
	<tr><td align=center colspan=3 valign=top>
	<input type=button value="確定" onclick="javascript:check();">　
	<input type=button value="取消" onclick="location.replace('edm_list.php')">
	</td></tr>
	</table>
	
	<script language=javascript>
	function check()
	{
	         if (document.form1.level1.checked==false && document.form1.level2.checked==false && document.form1.level3.checked==false && document.form1.level4.checked==false)
			 {
			     alert ("請至少選擇一個寄送身份");
                 return;				 
			 }
			 document.form1.submit();
	}
	</script>
</form>
</li> 
      
    </ul>
  
  
 </body>
</html>