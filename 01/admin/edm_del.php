<? include('session.php');
    include('../connect.php');
	
	$kind=$_GET["kind"];
	$kind2=$_GET["kind2"];
	$cidstr=$_GET["cidstr"];
	
$kkk=explode(",",$cidstr);  
//echo sizeof($kkk);
//exit;  
for ($i=0;$i<=sizeof($kkk);$i++) {
    if ($kkk[$i]!="") {
        $eid=$kkk[$i];
            $sql="delete from tb_edm2 where eid=$eid";
            mysql_query($sql);
			
			$sql="delete from tb_edm where eid=$eid";
            mysql_query($sql);
		
	}
}

				echo "<script language=javascript>
				     alert ('刪除成功');
					 location.href=\"edm_list.php?kind2=$kind2&kind=$kind\";
					 </script>";
?>					 