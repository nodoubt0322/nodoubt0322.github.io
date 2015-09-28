<? include ("session.php"); 
   include ("../connect.php"); 
    ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<? 

   $keys=$_POST["keys"];
   
   if ($keys=="") $keys=$_GET["keys"];
   
   $srhdate1=$_POST["srhdate1"];
   if ($srhdate1=="") $srhdate1=$_GET["srhdate1"];
   
   $srhdate2=$_POST["srhdate2"];
   if ($srhdate2=="") $srhdate2=$_GET["srhdate2"];
   
   $srhlevel=$_POST["srhlevel"];
   if ($srhlevel=="") $srhlevel=$_GET["srhlevel"];
   
   $srhstatus=$_POST["srhstatus"];
   if ($srhstatus=="") $srhstatus=$_GET["srhstatus"];
   
   $srhtime1=$_POST["srhtime1"];
   if ($srhtime1=="") $srhtime1=$_GET["srhtime1"];
   
   $srhtime2=$_POST["srhtime2"];
   if ($srhtime2=="") $srhtime2=$_GET["srhtime2"];
   
$page=$_POST["page"];
$page2=$_POST["page2"];
$flag=carhow($_POST["flag"]);

$cid=carhow($_POST["cid"]);
$pass=carhow($_POST["pass"]);
$cname=carhow($_POST["cname"]);
$nickname=carhow($_POST["nickname"]);
$sex=carhow($_POST["sex"]);
$getepaper=carhow($_POST["getepaper"]);
$tel=carhow($_POST["tel"]);
$mobile=carhow($_POST["mobile"]);
$email=$cid;
$zip=carhow($_POST["zip"]);
$city=carhow($_POST["city"]);
$town=carhow($_POST["subtype"]);
$addr=carhow($_POST["addr"]);
$status=carhow($_POST["status"]);

   
   ?>
   <form name="form1" action="member_add.php" method="post">
<input type=text name="totnum" value="111" style="color:white;border:white 0px solid; ">
<input type="hidden" name="cid" value="<?=$cid;?>">
<input type="hidden" name="pass" value="<?=$pass;?>">
<input type="hidden" name="pass" value="<?=$pass;?>">
<input type="hidden" name="cname" value="<?=$cname;?>">
<input type="hidden" name="nickname" value="<?=$nickname;?>">
<input type="hidden" name="email" value="<?=$email;?>">
<input type="hidden" name="tel" value="<?=$tel;?>">
<input type="hidden" name="zip" value="<?=$zip;?>">
<input type="hidden" name="city" value="<?=$city;?>">
<input type="hidden" name="town" value="<?=$town;?>">
<input type="hidden" name="addr" value="<?=$addr;?>">
<input type="hidden" name="sex" value="<?=$sex;?>">
<input type="hidden" name="mobile" value="<?=$mobile;?>">

<input type="hidden" name="status" value="<?=$status;?>">

<input type="hidden" name="srhdate1" value="<?=$srhdate1;?>">
<input type="hidden" name="srhdate2" value="<?=$srhdate2;?>">
<input type="hidden" name="srhlevel" value="<?=$srhlevel;?>">
<input type="hidden" name="srhstatus" value="<?=$srhstatus;?>">
<input type="hidden" name="srhtime1" value="<?=$srhtime1;?>">
<input type="hidden" name="srhtime2" value="<?=$srhtime2;?>">

<?
//if ($old_email!=$email){
	$sql="select * from tb_member where cid='$email'";
	$rs=mysql_query($sql);
	$findtot=mysql_num_rows($rs);

	if ($findtot!=0){
	?>
		<script language=javascript>
			   alert ("帳號已有人使用..");
			   document.form1.submit();
	   </script>
	<?
		exit;	
	}	
	  
		
//}
  ?>
  </form>
  <?
$sql="select * from tb_zipcode where zip='$zip'";
$rs=mysql_query($sql);
$row= mysql_fetch_array($rs);
$city=$row["country"];
$town=$row["town"];

$today=date("Ymd");
$sql="insert into `tb_member` (`cid`,`pass`,`cname`,`nickname`,
  `sex`,`tel`,`mobile`,`email`,`zip`,`addr`,
  `status`,`reg_time`,`confirm_time`) values 
  ('$email','$pass','$cname','$nickname','$sex','$tel','$mobile',
  '$email','$zip','$addr',
   '$status',now(),now())";                   
//echo $sql;
//exit;	 
mysql_query($sql);
 
?>
<script language=javascript>
        alert ("新增成功!");
		document.location.href="member.php";
</script>