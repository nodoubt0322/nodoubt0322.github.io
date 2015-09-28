<?include ("session.php"); 
   include ("title.php");
$cidstr=$_GET["cidstr"];
$cid=$_GET["cid"];
$kkk=explode(",",$cidstr);  

//echo $cidstr;
//exit;
   
for ($i=0;$i<=sizeof($kkk);$i++) {
if ($kkk[$i]!="") {
    $ccid=$kkk[$i];
	$s=$_POST["standing_".($i+1)];
	
	
        $sql="update tb_item_kind2 set standing=$s where cid=$cid and ccid=$ccid";
		//echo $sql."<BR>";
        mysql_query($sql);	
}
}
//exit;
				echo "<script language=javascript>
					 location.href=\"item_kind2.php?cid=$cid\";
					 </script>";
?>