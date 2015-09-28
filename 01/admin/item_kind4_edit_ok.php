<?include ("session.php"); 
   include ("../connect.php"); 
   
 $cid=$_POST["cid"]; 
$cname=carhow($_POST["cname"]);
$isshow=$_POST["isshow"];
$sql="update tb_item_kind4 set cname='$cname',isshow='$isshow' where cid=$cid";
mysql_query($sql);

				echo "<script language=javascript>
				     alert (\"修改成功. \");
					 location.href=\"item_kind4.php\";
					 </script>";
?>