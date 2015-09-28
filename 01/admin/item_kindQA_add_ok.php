<?include ("session.php"); 
   include ("../connect.php"); 
   
	$sql="select max(standing)+1 as ma from `tb_item_kindQA`";
$rs=mysql_query($sql);
$totnum= mysql_num_rows($rs); 

if (mysql_result($rs,0,"ma")=="") {
   $ma=1;
}else{
   $ma=mysql_result($rs,0,"ma");
}

$cname_ct=carhow($_POST["cname_ct"]);
$memo=carhow2($_POST["editor"]);
$isshow=$_POST["isshow"];
$sql="insert into `tb_item_kindQA` (cname,standing,isshow,memo) ".
     "values('$cname_ct',$ma,'$isshow','$memo')";

mysql_query($sql);

//echo $sql;
//exit;	 
				echo "<script language=javascript>
				     alert (\"新增成功. \");
					 location.href=\"item_kindQA.php\";
					 </script>";
?>