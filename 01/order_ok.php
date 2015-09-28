<? include('session.php'); 
   include('connect.php');
  ?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?
   
   $mycid2=$mycid;

$buy_pid=$_SESSION["bowchan_buy_pid"];
$buy_qty=$_SESSION["bowchan_buy_qty"];


$paykind=carhow($_POST["paykind"]);

		
if ($buy_pid=="" || $buy_qty=="" || $paykind=="") {
		?>
			<script language=javascript>
			//document.location.href="products.php";
			</script>
		<?  echo "1";
			exit;
		}
		//exit;
		$zip=carhow($_POST["zip"]);
		$cname=carhow($_POST["cname"]);
		
		$tel=carhow($_POST["tel"]);
		$mobile=carhow($_POST["mobile"]);
		$email=carhow($_POST["email"]);
		$addr=carhow($_POST["addr"]);
		$gettime=carhow($_POST["gettime"]);
		
		$memo=carhow2($_POST["memo"]);
		if ($memo!="")
		{
			$memo=str_replace("\r\n","<BR>",$memo);
		}
		
		if ($zip=="" || $cname=="" || $email=="" || $addr=="" || $gettime=="") {
		?>
			<script language=javascript>
			//document.location.href="products.php";
			</script>
		<?  echo "2";
			exit;
		}

		//台東縣綠島鄉951
	  $zipdata="209,210,211,212,880,881,882,883,884,885,890,891,892,893,894,896,951,";
	  $sayyy="(本島)";
	  if ($zip!="")
	  {
		  if (strstr($zipdata,$zip.",")!="")
		  {
			  $sayyy="(外島)";
		  }
	  }
	  
		$sql="select * from tb_zipcode where zip='$zip'";
		//echo $sql;
		//exit;
		$rs=mysql_query($sql);
		$row= mysql_fetch_array($rs);
		$city=$row["country"];
		$town=$row["town"];

$sql="select * from tb_slogin";
$rs=mysql_query($sql);
$row = mysql_fetch_array($rs);
$wwwname=$row["wwwname"]; 
$cname222=$row["cname"]; 
$fromemail=$row["email"]; 
$wwwurl=$row["url"]; 

$fee1=0;
	$fee111=0;
	$fee2=0;
	$fee11=$row["fee11"]; 
	$fee111=$row["fee111"];
	$fee12=$row["fee12"];  
	
	if ($zip!="")
	{
		if (strstr($zipdata,$zip.",")!="")
		{
			$fee11=$fee111;
		}
	}
	$paykind1=$row["paykind1"]; 
	$paykind2=$row["paykind2"]; 
	$paykind3=$row["paykind3"];
	$paykind4=$row["paykind4"];
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$today=date("Ymd");

	 $sql2="select max(ono) as mono from tb_orders where ono like '$today%'";
     $rs2=mysql_query($sql2);
     $findtot2=mysql_num_rows($rs2);

     if ($findtot2==0){	 
	     $mono=$today."001";
	 }else{
         $row2 = mysql_fetch_array($rs2);
         $mono=$row2["mono"];
		 $t=substr($mono,-3);
		 $t=((int)$t)+1;
		 $t=substr("00".$t,-3);
		 $mono=$today.$t;
	 }	 
//echo $mono;
//exit;	 
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	 
      $ccc=split(",",$buy_pid);
      $qqqq=split(",",$buy_qty);
      
	    $say="";
	    if ($paykind=="1") $say="貨到付款(另加運費:".$fee12."元)";
		if ($paykind=="2") $say="ATM轉帳";
		if ($paykind=="3") $say="銀行匯款";
if ($paykind=="4") $say="門市取貨付款";

      $data="訂單編號:".$mono."<BR><BR>
	         訂購時間:".date('Y-m-d H:i:s')."<BR><BR>
			 付款方式:".$say."<BR><BR>";
			 
	  $data.="<table width=\"100%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
              <tr bgcolor=lightblue>
               <td>商品名稱</td>
                <td>數量</td>
                <td>單價</td>
                <td>小計</td>
              </tr>";
			  
