<? include ("session.php");
   include ("connect.php");   ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?

$id=$myid;

   $keys=$_POST["keys"];
   if ($keys=="") $keys=$_GET["keys"];


$flag=carhow($_POST["flag"]);

$pass=carhow($_POST["pass"]);
$old_pass=carhow($_POST["old_pass"]);

if ($pass=="") $pass=$old_pass;
$cname=carhow($_POST["cname"]);
$nickname=carhow($_POST["nickname"]);

$tel=carhow($_POST["tel"]);
$mobile=carhow($_POST["mobile"]);
$email=carhow($_POST["email"]);
$zip=carhow($_POST["zip"]);
$city=carhow($_POST["city"]);
$town=carhow($_POST["subtype"]);
$addr=carhow($_POST["addr"]);
$bdate=carhow($_POST["bdate"]);
$srhstatus=$_POST["srhstatus"];
	if ($srhstatus=="") $srhstatus=$_GET["srhstatus"];
	
	$srhlevel=$_POST["srhlevel"];
	if ($srhlevel=="") $srhlevel=$_GET["srhlevel"];
?>
<form name="form1" action="member.php" method="post">
<input type="hidden" name="flag" value="<?=$flag;?>">
<input type="hidden" name="id" value="<?=$id;?>">

<input type="hidden" name="cname" value="<?=$cname;?>">
<input type="hidden" name="pass" value="<?=$pass;?>">
<input type="hidden" name="nickname" value="<?=$nickname;?>">
<input type="hidden" name="tel" value="<?=$tel;?>">
<input type="hidden" name="mobile" value="<?=$mobile;?>">
<input type="hidden" name="zip" value="<?=$zip;?>">
<input type="hidden" name="city" value="<?=$city;?>">
<input type="hidden" name="town" value="<?=$town;?>">
<input type="hidden" name="addr" value="<?=$addr;?>">
</form>
<?


$sql="update `tb_member` set 
	  `pass`='$pass',`cname`='$cname',`nickname`='$nickname',`tel`='$tel',
	  `mobile`='$mobile',`zip`='$zip',`addr`='$addr',`birthday`='$bdate' where id=$id";
						  
                          
//echo $sql;
//exit;	 
mysql_query($sql);
 
?>
<script language=javascript>
        alert ("修改成功!");
		document.location.href="member.php";
</script>
