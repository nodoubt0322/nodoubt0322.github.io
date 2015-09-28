<? include ("session.php"); 
   include ("../connect.php");
   
$srhcid=$_GET["srhcid"];      
$srhkind=$_GET["srhkind"];   
$cidstr=$_GET["cidstr"];
$kkk=explode(",",$cidstr);  

//echo sizeof($kkk);
//exit;
   
for ($i=0;$i<=sizeof($kkk);$i++) {
    if ($kkk[$i]!="") {
        $pid=$kkk[$i];
		$sql = "SELECT * FROM `tb_news4` where pid=$pid";

        $rs=mysql_query($sql);
        $totnum= mysql_num_rows($rs);  

        if ($totnum>0) {   
           $sql="delete from tb_news4 where pid=$pid";
            mysql_query($sql);
		}	
	}
}

				echo "<script language=javascript>
				     alert ('刪除成功');
					 location.href=\"news4.php?srhcid=$srhcid&srhkind=$srhkind\";
					 </script>";
?>