if ($buy_pid!="")
{
	  $ccc=split(",",$buy_pid);
	  $qqq=split(",",$buy_qty);
	  $tot=0;
	  $tot_qty=0;
	  $nofee=0;
      for ($i=0;$i<=sizeof($ccc);$i++)
	  {
	       if ($ccc[$i]!="")
		   {
		        $ddd=split("＿＿",$ccc[$i]);
			   $pid=(int)$ddd[0];
			   $spec=(int)$ddd[1];
			   $qty=$qqq[$i];  //數量
			   
			   //$tot_qty=$tot_qty+(int)$qty; //總數量
			   //$tot=$tot+((int)$price*(int)$qty); //總金額
			   
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
				   $pic=$row["pic"];
				   
				   $prices=$row["price"];
				   $zzz=split(",",$prices);
				   $price=$zzz[$spec];
						   
				   $tot=$tot+($price*$qty);
				   $tot_qty=$tot_qty+($qty);
				   $fee_include=$row["fee_include"];
				   if ($fee_include=="Y") $nofee=$nofee+$qty;
				   $c=split(",",$row["spec"]);
					$spec_memo=$c[$spec];
			   }
			   		  
              $data.="<tr>
               <td>".$subject."(".$spec_memo.")</td>
                <td>".$qty."</td>
                <td>".number_format($price)."</td>
                <td>".number_format($price*$qty)."</td>
              </tr>";
              }
           }
   }
  $fee=0;
	
	//echo $tot."<BR>";
	//echo $fee11."<BR>";
	//echo $fee111."<BR>";
	//echo (int)$tot<(int)$fee11."<BR>";
	
	if ((int)$tot<(int)$fee11) 
	{
	   $fee=$fee111;
	}
   $feesay="";
            $data.="</table>
			        <BR><BR>
            <div class=\"settle\">
            <table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
              <tr>
                <td width=\"9%\">小計</td>
                <td width=\"1%\">&nbsp;</td>
                <td width=\"26%\">付款方式</td>
                <td width=\"1%\">&nbsp;</td>
                <td width=\"20%\">運費</td>
                <td width=\"2%\">&nbsp;</td>
                <td width=\"19%\">應付金額</td>
              </tr>
              <tr>
                <td class=\"rnt font-b\">".number_format($tot)."</td>
                <td>+</td>
                <td>";
				
				if ($paykind=="1"){
				      $data.="貨到付款(另加收手續費:".$fee12."元)";
					  $feesay="(".$fee."+".$fee12.")";
					  
				}  
				
                if ($paykind=="2"){ 
				      $data.="ATM轉帳";
					  $fee12=0;
				}  
				
				if ($paykind=="3"){ 
				      $data.="銀行匯款";
					  $fee12=0;
				}
				 
				if ($paykind=="4"){ 
				      $data.="門市取貨付款";
					  $fee12=0;
				}
				$data.="</td>
                <td>+</td>
                <td>
                  ".number_format($fee+$fee12)."元".$feesay."</td>
                <td>=</td>
                <td>NT$<span class=\"nt\">".number_format($tot+$fee+$fee12)."</span></td>
              </tr>
            </table>
			<div>
            </div>
			</div>
			<BR><BR>
			<table width=\"100%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                <tr>
                  <td colspan=\"2\">收件人資料</td>
                </tr>
                <tr>
                  <td bgcolor=lightblue width=\"19%\">帳號</td>
                  <td width=\"81%\">";
				  
				  $e=$email;
				  $ee=explode("@",$e); 
                  $eee=substr($ee[0],0,3)."****@".$ee[1];
				  
				  //$data.=$eee."</td>
				  $data.=$email."</td>
                </tr>
                <tr>
                  <td bgcolor=lightblue>收件人姓名</td>
                  <td>".$cname."</td>
                </tr>
                <tr>
                  <td bgcolor=lightblue>收件人電話</td><td>";
				  
				  //if ($tel!="") $data.=mb_substr($tel,0,1,"utf-8")."******";
				  if ($tel!="") $data.=$tel;
				  
				  $data.="</td>
                </tr>
                <tr>
                  <td bgcolor=lightblue>收件人手機</td>
                  <td>";
				  
				   //if ($mobile!="") $data.=mb_substr($mobile,0,4,"utf-8")."******";
				   if ($mobile!="") $data.=$mobile;
				   
                $data.="</td></tr>
                <tr>
                  <td bgcolor=lightblue>地址</td>
                  <td>".$zip."　".$city.$town.$addr."
                  </td>
                </tr>
                <tr>
                  <td bgcolor=lightblue>收貨時間</td>
                  <td>";
				  
				if ($gettime=="1") $data.="上午";
				if ($gettime=="2") $data.="下午";
				if ($gettime=="3")$data.="晚上";
				
				  $data.="</td>
                </tr><tr>
                  <td bgcolor=lightblue>備註</td>
                  <td><p>
                    ".$memo."
                  </p></td>
                </tr>
              </table>";

$data.="<p></p><p></p><p>";			   
			   
				if ($paykind=="1"){
				
				    $data.=$paykind1;
				}
				
				if ($paykind=="2"){
				
				    $data.=$paykind2;
				} 
				
				if ($paykind=="3"){
				
				    $data.=$paykind3;
				} 

if ($paykind=="4"){
				
				    $data.=$paykind4;
				} 
				
			   $data.="</p>
                        <p align=left>".$wwwname."　".$wwwurl."</p>";	  
//echo $data;
//exit; 

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$all=$tot+$fee+$fee12;

$ip=$_SERVER['REMOTE_ADDR'];
  
