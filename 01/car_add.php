<? include ("session.php");
include ("connect.php");

$pid=carhow($_POST["pid"]);
$qty=carhow($_POST["qty"]);
$spec=carhow($_POST["spec"]);
if ($pid=="" || $qty=="" || $spec=="")
 {
?>
	<script language=javascript>
			document.location.href="index.php";
	</script>
<?
	   exit;	
 }	
 
$sql = "SELECT a.*,b.cname as cn1,c.cname as cn2 FROM tb_prod a left join tb_item_kind b on a.cid=b.cid 
	         left join tb_item_kind2 c on a.ccid=c.ccid 
			 where a.pid=$pid and a.isshow='Y'";
 //echo $sql;
 //exit;
 $rs=mysql_query($sql);
 $totnum= mysql_num_rows($rs);
		
 if ($totnum==0)
 {
?>
	<script language=javascript>
			document.location.href="index.php";
	</script>
<?
	   exit;	
 }
 
 
 
//echo $pid."<BR>";
//echo $sizes."<BR>";
//echo $qty."<BR>";
//exit;

$cid=carhow($_GET["cid"]);
if ($cid=="") $cid=carhow($_POST["cid"]);

  $page=carhow($_GET["page"]);
if ($page=="") $page=carhow($_POST["page"]);
  
  $page2=carhow($_GET["page2"]);
if ($page2=="") $page2=carhow($_POST["page2"]);
  
$flag=carhow($_GET["flag"]);
if ($flag=="") $flag=carhow($_POST["flag"]);

  $keys=carhow($_GET["keys"]);
if ($keys=="") $keys=carhow($_POST["keys"]);

if (strstr(",".$_SESSION['bowchan_buy_pid'],",".$pid."＿＿".$spec.",")=="")
{
        
		$_SESSION["bowchan_buy_pid"].=$pid."＿＿".$spec.",";
        $_SESSION["bowchan_buy_qty"].=$qty.",";
?>
	   <script language="javascript">
			   //location.href="shopping01.php";
			   //alert ("已成功加入至購物車!");
			   document.location.href="shopping.php";
	   </script>
<? }else{ ?>
	   <script language="javascript">
			   alert ("選擇的商品規格已在購物車!");
			   document.location.href="shopping.php";
	   </script>
<? }
?>