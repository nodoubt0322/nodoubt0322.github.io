<?include ("session.php"); 
   include ("../connect.php"); 
   
 $cid=$_POST["cid"]; 
$cname_ct=carhow($_POST["cname_ct"]);
$isshow=$_POST["isshow"];
$memo=carhow2($_POST["editor"]);

$sql="update tb_item_kindQA set cname='$cname_ct',isshow='$isshow',memo='$memo' where cid=$cid";
mysql_query($sql);

				echo "<script language=javascript>
				     alert (\"修改成功. \");
					 location.href=\"item_kindQA.php\";
					 </script>";
?>