<?include ("session.php"); 
   include ("../connect.php"); 
$cidstr=$_GET["cidstr"];
$kkk=explode(",",$cidstr);  

//echo sizeof($kkk);
//exit;
   
for ($i=0;$i<=sizeof($kkk);$i++) {
if ($kkk[$i]!="") {
    $cid=$kkk[$i];
    $sql="select * from tb_item_kind where cid=$cid";
    $rs=mysql_query($sql);
    $totnum= mysql_num_rows($rs);  

    if ($totnum>0) {
        $row = mysql_fetch_array($rs);
        
        $standing=$row["standing"];
        
       
        $sql="delete from tb_item_kind where cid=$cid";
        mysql_query($sql);
    
        $sql="update tb_item_kind set standing=standing-1 where standing>$standing";
        mysql_query($sql);
    }	
	}
}

				echo "<script language=javascript>
					 location.href=\"item_kind.php\";
					 </script>";
?>

