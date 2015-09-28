<?include ("session.php"); 
   include ("../connect.php");
$aidstr=$_GET["aidstr"];
$kkk=explode(",",$aidstr);  

//echo sizeof($kkk);
//exit;
   
for ($i=0;$i<=sizeof($kkk);$i++) {
if ($kkk[$i]!="") {
    $aid=$kkk[$i];
    $sql="select * from tb_main_banner where aid=$aid";
    $rs=mysql_query($sql);
    $totnum= mysql_num_rows($rs);  

    if ($totnum>0) {
        $row = mysql_fetch_array($rs);
        
        $standing=$row["standing"];
        
       
        $sql="delete from tb_main_banner where aid=$aid";
        mysql_query($sql);
    
        $sql="update tb_main_banner set standing=standing-1 where standing>$standing";
        mysql_query($sql);
    }	
	}
}

				echo "<script language=javascript>
					 location.href=\"main_banner.php\";
					 </script>";
?>

