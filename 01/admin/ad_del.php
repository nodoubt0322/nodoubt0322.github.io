<?include ("session.php"); 
   include ("../connect.php");
$aidstr=$_GET["aidstr"];
$kkk=explode(",",$aidstr);  

//echo sizeof($kkk);
//exit;
   
for ($i=0;$i<=sizeof($kkk);$i++) {
if ($kkk[$i]!="") {
    $aid=$kkk[$i];
    $sql="select * from tb_ad where aid=$aid";
    $rs=mysql_query($sql);
    $totnum= mysql_num_rows($rs);  

    if ($totnum>0) {
        $row = mysql_fetch_array($rs);
        $old_pic=$row["pic"];
        $standing=$row["standing"];
        
       if (is_file("../pic/sdfsxfv/".$old_pic)) {
       	    unlink("../pic/sdfsxfv/".$old_pic);
        }
		
        $sql="delete from tb_ad where aid=$aid";
        mysql_query($sql);
    
        $sql="update tb_ad set standing=standing-1 where standing>$standing";
        mysql_query($sql);
    }	
	}
}

				echo "<script language=javascript>
					 location.href=\"ad.php\";
					 </script>";
?>

