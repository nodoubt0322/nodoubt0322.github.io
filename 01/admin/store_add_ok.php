<?include ("session.php"); 
   include ("../connect.php"); 
   
	$sql="select max(standing)+1 as ma from tb_store";
$rs=mysql_query($sql);
$totnum= mysql_num_rows($rs); 

if (mysql_result($rs,0,"ma")=="") {
   $ma=1;
}else{
   $ma=mysql_result($rs,0,"ma");
}

$cname=carhow($_POST["cname"]);
$addr=carhow($_POST["addr"]);
$get_time=carhow($_POST["get_time"]);
$get_time=str_replace("\r\n","<BR>",$get_time);

$cname2=carhow($_POST["cname2"]);
$cname2=carhow($_POST["addr2"]);
$get_time2=carhow($_POST["get_time2"]);
$get_time2=str_replace("\r\n","<BR>",$get_time2);

$isshow="Y";
$sql="insert into tb_store (cname,addr,get_time,standing,isshow,cname2,addr2,get_time2) ".
     "values('$cname','$addr','$get_time',$ma,'$isshow','$cname2','$addr2','$get_time2')";
//echo $sql;
//exit;	 
mysql_query($sql);

				echo "<script language=javascript>
				     alert (\"新增成功. \");
					 location.href=\"store.php\";
					 </script>";
?>