$fbid="";  
$fbname="";
if ($_SESSION["bowchan_isfb"]=="Y")
{
    $fbid=$_SESSION["bowchan_fb_id"];
	$email=$_SESSION["bowchan_fb_email"];
	$fbname=$_SESSION["bowchan_fb_name"];
	$myid="-1";
}	
  
    $sql="insert into `tb_orders` (`ono`,`member_id`,`tot`,`fee1`,`fee2`,`amount`,
	     `cname`,`tel1`,`tel`,`mobile`,`zip`,`city`,`town`,
		 `addr`,`paykind`,`gettime`,`status`,`order_time`,
		 `memo1`,`memo`,`ip`,`status_money`,`packageno`,`fbname`,`fbid`,`fiveno`) 
		 values ('$mono',$myid,$tot,$fee,$fee12,$all,'$cname','',
		 '$tel','$mobile','$zip','$city','$town',
		 '$addr','$paykind','$gettime','N',now(),'','$memo','$ip','N','','$fbname','$fbid','')";  
	//echo $sql;
	//exit;

	mysql_query($sql);	
	
	 if ($_SESSION["bowchan_isfb"]=="Y")
	 {
	     $sql2="select max(oid) as moid from tb_orders where fbid='$fbid'";
	 }else{
         $sql2="select max(oid) as moid from tb_orders where member_id=$myid";	 
	 }
	 
	 $rs2=mysql_query($sql2);
	 $row2= mysql_fetch_array($rs2);
	 $oid=$row2["moid"];
	 
	 for ($i=0;$i<=sizeof($ccc);$i++)
	 {
	       if ($ccc[$i]!="")
		   {
		       $ddd=split("＿＿",$ccc[$i]);
			   $pid=(int)$ddd[0];
			   $spec=(int)$ddd[1];
			   $qty=$qqq[$i];  //數量
	
	           
			   $am=0;
			   
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
				   $pic=$row["pic"];
				   
				   $prices=$row["price"];
						   $zzz=split(",",$prices);
						   $price=$zzz[$spec];
						   
				   $am=(int)$qty*(int)$price;
				   $c=split(",",$row["spec"]);
					$spec_memo=$c[$spec];
			   }
				
			   $sql="insert into tb_orders_detail (`oid`,`pid`,`spec`,`pname`,`num`,`price`,`amount`,`islack`,`memo`) 
					values($oid,$pid,'$spec_memo','$subject',$qty,$price,$am,'N','')";
//echo $sql;
//exit;					
			   mysql_query($sql);
			   
			   //$sql="update tb_prod set stock=stock-$qty where pid=$pid";
			   //mysql_query($sql);
		   }
    }	
   
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	require("phpmailer/class.phpmailer.php");

	if ($_SESSION["bowchan_isfb"]=="Y")
	{
	    $mobile="";
	}else{
		$sql="select * from tb_member where cid='$mycid'";
		$rs=mysql_query($sql);
		$row= mysql_fetch_array($rs);

		$email=$row["email"];
		$mobile=$row["mobile"];
	}
   //$email="carhow@gmail.com";
	$sub = $wwwname."訂單內容"; 
	$sub = "=?UTF-8?B?" . base64_encode($sub) . "?=";
	$subject = mb_convert_encoding($sub,"big5","utf-8"); 

	//echo $email;
	//exit;
	if ($email!="")
	{
		$mail = new PHPMailer();
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->IsHTML(true);
$mail->Username = "bowchan_service@bloger.tw"; //設定驗證帳號        
$mail->Password = "xdfsx($%D"; //設定驗證密碼 
$mail->Host = "localhost"; // SMTP server
		$mail->FromName = $cname222;
		$mail->From = $fromemail;
		$mail->AddAddress($email);
		$mail->Subject =" $subject";
		$mail->Body = $data;
		$mail->CharSet = "utf-8";
		$mail->WordWrap = 50; 
		$mail->Encoding = "base64";
		$mail->Send();
	}

	//給管理員
	$sql2="select * from tb_email where email<>''";
	$rs2=mysql_query($sql2);
	while ($row2 = mysql_fetch_array($rs2)) 
	{
		$emails=$row2["email"];
		$mail = new PHPMailer();
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->IsHTML(true);
$mail->Username = "bowchan_service@bloger.tw"; //設定驗證帳號        
$mail->Password = "xdfsx($%D"; //設定驗證密碼 
$mail->Host = "localhost"; // SMTP server
		$mail->FromName = $cname222;
		$mail->From = $fromemail;
		$mail->AddAddress($emails);
		$mail->Subject =" $subject";
		$mail->Body = $data;
		$mail->CharSet = "utf-8";
		$mail->WordWrap = 50; 
		$mail->Encoding = "base64";
		$mail->Send();
	}
	
	unset($_SESSION["bowchan_buy_pid"]); 
	unset($_SESSION["bowchan_buy_qty"]);
?>	
		   <script language=javascript> 
				alert ("訂購成功,我們將儘快處理您的訂單");
				document.location.href="order.php";
		   </script>

	 