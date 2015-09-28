<?include ("session.php"); 
   include ("title.php"); 
   
 $cid=$_POST["cid"];
 $ccid=$_POST["ccid"];
 $cname=$_POST["cname"];
$isshow=$_POST["isshow"];

$sql="update tb_item_kind2 set cname='$cname',isshow='$isshow' where ccid=$ccid";
mysql_query($sql);

				echo "<script language=javascript>
				     alert (\"修改成功. \");
					 location.href=\"item_kind2.php?cid=$cid\";
					 </script>";
?>
