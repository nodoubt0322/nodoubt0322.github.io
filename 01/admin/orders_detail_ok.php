<?include ("session.php"); 
   include ("../connect.php"); 
   
   $xxx=$_POST["xxx"];
   $srhono=$_POST["srhono"];
    if ($srhono=="") $srhono=$_GET["srhono"];
	
	$page=$_POST["page"];
    if ($page=="") $page=$_GET["page"];
	
	$page2=$_POST["page2"];
    if ($page2=="") $page2=$_GET["page2"];

	$srhlevel=$_GET["srhlevel"];	  
   if ($srhlevel=="") $srhlevel=$_POST["srhlevel"];
   
$oid=$_POST["oid"]; 
$out_date=$_POST["out_date"]; 
$cidstr=$_POST["cidstr"]; 
$old_status=$_POST["old_status"]; 
$status=$_POST["status"]; 
$status_money=$_POST["status_money"]; 
$packageno=$_POST["packageno"]; 
$memo1=$_POST["memo1"]; 

$addsay="";

if ($out_date!="") $addsay=",out_date='$out_date' ";

$sql="update tb_orders set status='$status',
      packageno='$packageno',memo1='$memo1',
	  status_money='$status_money',
	  deal_time=now()$addsay where oid=$oid";
mysql_query($sql);


for ($i=1;$i<=$xxx;$i++)
{
    $ooid=carhow($_POST["ooid_".$i]);
	$dd=carhow($_POST["delme".$i]);
	$m=carhow($_POST["memo_prod".$i]);
	
	$sql="update tb_orders_detail set memo='$m',islack='$dd' where oid=$oid and ooid=$ooid";
	mysql_query($sql);
}
//echo $oid."<BR>";
//echo $cidstr."<BR>";
//echo $status."<BR>";
//echo $status_money."<BR>";
//echo $packageno."<BR>";
//echo $memo1."<BR>";
//echo $sql."<BR>";
//exit;

	//echo "<script language=javascript>
		// alert (\"修改成功. \");
		// location.href=\"orders_detail.php?oid=$oid&srhono=$srhono&srhlevel=$srhlevel&page=$page&page2=$page2\";
		// </script>";
//exit;

