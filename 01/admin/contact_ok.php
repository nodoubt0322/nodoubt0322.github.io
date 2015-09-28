<? include ("session.php"); 
   include ("title.php"); 
   require("phpmailer/class.phpmailer.php");

   $cid=carhow($_POST["cid"]);
   $page=carhow($_POST["page"]);
   $page2=carhow($_POST["page2"]);
   
   $sql="select * from tb_slogin";
$rs=mysql_query($sql);
$row = mysql_fetch_array($rs);
$wwwname=$row["wwwname"]; 
$cname222=$row["cname"]; 
$fromemail=$row["email"]; 
$wwwurl=$row["url"]; 

$sql = "SELECT * FROM `tb_contact` where cid=$cid";
$rs=mysql_query($sql);
$findtot=mysql_num_rows($rs);

if ($findtot==0){
?>
    <script language=javascript>
            location.href="main.php";
    </script>
<?
    exit;	
}	

$row = mysql_fetch_array($rs);

   $cname=carhow($row["cname"]);
   $tel=carhow($row["tel"]);
   $mobile=carhow($row["mobile"]);
   $email=carhow($row["email"]);
   $memo=carhow2($row["memo"]);
   $write_time=carhow($row["write_time"]);
   
   $memo_reply=carhow2($_POST["memo_reply"]);
   $memo_reply=str_replace("\r\n","<BR>",$memo_reply);
   
$say="<html><head>".
     "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />".
     "</head>".
     "<body>".
     "留言資料<BR><BR>".
	 "尊姓大名：".$cname."<BR><BR>".
     "行動電話：".$mobile."<BR><BR>".
	 "電子信箱：".$email."<BR><BR>".	 
	 "需求說明：<BR>".$memo."<BR><BR>留言時間:".$write_time."<BR><BR><HR>". 
	 "<font color=brown>回覆內容：<BR>".$memo_reply."<BR><BR>回覆時間:".date("Y/m/d H:i:s")."</font><BR><BR><HR>". 
	 "<a href=\"http://".$wwwurl."\" target=\"_blank\">".$wwwname."</a></body></html>";
//echo $say;
//exit;	 
$sub = "留言資料回覆"; 
$sub = "=?UTF-8?B?" . base64_encode($sub) . "?=";
$subject = mb_convert_encoding($sub,"big5","utf-8"); 

	 
	$emails=$email;
	$mail = new PHPMailer();
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->IsHTML(true);
$mail->Username = "bowchan_service@bloger.tw"; //設定驗證帳號        
$mail->Password = "xdfsx($%D"; //設定驗證密碼 
$mail->Host = "localhost"; // SMTP server
	$mail->FromName = $cname222;
	$mail->From = $fromemail;
	$mail->AddAddress($emails);
	$mail->Subject = $subject;
	$mail->Body = $say;
	$mail->CharSet = "utf-8";
	$mail->WordWrap = 50; 
	$mail->Encoding = "base64";
    $mail->Send();


$sql="update `tb_contact` ".
     "set `memo_reply`='$memo_reply',`reply_time`=now() where cid=$cid";
//echo $sql;
//exit;	 
mysql_query($sql);
?>
<script language=javascript>
        alert ("回覆成功!");
        location.href="contact.php?page=<?=$page;?>";
</script>