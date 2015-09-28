<? session_start();
$nowfile=$_SERVER['PHP_SELF'];  
$ip=$_SERVER['REMOTE_ADDR']; 
//echo "Hello";
//exit;

$islogin="N";  //登入狀態
$ccc="Y";      //需登入才能使用

$myid="";
$mycid="";
$myname="";

$nnn=strtolower($nowfile);

if (strstr($nnn,"index.php")!="" || $nnn=="/" || $nnn=="")
{
    $ccc="N";
}

$share_flag="N";
if (strstr($nnn,"ordermemo.php")!="") $ccc="N";
if (strstr($nnn,"search.php")!="") $ccc="N";
if (strstr($nnn,"login.php")!="") $ccc="N";
if (strstr($nnn,"forgetpass.php")!="") $ccc="N";
if (strstr($nnn,"about.php")!="") $ccc="N";
if (strstr($nnn,"contacts.php")!="") $ccc="N";
if (strstr($nnn,"news.php")!="") $ccc="N";
if (strstr($nnn,"news2.php")!="") $ccc="N";
if (strstr($nnn,"news3.php")!="") $ccc="N";
if (strstr($nnn,"news-detail.php")!="") $ccc="N";

if (strstr($nnn,"organ.php")!="") $ccc="N";

if (strstr($nnn,"products.php")!="") $ccc="N";
if (strstr($nnn,"products-list.php")!="") $ccc="N";
if (strstr($nnn,"products-detail.php")!="") $ccc="N";
if (strstr($nnn,"faq.php")!="") $ccc="N";
if (strstr($nnn,"order-description.php")!="") $ccc="N";
//echo "nnn=".$nnn."<BR>";
//echo "ccc=".$ccc."<BR>";

if (isset($_SESSION["nod_id"]) && $_SESSION["nod_id"] != "") 
{
	    $islogin="Y";
		$myid=$_SESSION["nod_id"];
		$mycid=$_SESSION["nod_cid"];		
}
$isfblogin="N";
if (isset($_SESSION["nod_fb_id"]) && $_SESSION["nod_fb_id"] != "") //fb
{
	    $islogin="Y";
		$isfblogin="Y";
		$myid=$_SESSION["nod_fb_id"];
		$mycid=$_SESSION["nod_fb_name"]."【FB登入】";		
		//$mycid=$myid."【FB登入】";		
}

