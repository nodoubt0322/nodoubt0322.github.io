<? include ("session.php"); 
   include ("../connect.php");
   
$srhcid=$_GET["srhcid"];      
$srhcid2=$_GET["srhcid2"];      
$srhkind=$_GET["srhkind"];   
$cidstr=$_GET["cidstr"];
$kkk=explode(",",$cidstr);  

//echo sizeof($kkk);
//exit;
   
for ($i=0;$i<=sizeof($kkk);$i++) {
    if ($kkk[$i]!="") {
        $pid=$kkk[$i];
		$sql = "SELECT * FROM `tb_prod` where pid=$pid";

        $rs=mysql_query($sql);
        $totnum= mysql_num_rows($rs);  

        if ($totnum>0) 
		{   
            $row= mysql_fetch_array($rs);	
            $old_pic=$row["pic"];
			
			
            if (is_file("../pic/prod/".$old_pic)) {
				unlink("../pic/prod/".$old_pic);
			}	
			
			if (is_file("../pic/prod/s_".$old_pic)) {
					unlink("../pic/prod/s_".$old_pic);
			}	
				
			
	        $sql="delete from tb_prod where pid=$pid";
            mysql_query($sql);
		}	
	}
}
include ("prod_retorder.php"); 

				echo "<script language=javascript>
				     alert ('刪除成功');
					 location.href=\"prod.php?srhcid=$srhcid&srhcid2=$srhcid2&srhkind=$srhkind\";
					 </script>";
?>
