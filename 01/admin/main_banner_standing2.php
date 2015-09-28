<?include ("session.php"); 
   include ("title.php");
$aidstr=$_POST["aidstr"];
$kkk=explode(",",$aidstr);  

//echo sizeof($kkk);
//exit;
   
for ($i=0;$i<=sizeof($kkk);$i++) {
if ($kkk[$i]!="") {
    $aid=$kkk[$i];
	$s=$_POST["standing_".($i+1)];
	
	
        $sql="update tb_main_banner set standing=$s where aid=$aid";
		//echo $sql."<BR>";
        mysql_query($sql);	
}
}
//exit;
				echo "<script language=javascript>
					 location.href=\"main_banner.php\";
					 </script>";
?>