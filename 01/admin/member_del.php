<? include ("session.php"); 
   include ("../connect.php"); 
    ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<? 

$keys=$_GET["keys"];
$id=$_GET["id"];

$sql = "SELECT * from tb_member where id=$id";  
//echo $sql;
//exit;
$rs=mysql_query($sql);
$totnum= mysql_num_rows($rs);
	
if ($totnum>0) 
{	 
   while ($row= mysql_fetch_array($rs))
   {
          $cid=$row["cid"]; 
   }
}
   
   $srhdate1=$_POST["srhdate1"];
   if ($srhdate1=="") $srhdate1=$_GET["srhdate1"];
   
   $srhdate2=$_POST["srhdate2"];
   if ($srhdate2=="") $srhdate2=$_GET["srhdate2"];
   
   $srhlevel=$_POST["srhlevel"];
   if ($srhlevel=="") $srhlevel=$_GET["srhlevel"];
   
   $srhstatus=$_POST["srhstatus"];
   if ($srhstatus=="") $srhstatus=$_GET["srhstatus"];
   
   $srhtime1=$_POST["srhtime1"];
   if ($srhtime1=="") $srhtime1=$_GET["srhtime1"];
   
   $srhtime2=$_POST["srhtime2"];
   if ($srhtime2=="") $srhtime2=$_GET["srhtime2"];
   
$sql = "SELECT * from tb_orders where cid='$cid'";  
//echo $sql;
//exit;
$rs=mysql_query($sql);
$totnum= mysql_num_rows($rs);
	
if ($totnum>0) 
{	 
   while ($row= mysql_fetch_array($rs)){
        $oid=$row["oid"];
		
		$sql = "delete from tb_order_detail where oid=$oid";			   
		$rs=mysql_query($sql);	  
		
	    $sql = "delete from tb_orders where oid=$oid";			   
		$rs=mysql_query($sql);	  		
   }
   
    
}	


$sql="delete from tb_member where id=$id";
    mysql_query($sql);
?>
<script language=javascript>
        alert ("刪除成功..");
        document.location.href="member.php?srhdate1=<?=$srhdate1;?>&srhdate2=<?=$srhdate2;?>&srhlevel=<?=$srhlevel;?>&srhstatus=<?=$srhstatus;?>&srhtime1=<?=$srhtime1;?>&srhtime2=<?=$srhtime2;?>&keys=<?=$keys;?>";
</script>
