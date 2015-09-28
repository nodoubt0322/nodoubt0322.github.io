<? require("phpmailer/class.phpmailer.php");


$say="<html><head>".
     "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />".
     "</head>".
     "<body>".
	 "<font size=5 color=blue><B>此為系統發測試信，請勿直接回信 *</B></font>".
	 "</body></html>";
	 
$sub = "測試信"; 
$sub = "=?UTF-8?B?" . base64_encode($sub) . "?=";

//$fromemail="carhow@ms94.url.com.tw";
//$fromemail="carhow@gmail.com";
$cname2="carhow";
$fromemail="carhow@gmail.com";
$email=$fromemail;
	 
$mail = new PHPMailer();
$subject = mb_convert_encoding($sub,"big5","utf-8"); 
$mail->IsSMTP(); // telling the class to use SMTP
$mail->IsHTML(true);
$mail->Host = "localhost"; // SMTP server
$mail->FromName = $cname2;
$mail->From = $fromemail;
$mail->AddAddress($email);
$mail->Subject =" $subject";
$mail->Body = $say;
$mail->CharSet = "utf-8";
$mail->WordWrap = 50; 
$mail->Encoding = "base64";

if($mail->Send()) 
?>
ok!