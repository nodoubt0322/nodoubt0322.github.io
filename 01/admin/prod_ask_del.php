<? include ("session.php"); 
   include ("../connect.php"); 
 
 $page=$_GET["page"];  
if ($page=="") $page=$_POST["page"];

$page2=$_GET["page2"];  
if ($page2=="") $page2=$_POST["page2"];

$srhcid=$_GET["srhcid"];  
if ($srhcid=="") $srhcid=$_POST["srhcid"];
 	
	$srhcid2=$_GET["srhcid2"];  
if ($srhcid2=="") $srhcid2=$_POST["srhcid2"];

$srhcid3=$_GET["srhcid3"];  
if ($srhcid3=="") $srhcid3=$_POST["srhcid3"];

$srhkind=$_GET["srhkind"];     
if ($srhkind=="") $srhkind=$_POST["srhkind"];

 $pid=$_GET["pid"];
if ($pid=="") $pid=$_POST["pid"];
 
$cidstr=$_GET["cidstr"];
$kkk=explode(",",$cidstr);  

//echo sizeof($kkk);
//exit;
   
for ($i=0;$i<=sizeof($kkk);$i++) {
    if ($kkk[$i]!="") {
        $cid=$kkk[$i];
        $sql="delete from `tb_prod_ask` where cid=$cid";
        mysql_query($sql);
	}
}

				echo "<script language=javascript>
					 alert ('刪除成功.');
					 location.href=\"prod_ask.php?pid=$pid&srhcid=$srhcid&srhkind=$srhkind&page=$page&page2=$page2\";
					 </script>";
?>
