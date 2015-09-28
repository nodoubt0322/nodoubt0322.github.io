<?include ("session.php"); 
  include ("../connect.php"); 
   
$cid=$_POST["cid"];
$ccid=$_POST["ccid"];

$subject=carhow($_POST["subject"]);
$addr=carhow($_POST["addr"]);
$tel=carhow($_POST["tel"]);
$url=carhow($_POST["url"]);

$sql="insert into `tb_news4` (`cid`,`ccid`,`subject`,`addr`,`tel`,`url`,`write_time`) 
       values($cid,$ccid,'$subject',
	   '$addr','$tel','$url',now())";
//echo $sql;
//exit;	 
mysql_query($sql);

echo "<script language=javascript>
	 alert (\"新增成功. \");
	 location.href=\"news4.php\";
	 </script>";
?>