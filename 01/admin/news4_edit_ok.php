<?include ("session.php"); 
include ("../connect.php"); 
   
$pid=$_POST["pid"];
$page=$_POST["page"];	
$page2=$_POST["page2"];	
$srhkind=$_POST["srhkind"];
$srhcid=$_POST["srhcid"];
$srhccid=$_POST["srhccid"];
$srhcccid=$_POST["srhcccid"];

$cid=$_POST["cid"];
$ccid=$_POST["ccid"];

$subject=carhow($_POST["subject"]);
$addr=carhow($_POST["addr"]);
$tel=carhow($_POST["tel"]);
$url=carhow($_POST["url"]);

$sql="update `tb_news4` 
	   set `cid`=$cid,`ccid`=$ccid,
	   `subject`='$subject',`addr`='$addr',`tel`='$tel',`url`='$url',`write_time`=now() where pid=$pid";
//echo $sql;
//exit;	 
mysql_query($sql);


echo "<script language=javascript>
	 alert (\"修改成功. \");
	 location.href=\"news4.php?srhcid=$srhcid&srhccid=$srhccid&srhcccid=$srhcccid&srhkind=$srhkind&page=$page&page2=$page2\";
	 </script>";
			 
?>