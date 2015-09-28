<?include ("session.php"); 
   include ("../connect.php"); 
   
 $cid=$_POST["cid"]; 
$cname=carhow($_POST["cname"]);
$addr=carhow($_POST["addr"]);
$get_time=carhow($_POST["get_time"]);
$get_time=str_replace("\r\n","<BR>",$get_time);

$cname2=carhow($_POST["cname2"]);
$cname2=carhow($_POST["addr2"]);
$get_time2=carhow($_POST["get_time2"]);
$get_time2=str_replace("\r\n","<BR>",$get_time2);

$isshow="Y";
$sql="update tb_store set cname='$cname',addr='$addr',get_time='$get_time',isshow='$isshow',cname2='$cname2',addr2='$addr2',get_time2='$get_time2' where cid=$cid";
mysql_query($sql);

				echo "<script language=javascript>
				     alert (\"修改成功. \");
					 location.href=\"store.php\";
					 </script>";
?>