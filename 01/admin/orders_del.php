<?include ("session.php"); 
   include ("../connect.php"); 
   
   
   $srhono=$_POST["srhono"];
    if ($srhono=="") $srhono=$_GET["srhono"];

	$srhlevel=$_GET["srhlevel"];	  
   if ($srhlevel=="") $srhlevel=$_POST["srhlevel"];
   
$cidstr=$_GET["cidstr"];
	
$kkk=explode(",",$cidstr);  
//echo sizeof($kkk);
//exit;  
for ($i=0;$i<=sizeof($kkk);$i++) {
    if ($kkk[$i]!="") {
        $oid=$kkk[$i];
		
		//$sql="select * from tb_orders_detail where oid=$oid";
		//$rs=mysql_query($sql);
        
		//while ($row= mysql_fetch_array($rs))
		//{
		  //     $pid=$row["pid"]; 
			//   $num=$row["num"];
			  // mysql_query("update tb_prod set stock=stock+$num where pid=$pid");
		//}
		
		mysql_query("delete from tb_orders_detail where oid=$oid");
		mysql_query("delete from tb_orders where oid=$oid");
	}	
}

echo "<script language=javascript>
	 alert (\"刪除成功. \");
	 location.href=\"orders.php?srhono=$srhono&srhlevel=$srhlevel\";
	 </script>";
?>