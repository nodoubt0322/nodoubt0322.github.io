<? include ("connect.php");   ?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?


$email=carhow($_POST["email"]);
$pass="";

$sql= "select * from tb_member where cid = '$email'";	
$rs=mysql_query($sql);
$findtot=mysql_num_rows($rs);

if ($findtot>0){   
   $row = mysql_fetch_array($rs);
   if ($row["email"]==$email) $pass=$row["pass"];
}

if ($pass==""){
	echo "<script>alert('Email輸入不正確!') </script>";
	echo "<script>history.go(-1);</script>";
	exit;
}

require("phpmailer/class.phpmailer.php");

$sql="select * from tb_slogin";
$rs=mysql_query($sql);
$row = mysql_fetch_array($rs);
$wwwname=$row["wwwname"]; 
$cname222=$row["cname"]; 
$fromemail=$row["email"]; 
$wwwurl=$row["url"]; 

$say="<html><head>".
     "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />".
     "</head>".
     "<body>".
     $cid."　您好，您登入的密碼為：".$pass."<BR><BR>".
	 "<a href=\"".$wwwurl."/login.php\">移至".$wwwname."登入頁</a>".
	 "</body></html>";
	 
$sub = $wwwname."-登入密碼通知"; 
$sub = "=?UTF-8?B?" . base64_encode($sub) . "?=";
$subject = mb_convert_encoding($sub,"big5","utf-8"); 

     
	 $fromname=$cname222;
	 
	
	$mail = new PHPMailer();
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->IsHTML(true);
$mail->Username = "bowchan_service@bloger.tw"; //設定驗證帳號        
$mail->Password = "xdfsx($%D"; //設定驗證密碼 
$mail->Host = "localhost"; // SMTP server
	$mail->FromName = $fromname;
	$mail->From = $fromemail;
	$mail->AddAddress($email);
	$mail->Subject = $subject;
	$mail->Body = $say;
	$mail->CharSet = "utf-8";
	$mail->WordWrap = 50; 
	$mail->Encoding = "base64";
    $mail->Send();
?>
<script language=javascript>
        alert ("已將密碼寄至您註冊的信箱!");
		document.location.href="login.php";
</script>	
