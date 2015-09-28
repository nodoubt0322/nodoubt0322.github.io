<? include ("session.php"); 
include ("connect.php");

$totnumss=carhow($_POST["totnumss"]);

//echo $totnum."<BR>";   

$new_ppp="";
$new_qqq="";

for ($jjj=1;$jjj<=$totnumss;$jjj++)
{
	$apid=carhow($_POST["pid_".$jjj]);
	$aspec=carhow($_POST["spec_".$jjj]);
	$aqty=carhow($_POST["qty_".$jjj]);

	if ($apid!="" && $aqty!="")
	{
		$new_ppp.=$apid."＿＿".$aspec.",";
		$new_qqq.=$aqty.",";
   }   
}   

//echo $new_ppp."<BR>";
//echo $new_qqq."<BR>";
//exit;
if ($new_ppp!="") $_SESSION["bowchan_buy_pid"]=$new_ppp;
if ($new_qqq!="") $_SESSION["bowchan_buy_qty"]=$new_qqq;
?>
<script language=javascript>
        alert ("數量更改成功.");
        document.location.href="shopping.php";
</script>
