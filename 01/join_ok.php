<? include ("connect.php"); 

$pass=carhow($_POST["pass"]);
$cname=carhow($_POST["cname"]);
$nickname=carhow($_POST["nickname"]);

$email=carhow($_POST["email"]);
$mobile=carhow($_POST["mobile"]);
$zip=carhow($_POST["zip"]);
$city=carhow($_POST["city"]);
$town=carhow($_POST["subtype"]);
$addr=carhow($_POST["addr"]);
$bdate=carhow($_POST["bdate"]);
?>
<form name="form1" action="login.php" method="post">
<input type=text name="totnum" value="111" style="color:white;border:white 0px solid; ">
<input type="hidden" name="pass" value="<?=$pass;?>">
<input type="hidden" name="cname" value="<?=$cname;?>">
<input type="hidden" name="nickname" value="<?=$nickname;?>">
<input type="hidden" name="email" value="<?=$email;?>">
<input type="hidden" name="zip" value="<?=$zip;?>">
<input type="hidden" name="city" value="<?=$city;?>">
<input type="hidden" name="town" value="<?=$town;?>">
<input type="hidden" name="addr" value="<?=$addr;?>">
<input type="hidden" name="bdate" value="<?=$bdate;?>">
</form>
<?
$sql="select * from tb_member where email='$email'";
$rs=mysql_query($sql);
$findtot=mysql_num_rows($rs);

if ($findtot!=0)
{
?>
   <script language=javascript>
           alert ("帳號已有人使用..");
           document.form1.submit();
   </script>
<?
    exit;	
}	


srand((double)microtime()*1000);
while(($regno=rand()%1000)<100);    
$n=date("YmdHis");
$regno=$n.$regno;
//echo $regno;
//exit;

$cid=$email;

$sql="insert into `tb_member` (`cid`,`pass`,`cname`,`nickname`,
  `mobile`,`email`,`zip`,`addr`,`status`,`regno`,`reg_time`,`logintimes`,`points`,`birthday`) values 
	  ('$cid','$pass','$cname','$nickname','$mobile',
	  '$email','$zip','$addr','N','$regno',now(),0,0,'$bdate')";
//echo $sql;
//exit;	 
mysql_query($sql);

require("phpmailer/class.phpmailer.php");

$sql="select * from tb_slogin";
$rs=mysql_query($sql);
$row = mysql_fetch_array($rs);
$wwwname=$row["wwwname"]; 
$cname2=$row["cname"]; 
$fromemail=$row["email"]; 
$wwwurl=$row["url"]; 

$say="<html><head>".
     "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />".
     "</head>".
     "<body>".
	 "此為系統發信，請勿直接回信 * <BR><BR>".
	 "Email：".$email."<BR><BR>".	
	 "姓名：".$cname."<BR><BR>".
     "暱稱：".$nickname."<BR><BR>".
     "請點選(或複製)下方連結以通過認證 :<BR><BR>".
	 "<a href=\"".$wwwurl."/account-confirm.php?regno=".$regno."&email=".$email."\" target=\"_blank\">".
     $wwwurl."/account-confirm.php?regno=".$regno."&email=".$email."</a><BR><BR>".	 
	 "</body></html>";
	 
$sub = $wwwname."會員註冊資料確認信"; 
$sub = "=?UTF-8?B?" . base64_encode($sub) . "?=";

//$fromemail="carhow@ms94.url.com.tw";
//$fromemail="carhow@gmail.com";
//$fromemail="carhow@gmail.com";
	 
$mail = new PHPMailer();
$subject = mb_convert_encoding($sub,"big5","utf-8"); 
$mail->IsSMTP(); // telling the class to use SMTP
$mail->IsHTML(true);
$mail->Username = "bowchan_service@bloger.tw"; //設定驗證帳號        
$mail->Password = "xdfsx($%D"; //設定驗證密碼 
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
<script language=javascript>
        alert ("註冊成功，您必須至您的信箱點選確認網址，以完成註冊動作!");
		document.location.href="login.php";
</script>