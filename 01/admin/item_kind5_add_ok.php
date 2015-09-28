<?include ("session.php"); 
   include ("../connect.php"); 
   
	$sql="select max(standing)+1 as ma from tb_item_kind5";
$rs=mysql_query($sql);
$totnum= mysql_num_rows($rs); 

if (mysql_result($rs,0,"ma")=="") {
   $ma=1;
}else{
   $ma=mysql_result($rs,0,"ma");
}

$cname=carhow($_POST["cname"]);
$isshow=$_POST["isshow"];
$sql="insert into tb_item_kind5 (cname,standing,isshow,cname2) ".
     "values('$cname',$ma,'$isshow','')";
//echo $sql;
//exit;	 
mysql_query($sql);

				echo "<script language=javascript>
				     alert (\"新增成功. \");
					 location.href=\"item_kind5.php\";
					 </script>";
?>