<? include ("session.php");
    include ("title.php");

$addsql=" where email<>'' and status='Y' ";
$level1=$_POST["level1"];
$level2=$_POST["level2"];
$level3=$_POST["level3"];
$level4=$_POST["level4"];

$aa="";
if ($level1=="1") $aa.="1,";
if ($level2=="2") $aa.="2,";
if ($level3=="3") $aa.="3,";
if ($level4=="4") $aa.="4,";

if ($aa!="")
{
    $aa=substr($aa,0,-1);
	$addsql.=" and level in (".$aa.")";
}
?>
<form name="form1" method="post">
<input type=hidden name="level1" value="<?=$level1;?>">
<input type=hidden name="level2" value="<?=$level2;?>">
<input type=hidden name="level3" value="<?=$level3;?>">
<input type=hidden name="level4" value="<?=$level4;?>">
<div  class="right">
  <div class="right01"> 寄信-符合寄送條件數量</div>
<ul>
<li>

<table width="910" border="0" align="center">
<tr>
	<td width="99%" colspan="2" align=center>寄送會員數<BR><BR>
	
	
	<table align=center border=1 width=550>
		
		
	
	<tr>
			<td align=center>會員數</td>
			<td>
	<? 
	//echo $addsql."<HR>";
	//echo $addsql2."<HR>";
	//echo $addsql3."<HR>";
	
	
	$sql="select * from tb_member ".$addsql." order by cid";
	//echo $sql."<BR>";
	$rs=mysql_query($sql);
    $totnum= mysql_num_rows($rs);	
	
	$cidstr="";
	$cidstr2="";
	$q=0;
	while ( $row = mysql_fetch_array($rs)) 
   {
            $cidstr.=$row["id"].",";
			$q++;
			$cidstr2.=$row["id"]." ";
			if ($q%8==0) $cidstr2.="<BR>";
   }
	?>
	<?=$totnum;?>個
	<?//<BR>$cidstr2?>
	</td></tr>
	
	<tr><td align=center colspan=3 valign=top>
	<? if ($totnum>0) { ?>
	<input type=submit value="下一步,編輯電子報內容" onclick="javascript:check();">　
	<? }else{
	?>
	<font color=red><B>沒有符合條件的會員</B></font>　
	<? } ?>
	<input type=button value="返回" onclick="javascript:rtn();">
	
	</td></tr>
	</table>
	<input type=hidden name="cidstr" value="<?=$cidstr;?>">
	<script language=javascript>
	function check(){
	        //if (confirm("是否確定送出?")){
			     document.form1.action="edm_subject.php";
               document.form1.submit();	
			  //}
	}
	function rtn(){
	        document.form1.action="edm_list.php";
            document.form1.submit();			
	}
	</script>
</form>
</li> 
      
    </ul>
  
  
 </body>
</html>