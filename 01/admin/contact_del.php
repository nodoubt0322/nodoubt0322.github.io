<? include ("session.php");  ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
   include ("../connect.php"); 
    
$cidstr=$_GET["cidstr"];
$kkk=explode(",",$cidstr);  

//echo sizeof($kkk);
//exit;
   
for ($i=0;$i<=sizeof($kkk);$i++) {
    if ($kkk[$i]!="") {
        $cid=$kkk[$i];
        $sql="delete from `tb_contact` where cid=$cid";
        mysql_query($sql);
	}
}

				echo "<script language=javascript>
					 alert ('刪除成功.');
					 location.href=\"contact.php\";
					 </script>";
?>
