<?include ("session.php"); 
   include ("../connect.php"); 
$cidstr=$_POST["cidstr"];
$srhcid=$_GET["cid"];
$srhcid2=$_GET["ccid"];
$s_flag=$_GET["s_flag"];
$kkk=explode(",",$cidstr);  

//echo $srhcid."<BR>";
//echo $srhcid2."<BR>";
//exit;
   
for ($i=0;$i<=sizeof($kkk);$i++) {
if ($kkk[$i]!="") {
    $pid=$kkk[$i];
	$s=$_POST["standing".$s_flag."_".($i+1)];
	
	
        $sql="update tb_prod set standing$s_flag=$s where pid=$pid";
		//echo $sql."<BR>";
        mysql_query($sql);	
}
}
//exit;
				echo "<script language=javascript>
					 alert ('更改成功');
					 location.href=\"prod.php?srhcid=$srhcid&srhcid2=$srhcid2\";
					 </script>";
?>