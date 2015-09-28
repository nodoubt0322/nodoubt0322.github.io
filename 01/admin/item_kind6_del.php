<?include ("session.php"); 
   include ("title.php");
$cidstr=$_GET["cidstr"];
$cid=$_GET["cid"];
$kkk=explode(",",$cidstr);  

//echo sizeof($kkk);
//exit;
   
for ($i=0;$i<=sizeof($kkk);$i++) {
if ($kkk[$i]!="") {
    $ccid=$kkk[$i];
    $sql="select * from tb_item_kind6 where ccid=$ccid";
    $rs=mysql_query($sql);
    $totnum= mysql_num_rows($rs);  

    if ($totnum>0) {
        $row = mysql_fetch_array($rs);
        
        $standing=$row["standing"];
        
        //$sql="delete from content where ccid=$ccid";
        //mysql_query($sql);
		
        //$sql="delete from penghu_product where ccid=$ccid";
        //mysql_query($sql);
		
        $sql="delete from tb_item_kind6 where ccid=$ccid";
        mysql_query($sql);
    
        $sql="update tb_item_kind6 set standing=standing-1 where cid=$cid and standing>$standing";
        mysql_query($sql);
    }	
	}
}

				echo "<script language=javascript>
					 location.href=\"item_kind6.php?cid=$cid\";
					 </script>";
?>
