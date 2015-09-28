<?include ("session.php"); 
   include ("../connect.php"); 
   
   
$cid=$_POST["cid"];
$sql="select max(standing)+1 as ma from tb_item_kind2 where cid=$cid";
$rs=mysql_query($sql);
$totnum= mysql_num_rows($rs); 

if (mysql_result($rs,0,"ma")=="") {
   $ma=1;
}else{
   $ma=mysql_result($rs,0,"ma");
}

$cname=$_POST["cname"];
$isshow=$_POST["isshow"];

$sql="insert into tb_item_kind2 (cid,cname,standing,isshow,cname2) ".
     "values($cid,'$cname',$ma,'$isshow','')";
mysql_query($sql);

				echo "<script language=javascript>
				     alert (\"新增成功. \");
					 location.href=\"item_kind2.php?cid=$cid\";
					 </script>";
?>