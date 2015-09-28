<? session_start();
include ("connect.php");  ?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?
   $authnum=$_SESSION["nod_prodask_code"];
   $CAPTCHA=carhow($_POST["CAPTCHA"]);
   
   
   if ($authnum=="" || $CAPTCHA=="")
  {
?>
		<script language=javascript>
				document.location.href="index.php";
		</script>
<?
	    exit;	
  }
  
   if ($authnum!=$CAPTCHA)
   {
?>
		<script language=javascript>
				document.location.href="index.php";
		</script>
<?
	    exit;	
   }	  
  
   require("phpmailer/class.phpmailer.php");
   
   $subjectss=carhow($_POST["subject"]);
   $pid=carhow($_POST["pid"]);
  
   if ($pid=="")
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
	 
	 $rs=mysql_query($sql);
	 $totnum= mysql_num_rows($rs);
//echo $sql."<BR>";
//echo $totnum;
//exit;	 

	 if ($totnum==0)
	 {
?>
		<script language=javascript>
				document.location.href="index.php";
		</script>
<?
		   exit;	
	 }	
     $row = mysql_fetch_array($rs);
	 $pname=$row["subject"];
	 
   $cname=carhow($_POST["cname"]);
   $mobile=carhow($_POST["mobile"]);
  
   $email=carhow($_POST["email"]);
   $memo=carhow($_POST["memo"]);
   $memo=str_replace("\n","<BR>",$memo);
   
   $memo2=$memo;
  $sayA="<font color=blue><B>我們已經收的你的留言，我們會盡快回覆您</B></font>";
 
$say="<html><head>".
     "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />".
     "</head>".
     "<body>";

$say2=$say.$sayA."<BR><BR>";
	 
$sql="select * from tb_slogin";
$rs=mysql_query($sql);
$row = mysql_fetch_array($rs);
$wwwname=$row["wwwname"]; 
$cname222=$row["cname"]; 
$fromemail=$row["email"]; 
$wwwurl=$row["url"];

$say3="商品留言資料<BR><BR>".
     "商品名稱：<a href=\"".$wwwurl."/products-detail.php?pid=".$pid."\" target=\"_blank\">".$pname."</a><BR><BR>".
     "標題：".$subjectss."<BR><BR>".
     "尊姓大名：".$cname."<BR><BR>".
	 "行動電話：".$mobile."<BR><BR>".
	 "電子信箱：".$email."<BR><BR>".
	 "內容說明：<BR>".$memo2."<BR><BR>填寫時間:".date("Y/m/d H:i:s")."</body></html>";
	 
$sub = $wwwname."商品留言"; 

$sub = "=?UTF-8?B?" . base64_encode($sub) . "?=";
$subject = mb_convert_encoding($sub,"big5","utf-8"); 

//echo $say;	 
//exit;	 

$sql="INSERT INTO `tb_prod_ask` (`pid`,`subject`,`email`,`cname`,`mobile`,`memo`,`write_time`,`memo_reply`)  ".
     "VALUES ($pid,'$subjectss','$email','$cname','$mobile','$memo2',now(),'');";
//echo $sql;
//exit;	 
mysql_query($sql);

//給user
	$emails=$email;
	$mail = new PHPMailer();
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->IsHTML(true);
	$mail->Username = "nod_service@bloger.tw"; //設定驗證帳號        
$mail->Password = "xdfsx($%D"; //設定驗證密碼 
	$mail->Host = "localhost"; // SMTP server
	$mail->FromName = $cname222;
	$mail->From = $fromemail;
	$mail->AddAddress($emails);
	$mail->Subject = $subject;
	$mail->Body = $say2.$say3;
	$mail->CharSet = "utf-8";
	$mail->WordWrap = 50; 
	$mail->Encoding = "base64";
    $mail->Send();
	
//給管理員
$sql2="select * from tb_email where email<>''";
     $rs2=mysql_query($sql2);
while ($row2 = mysql_fetch_array($rs2)) 
{
	$emails=$row2["email"];
	$mail = new PHPMailer();
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->IsHTML(true);
$mail->Username = "nod_service@bloger.tw"; //設定驗證帳號        
$mail->Password = "xdfsx($%D"; //設定驗證密碼 
$mail->Host = "localhost"; // SMTP server
	$mail->FromName = $cname222;
	$mail->From = $fromemail;
	$mail->AddAddress($emails);
	$mail->Subject = $subject;
	$mail->Body = $say.$say3;
	$mail->CharSet = "utf-8";
	$mail->WordWrap = 50; 
	$mail->Encoding = "base64";
    $mail->Send();
}
unset($_SESSION["nod_prodask_code"]); 
?>
<script language=javascript>
        alert ("填寫成功,我們將儘快與您聯絡!");
        document.location.href="products-detail.php?pid=<?=$pid;?>";
</script>