<?include ("session.php"); 
   include ("../connect.php");
$cidstr=$_POST["cidstr"];
//echo $cidstr;
//exit;
$kkk=explode(",",$cidstr);  

//echo sizeof($kkk);
//exit;
   
for ($i=0;$i<=sizeof($kkk);$i++) {
if ($kkk[$i]!="") {
    $pid=$kkk[$i];
	$s=$_POST["standing_".($i+1)];
	
	
        $sql="update tb_post set standing=$s where pid=$pid";
		//echo $sql."<BR>";
        mysql_query($sql);	
}
}
//exit;
				echo "<script language=javascript>
					 alert ('OK!');
					 location.href=\"post.php\";
					 </script>";
?>