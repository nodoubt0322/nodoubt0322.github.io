<?include ("session.php"); 
   include ("../connect.php");
   
      $srhcid=carhow($_GET["srhcid"]);
   if ($srhcid=="") $srhcid=carhow($_POST["srhcid"]);
   
   $srhccid=carhow($_GET["srhccid"]);
   if ($srhccid=="") $srhccid=carhow($_POST["srhccid"]);
   
   $srhcccid=carhow($_GET["srhcccid"]);
   if ($srhcccid=="") $srhcccid=carhow($_POST["srhcccid"]);
   
   $page=carhow($_GET["page"]);
   if ($page=="") $page=carhow($_POST["page"]);
   
   $page2=carhow($_GET["page2"]);
   if ($page2=="") $page2=carhow($_POST["page2"]);
   
   $pid=carhow($_GET["pid"]);
   if ($pid=="") $pid=carhow($_POST["pid"]);

   if ($pid=="")
   {
?>
        <script language=javascript>
		document.location.href="prod.php";
		</script>
<?	
       exit;
	}   

	$sql2 = "SELECT a.*,b.cname as cname2 FROM `tb_prod` a ".
		       "left join tb_item_kind b on a.cid=b.cid ".
			   "where a.pid=$pid";
//echo $sql2;
//exit;   		   
    $rs2=mysql_query($sql2);
	$totnum2= mysql_num_rows($rs2);
	if ($totnum2==0)
	{
?>
        <script language=javascript>
		document.location.href="prod.php";
		</script>
<?	
       exit;	
	}
	
$cidstr=$_GET["cidstr"];
$kkk=explode(",",$cidstr);  

//echo $cidstr;
//exit;
   
for ($i=0;$i<=sizeof($kkk);$i++) {
	if ($kkk[$i]!="") {
		$id=$kkk[$i];
		
		$sql="select * from tb_product2 where id=$id";
		$rs=mysql_query($sql);
		$totnum= mysql_num_rows($rs);  
//echo $id."<BR>";
		if ($totnum>0) {
			$row = mysql_fetch_array($rs);
			$standing=$row["standing"];
			$bbb=$row["pic"];
			
			 if ($bbb!="")
			 {
				 if (is_file("../pic/prod2/".$bbb)) {
					 unlink("../pic/prod2/".$bbb);
				 }	

				 if (is_file("../pic/prod2/s_".$bbb)) {
					 unlink("../pic/prod2/s_".$bbb);
				 }	   
				 
				 if (is_file("../pic/prod2/m_".$bbb)) {
					 unlink("../pic/prod2/m_".$bbb);
				 }
			 }
					 
			$sql="delete from tb_product2 where id=$id";
			mysql_query($sql);
		
			$sql="update tb_product2 set standing=standing-1 where pid=$pid and standing>$standing";
			mysql_query($sql);
		}	
	}
}
//exit;

				echo "<script language=javascript>
					 document.location.href=\"product2.php?pid=$pid&srhcid=$srhcid&srhccid=$srhccid&srhcccid=$srhcccid&page=$page&page2=$page2\";
					 </script>";
?>
