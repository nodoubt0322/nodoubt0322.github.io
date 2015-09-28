<?include ("session.php"); 
   include ("../connect.php"); 
   
   $srhkind=$_GET["srhkind"];
$pid=$_GET["pid"];
$page=$_GET["page"];	
$page2=$_GET["page2"];	
$no=$_GET["no"];	

		$sql = "SELECT * FROM `tb_prod` where pid=$pid";

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

    $sql="update tb_prod set pic='' where pid=".$pid;
	mysql_query($sql);

	if (is_file("../pic/prod/".$old_pic2)) {
		unlink("../pic/prod/".$old_pic2);
	}
if (is_file("../pic/prod/m_".$old_pic2)) {
		unlink("../pic/prod/m_".$old_pic2);
	}
if (is_file("../pic/prod/s_".$old_pic2)) {
		unlink("../pic/prod/s_".$old_pic2);
	}	
	
$today=date("Ymd");
$addsql="update `tb_post` set standing=-1 where not (REPLACE( sdate,  '-',  '' ) <=  '".$today."' AND REPLACE( edate,  '-',  '' ) >=  '".$today."') ";
mysql_query($addsql);

$sql = "SELECT * FROM `tb_post` where REPLACE( sdate,  '-',  '' ) <=  '".$today."' AND REPLACE( edate,  '-',  '' ) >=  '".$today."' order by standing,write_time DESC";
$rs=mysql_query($sql);
$totnum= mysql_num_rows($rs);			
if ($totnum>0) 
{
	$i=0;
	while ($row= mysql_fetch_array($rs))
	{
		   $pid=$row["pid"];
		   $i++;
		   
		   $addsql="update `tb_post` set standing=$i where not pid=$pid";
		   mysql_query($addsql);
	}
}	

				echo "<script language=javascript>
				     alert (\"刪除成功. \");
					 location.href=\"prod_edit.php?srhkind=$srhkind&pid=$pid&page=$page&page2=$page2\";
					 </script>";
?>