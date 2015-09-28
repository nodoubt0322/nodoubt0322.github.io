<?php session_start();
$nowfile=$_SERVER['PHP_SELF']; 
//echo $nowfile;
//exit;
if ((isset($_SESSION["bowchan_id"]) && $_SESSION["bowchan_id"] != "") || (isset($_SESSION["bowchan_fb_id"]) && $_SESSION["bowchan_fb_id"] != "")){
}else{
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<form name="rtnform" action="login.php" method="post">
	<? if (strstr($nowfile,"/car_add.php")!="") { ?>
		   <input type=hidden name="backurl" value="products-detail.php?pid=<?=$_POST["pid"];?>">
	<? } ?>
	<script language=javascript>
			//alert ("請先登入");
			document.rtnform.submit();
	</script>
</form>
<?
    exit;
}

$islogin="N";
$isfblogin="N";

if (isset($_SESSION["bowchan_fb_id"]) && $_SESSION["bowchan_fb_id"] != "") //fb
{
    $isfblogin="Y";
	$myid=$_SESSION["bowchan_fb_id"];
	$mycid=$_SESSION["bowchan_fb_name"]."【FB登入】";	
}else{   
   $myid=$_SESSION["bowchan_id"];
   $mycid=$_SESSION["bowchan_cid"];
}

		

?>