<? include('../connect.php');  
    
	$eid=carhow($_GET["eid"]);
	$cid=carhow($_GET["cid"]);
	
	if ($eid!="" && $cid!="")
	{
	  $sql3="update tb_edm2 set isread='Y',read_time=now() where eid=$eid and cid='$cid'";
	  mysql_query($sql3);
	}

?>
