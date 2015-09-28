<?include ("session.php"); 
   include ("../connect.php"); 
   
   $srhkind=$_GET["srhkind"];
$pid=$_GET["pid"];
$page=$_GET["page"];	
$page2=$_GET["page2"];	
$no=$_GET["no"];	

		$sql = "SELECT * FROM `tb_post` where pid=$pid";

$rs=mysql_query($sql);
$findtot=mysql_num_rows($rs);

if ($findtot==0){
?>
    <script language=javascript>
            location.href="main.php";
    </script>
<?
    exit;	
}	

$row = mysql_fetch_array($rs);

$old_pic2=$row["pic"];

    $sql="update tb_post set pic='' where pid=".$pid;
	mysql_query($sql);

	if (is_file("../pic/post/".$old_pic2)) {
		unlink("../pic/post/".$old_pic2);
	}
	//exit;

				echo "<script language=javascript>
				     alert (\"刪除成功. \");
					 location.href=\"post_edit.php?srhkind=$srhkind&pid=$pid&page=$page&page2=$page2\";
					 </script>";
?>