<?include ("session.php"); 
   include ("../connect.php"); 
$cidstr=$_POST["cidstr"];
$kkk=explode(",",$cidstr);  

//echo sizeof($kkk);
//exit;
   
for ($i=0;$i<=sizeof($kkk);$i++) {
if ($kkk[$i]!="") {
    $cid=$kkk[$i];
	$s=$_POST["standing_".($i+1)];
	
	
        $sql="update tb_item_kind4 set standing=$s where cid=$cid";
		//echo $sql."<BR>";
        mysql_query($sql);	
}
}
//exit;
				echo "<script language=javascript>
					 location.href=\"item_kind4.php\";
					 </script>";
?>