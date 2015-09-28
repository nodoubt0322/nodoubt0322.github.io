<? include ("session.php"); 
include ("connect.php");  
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
$data=carhow($_GET["pid"]);

if ($data!="" && $_SESSION["bowchan_buy_pid"]!=""){
    $buy_pid=$_SESSION["bowchan_buy_pid"];
	$buy_qty=$_SESSION["bowchan_buy_qty"];

	$kkk=explode("_",$data);  
	$pid=$kkk[0];
	$spec=$kkk[1];

    $ccc=split(",",$buy_pid);
    $qqq=split(",",$buy_qty);

    $flag=-1;
   
    for ($i=0;$i<sizeof($ccc);$i++){
	     if ($ccc[$i]!=""){
		     $ddd=$ccc[$i];
             if ($ddd==$pid."＿＿".$spec){
                 $flag=$i;
             }
	     }	
    }
   
    $new_ccc="";
	$new_qqq="";
   
    for ($i=0;$i<sizeof($ccc);$i++)
	{
	     if ($ccc[$i]!="")
		 {
             if ($i!=$flag)
			 {
                 $new_ccc.=$ccc[$i].",";
		         $new_qqq.=$qqq[$i].",";
             }
	     }
    }
   
  // echo "buy_pid=".$new_ccc."<BR>";
   //echo "buy_qty=".$new_qqq."<BR>";
	//exit;	  
   $_SESSION["bowchan_buy_pid"]=$new_ccc;
   $_SESSION["bowchan_buy_qty"]=$new_qqq;
}
?>
<script language=javascript>
		//alert ("刪除成功!");
		document.location.href="shopping.php";
</script>
