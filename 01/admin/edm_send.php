<? include('session.php');  
    include('../connect.php');  
    require("phpmailer/class.phpmailer.php");
    
	$memo=$_POST["memo"];
	$memo=str_replace("'","`",$memo);
	
	$subject=carhow($_POST["subject"]);
	$level1=$_POST["level1"];
	$level2=$_POST["level2"];
	$level3=$_POST["level3"];
	$level4=$_POST["level4"];

	if ($memo==""){
?>
<form name="form1" action="edm_subject.php" method="post">
<input type=hidden name="level1" value="<?=$level1;?>">
<input type=hidden name="level2" value="<?=$level2;?>">
<input type=hidden name="level3" value="<?=$level3;?>">
<input type=hidden name="level4" value="<?=$level4;?>">
<input type=hidden name="subject" value="<?=$subject;?>">
<script language=javascript>
alert ("請輸入內容.");
document.form1.submit();
</script>
</form>
<?	exit;
    }
	
//exit;	
	
	

	$sql="select * from tb_slogin";
$rs=mysql_query($sql);
$row = mysql_fetch_array($rs);
$wwwname=$row["wwwname"]; 
$cname222=$row["cname"]; 
$fromemail=$row["email"]; 
$wwwurl=$row["url"];

	
$sql="insert into tb_edm (subject,memo,send_time) values('$subject','$memo',now())";
mysql_query($sql);
	
$sql3="select eid from tb_edm order by eid desc limit 1";
$rs3=mysql_query($sql3);
$totnum3= mysql_num_rows($rs3); 

$sub = "=?UTF-8?B?" . base64_encode($subject) . "?=";
$subject2 = mb_convert_encoding($sub,"big5","utf-8"); 

if ($totnum3>0){
    $row3= mysql_fetch_array($rs3);
	$eid=$row3["eid"];
	$aa="";

	$addsql=" where email<>'' and status='Y' ";
	if ($level1=="1") $aa.="1,";
	if ($level2=="2") $aa.="2,";
	if ($level3=="3") $aa.="3,";
	if ($level4=="4") $aa.="4,";
//echo $aa."<HR>";
	
	if ($aa!="")
	{
		$aa=substr($aa,0,-1);
		//echo $aa."<HR>";
		$addsql.=" and level in (".$aa.")";
	}
	$sql="select * from tb_member ".$addsql." order by cid";
	//echo $sql."<HR>";
	$rs=mysql_query($sql);
    $totnum= mysql_num_rows($rs);
	
	$memo=str_replace("\\","",$memo);
	$memo=str_replace("src=\"/","src=\"http://bloger.tw/",$memo);
				
				//echo $memo;
				//exit;
				
	if ($totnum>0)
	{
		while ($row= mysql_fetch_array($rs))
		{
			$id=$row["id"];
			$cid=$row["cid"];
			
			$email=$row["email"];
			//$email="carhow@gmail.com";
			
			if ($email!=""){
				$say="<html><head>".
					 "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />".
					 "</head>".
					 "<body>".$memo.
					 "<img src=\"".$wwwurl."/admin/edm_isread.php?eid=".$eid."&cid=".$cid."\" border=0 width=0 height=0></img></body></html>";
//echo $say;
//exit;				
				$mail = new PHPMailer();
				$mail->IsSMTP(); // telling the class to use SMTP
				$mail->IsHTML(true);
				$mail->Host = "localhost"; // SMTP server
				$mail->SMTPAuth = true; // turn on SMTP authentication
				$mail->Username = "bowchan_service@bloger.tw"; //設定驗證帳號        
$mail->Password = "xdfsx($%D"; //設定驗證密碼 
				$mail->FromName = $cname222;
				$mail->From = $fromemail;
				$mail->AddAddress($email);
				$mail->Subject =" $subject2";
				$mail->Body = $say;
				$mail->CharSet = "utf-8";
				$mail->WordWrap = 50; 
				$mail->Encoding = "base64";

				if($mail->Send());
				
				$sql="insert into tb_edm2 (eid,cid,email,isread) values($eid,'$cid','$email','N')";
				mysql_query($sql);
			}
	  }
  }
  
  $sql3="update tb_edm set finish_time=now() where eid=$eid";
  mysql_query($sql3);
}
//exit;
?>
      <script language=javascript>
             alert ("寄信成功");
			 document.location.href="edm_list.php";
       </script>	