if ($ccc=="Y")
{
	if (isset($_SESSION["nod_id"]) && $_SESSION["nod_id"] != "") {
	    
	}else{
	    if (isset($_SESSION["nod_fb_id"]) && $_SESSION["nod_fb_id"] != "") {
	    
	   }else{
	?>
	       <script language=javascript>document.location.href="login.php";</script>
	<?     exit;
	   }	
	}
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">  
  <meta name="title" content="銀髮族(老人)照顧用品用具及醫療器材專業網站" />
  <meta name="description" content="LKK銀髮族全生涯照顧網：網站簡介" />
  <meta name="keywords" content="捐贈/醫療器材/紙尿褲/輔具/氣墊床/輪椅/電動病床/氧氣製造機/營養食品/居家照護/紫外線殺菌機" />
  <meta name="robots" content="all">
  <meta name="distribution" content="Taiwan">
  <meta name="distribution" content="global">
  <meta name="rating" content="general">
  <meta name="robots" content="index, follow"> 
  <meta name="revisit-after" content="1 days">
  <title>大內糕手 楊帝麵包坊</title>
  <link rel="stylesheet" href="css/layout.css">
  <link rel="stylesheet" href="css/ui.totop.css">
  <link rel="stylesheet" href="css/slick.css">
  <link rel="stylesheet" href="css/fonts/font-awesome.min.css">  
</head>

<body>
<?	include ("connect.php");

//瀏覽記錄
$today=date("Ymd");

$sql= "select * from tb_view where ip='$ip' and vdate='$today'";	
$rs=mysql_query($sql);
$findtot=mysql_num_rows($rs);

if ($findtot==0)
{
    mysql_query("insert into tb_view values('$ip','$today',now())");
}

//if ($ip=="42.71.123.113") { 

if (strstr($nnn,"shopping.php")=="")
{

	if ((isset($_SESSION["nod_id"]) && $_SESSION["nod_id"] != "") || (isset($_SESSION["nod_fb_id"]) && $_SESSION["nod_fb_id"] != ""))
	{
		$buy_pid=$_SESSION["nod_buy_pid"];
		$buy_qty=$_SESSION["nod_buy_qty"];
				  
		if ($buy_pid!="")
		{
			  $ccc=split(",",$buy_pid);
			  $qqq=split(",",$buy_qty);
			  $tot=0;
			  $tot_qty=0;
			  $ppp=0;
			  $nofee=0;
			  for ($i=0;$i<=sizeof($ccc);$i++)
			  {
				   if ($ccc[$i]!="")
				   {
					   $ppp++;
					   $pid=$ccc[$i];
					   $qty=$qqq[$i];  //數量
					   
					   $sql = "SELECT a.* FROM `tb_prod` a ".
							  "where a.pid=$pid and a.isshow='Y'";
					   $rs=mysql_query($sql);
					   $totnum= mysql_num_rows($rs);
					   $subject="";
					   $pic="";
					   $price="";
					   if ($totnum>0) {
						   $row = mysql_fetch_array($rs);  
						   $subject=$row["subject"];;				   
						   $price=$row["price"];
						   $tot=$tot+($price*$qty);
						   $tot_qty=$tot_qty+($qty);
						   $fee_include=$row["fee_include"];
				           if ($fee_include=="Y") $nofee=$nofee+$qty;
					   }
		?>
						<!---cart--->
						<div id="cart-shortcut">
						  <p>您目前挑選</p>
						  <p><span class="nt"><?=$tot_qty;?></span>個商品</p>
						  <p> <span class="nt"><?=number_format($tot);?></span>元</p>
						  <p><a href="shopping.php" class="go">查看</a></p>
						</div><!---cart--->
		<?     }
		   }
		}else{
?>
			<!---cart--->
			<div id="cart-shortcut">
			  <p>您目前挑選</p>
			  <p><span class="nt">0</span>個商品</p>
			  <p> <span class="nt">0</span>元</p>
			  <p><a href="shopping.php" class="go">查看</a></p>
		    </div><!---cart--->
<?      }
	}
}
//}
?>  

<div id="wrapper">
  <div id="header">
    <h1 class="logo"><a href="index.php"><img src="images/logo_new.jpg" height="144" alt="" /></a></h1>
    <div class="topmenu">
	<? if ((isset($_SESSION["nod_id"]) && $_SESSION["nod_id"] != "") || (isset($_SESSION["nod_fb_id"]) && $_SESSION["nod_fb_id"] != "")) { ?>
	        <?=$mycid;?> 您好，
		    <a href="logout.php" class="buttonstyle">登出</a> | 
			
			<? if (isset($_SESSION["nod_id"]) && $_SESSION["nod_id"] != "") { ?>
			       <a href="member.php">會員資料修改</a> | 
			<? } ?>
			
			<a href="order.php">訂單查詢</a> | <a href="index.php">回首頁</a>	
	<? }else{ ?>
	    <form name="upforms" action="login_check.php" method="post">
		<a href="#" class="buttonstyle">fb登入</a> | 帳號<span class="block">
		  <input name="cidd" type="text" class="fildform" id="cidd" />
		</span> 密碼<span class="block">
		<input name="passs" type="password" class="fildform" id="passs" />
		</span> <a href="javascript:checkqqq();" class="buttonstyle">登入</a> | <a href="login.php">註冊</a> | <a href="forgetpass.php">忘記密碼?</a> | <a href="index.php">回首頁</a>
		<script language="javascript">
				function checkqqq()
				{
							if (document.getElementById("cidd").value==""){
								alert ("請輸入帳號.");
								document.upforms.cidd.focus();
								return;
							}
							 
							 if (document.getElementById("passs").value==""){
								alert ("請輸入密碼.");
								document.upforms.passs.focus();
								return;
							}		                     
							document.forms['upforms'].submit();
				}
				</script>
			</form>
	<? } ?>
	</div>
            <ul class="menu">
                <li>
                    <a href="about.php" class="line">
                        <p>關於我們</p>
                    </a>
                </li>
                <li>
                    <a href="products-list.php?cid=4" class="line">
                        <p>線上購物</p>
                    </a>
                </li>
                <li>
                    <a href="member.php" class="line">
                        <p>會員系統</p>
                    </a>
                </li>
                <li>
                    <a href="news.php" class="line">
                        <p>最新消息</p>
                    </a>
                </li>
                <li>
                    <a href="order-description.php" class="line">
                        <p>訂購說明</p>
                    </a>
                </li>
                <li>
                    <a href="contacts.php">
                        <p>聯絡我們</p>
                    </a>
                </li>
            </ul>
  </div>
  <div id="content">
      <div class="banner" style="height:450px;">
          <div id="banner">
            <?
			    $sql="select * from tb_main_banner order by standing";
				$rs=mysql_query($sql);
				$totnum= mysql_num_rows($rs); 

                if ($totnum>0)
                { 	
				    while ( $row = mysql_fetch_array($rs)) 
					{
							$u=$row["url"];
							$o=$row["openkind"];
							
							$say="";
							if ($u!="")
							{
								if ($o=="1") $say=" target=\"_blank\"";
							}			
							?>
							<div>
							<?
							if ($u!="")
							{
							?>
								<a href="<?=$u;?>"<?=$say;?> title="<?=$row["subject"];?>">
							<? }else{ ?>			
								<a href="#" title="<?=$row["subject"];?>">
							<? } ?>
							<img src="pic/main_banner/<?=$row["pic"];?>" width="980" height="400" alt="" />
							</a></div>
							<?
					}
				} ?>
          </div> 
      </div><!--banner end-->
    