if ($old_status=="N" && $status=="Y"){
	//============================================================================================================
	$sql="select * from tb_orders where oid=$oid";
    $rs=mysql_query($sql);
    $totnum= mysql_num_rows($rs);

    if ($totnum==0) {
 ?>
   <script language=javascript>
   location.href="orders.php";
   </script>
<?    exit;
    }
	
	$row= mysql_fetch_array($rs);	
	$ono=$row["ono"];
	$tot=$row["tot"];	
$fee=$row["fee"];	
$amount=$row["amount"];	
$out_date=$row["out_date"];
	
$status=$row["status"];	
$status_money=$row["status_money"];	
$packageno=$row["packageno"];	
$memo_order=$row["memo"];	
$memo1=$row["memo1"];	
$deal_time=$row["deal_time"];	

$ono=$row["ono"];
$paykind=$row["paykind"];
$sid=$row["sid"];
$get_time=$row["get_time"];
$cname=$row["cname"];
$tel=$row["tel"];

$zip=$row["zip"];
$city=$row["city"];
$town=$row["town"];
$addr=$row["addr"];


$order_time=$row["order_time"];
$order_date=$row["order_date"];
$rec_time=$row["rec_time"];

$memo=$row["memo"];


$paykind_say="";

if ($paykind=="1") $paykind_say="貨到付款";
if ($paykind=="2") $paykind_say="ATM轉帳";
if ($paykind=="3") $paykind_say="銀行匯款";	
if ($paykind=="4") $paykind_say="門市取貨付款";

$member_id=$row["member_id"];	

$sql2="select * from tb_member where id=$member_id";
$rs2=mysql_query($sql2);
$row2= mysql_fetch_array($rs2);
$email=$row2["email"];
//echo $email;
//exit;

	$sql2="select * from tb_zipcode where zip='$zip'";
	$rs2=mysql_query($sql2);
	$row2= mysql_fetch_array($rs2);
	$city=$row2["country"];
	$town=$row2["town"];
					  
	$sql3="select * from tb_zipcode where zip='$zip2'";
	$rs3=mysql_query($sql3);
	$row3= mysql_fetch_array($rs3);
	$city2=$row3["country"];
	$town2=$row3["town"];

	
$buy_pid="";
$buy_qty="";

				
	$sql4="select * from tb_orders_detail where oid=$oid order by ooid";
    $rs4=mysql_query($sql4);      
    while ( $row4 = mysql_fetch_array($rs4)) {
            $buy_pid.=$row4["pid"]."＿＿".$row4["sizes"]."＿＿^^＿＿".$row4["ooid"]."＿＿".$row4["price"]."＿＿".$row4["pname"]."＿＿".$row4["islack"]."＿＿".$row4["memo"].",";
            $buy_qty.=$row4["num"].",";	
	}
$ccc=split(",",$buy_pid);
      $qqqq=split(",",$buy_qty);
	
	$data="<center>
		       <table border=\"0\" width=\"850\"><tr><td align=left>訂單編號:".$ono."</td></tr>
			    <tr>
                    <td align=left>訂購時間:<font color=black>".$order_time."</td>
				</tr>	
			   </table>
		       <table cellpadding=\"0\" cellspacing=\"0\" border=\"1\" width=\"850\">
				<tr bgcolor=lightblue>
				  <th>NO</th>
				  <th>產品名</th>
				  <th>價格</th>
				  <th>數量</th>
				  <th>小計</th>
				  <th>缺貨</th>
				  <th>備註</th>
				</tr>";
				
		  $xxx=0;  
		  
		  for ($i=0;$i<=sizeof($ccc);$i++)
		  {
			   if ($ccc[$i]!="")
			   {
				   $c=split("＿＿",$ccc[$i]);
				   
				   $price=$c[4];     //訂購明細-價格
				   $ooid=$c[3];     //訂購明細-編號
				   $pid=$c[0];      //購買的商品編號
				   $bbb=$c[1];      //購買的尺寸(第幾個)
				   $islack=$c[6];
				   $memo=$c[7];
				   //echo $pid."<BR>";
				   //echo $g."<BR>";
				   
				   //$bb=split("_",$g);
				   //$bbb=$bb[0];     
				   
				   $aqty=$qqqq[$i]; //數量
				   
				   $subject=$c[5];
				   
				   
				   $xxx++;
				   $sel="";
				   if ($islack	=="Y") $sel=" checked";
					
					$data.="<input type=hidden name=\"ooid_".$xxx."\" id=\"ooid_".$xxx."\" value=\"".$ooid."\">
					  <tr align=\"center\">
					  <td>".substr("00".$xxx,-3)."</td>
					  <td>".$subject."</td>
					  <td>".number_format($price)." 元</td>
					  <td>".number_format($aqty)."</td>
					  <td>".number_format($price*$aqty)." 元</td>
					  <td><input type=checkbox name=\"delme".$xxx."\" id=\"delme".$xxx."\" value=\"Y\"".$sel."> </td>
					  <td><input type=text name=\"memo_prod".$xxx."\" id=\"memo_prod".$xxx."\" value=\"".$memo."\" size=40> </td>
					</tr>";  
					}							
				  }  
      
	     $data.="</table>
			  <table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"850\">
				<tr>
				  <td align=\"right\">
				  總和&nbsp;&nbsp;&nbsp;<span>".number_format($tot)." 元</span><br />";
												
		 if ($dis>0){ 
			   $data.="折扣&nbsp;&nbsp;&nbsp;<span>-".number_format($dis)." 元</span><br />";
		 } 
		
		 $data.="<input type=hidden name=\"xxx\" id=\"xxx\" value=\"".$xxx."\">運費&nbsp;&nbsp;&nbsp;<span>".number_format($fee)." 元</span><br />
					商品金額總計&nbsp;&nbsp;&nbsp;<span>".number_format($tot-$dis+$fee)." 元</span>
					  </td>
					</tr>
				  </table><HR width=850>
				  <table width=850 align=center border=1\">
					
				<tr>
				  <td  bgcolor=lightblue>收件人資料</td>
				  </tr>
					
				  <tr>
						  <td>姓名 / ".$cname;

$sqlp="select * from tb_slogin";
$rsp=mysql_query($sqlp);
$rowp = mysql_fetch_array($rsp);
$wwwname=$rowp["wwwname"]; 
$cname222=$rowp["cname"]; 
$fromemail=$rowp["email"]; 
$wwwurl=$rowp["url"]; 				
	    $data.="</td></tr>
			  <tr><td>電話 / ".$tel."     </td></tr>
			  <tr><td>Email / ".$email."     </td></tr>
			  <tr><td>給商家的話 / <BR> ".str_replace("\r\n","<BR>",$memo_order)."     </td></tr>
			  <tr><td>付款方式 / ".$paykind_say."</td></tr>";
			  
           $data.="　送貨住址 / ".$zip." ".$city.$town.$addr;
		
		
		$data.="</td></tr></table>";
	//============================================================================================================
	
	 $data1="<p align=left>處理備註:".$memo1.
			 "<BR><BR>寄出日期:".$out_date.
			 "<BR><BR>包裹編號:".$packageno.
			 "<BR><BR>訂單處理時間:".date('Y-m-d H:i:s')."<BR><BR>";
	
	$data=$data.$data1;
									
	$data.="<BR><BR>".$wwwname."　".$wwwurl;
//echo $data;
//exit;	
	require("phpmailer/class.phpmailer.php");
	
	$sub = "商品已為您寄出"; 
	
	$sub = "=?UTF-8?B?" . base64_encode($sub) . "?=";

	$mail = new PHPMailer();
	$subject = mb_convert_encoding($sub,"big5","utf-8"); 
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->IsHTML(true);
$mail->Username = "nod_service@bloger.tw"; //設定驗證帳號        
$mail->Password = "xdfsx($%D"; //設定驗證密碼 
$mail->Host = "localhost"; // SMTP server
	$mail->FromName = $cname222;
	$mail->From = $fromemail;
	
	//$email="carhow@gmail.com";
	
	$mail->AddAddress($email);
	$mail->Subject =" $subject";
	$mail->Body = $data;
	$mail->CharSet = "utf-8";
	$mail->WordWrap = 50; 
	$mail->Encoding = "base64";

	if($mail->Send()) 

	//echo $data;
	//exit;
	
	$sql="update tb_orders set status='$status',deal_time=now(),memo1='$memo1',memo2='$memo2' where oid=$oid";
	mysql_query($sql);
}

echo "<script language=javascript>
 alert (\"修改成功. \");
 location.href=\"orders.php?srhono=$srhono&srhlevel=$srhlevel&page=$page&page2=$page2\";
 </script>";
?>