<? include ("session.php"); 
   include ("../connect.php"); 
   

$cid=carhow($_POST["cid"]);
$pass=carhow($_POST["pass"]);
$wwwname=carhow($_POST["wwwname"]);
$cname=carhow($_POST["cname"]);
$email=carhow($_POST["email"]);
$url=carhow($_POST["url"]);

$fee11=carhow($_POST["fee11"]);
$fee111=carhow($_POST["fee111"]);
$fee12=carhow($_POST["fee12"]);

$paykind1=carhow($_POST["paykind1"]);
$paykind1=str_replace("\r\n","<BR>",$paykind1);

$paykind2=carhow($_POST["paykind2"]);
$paykind2=str_replace("\r\n","<BR>",$paykind2);

$paykind3=carhow($_POST["paykind3"]);
$paykind3=str_replace("\r\n","<BR>",$paykind3);

$paykind4=carhow($_POST["paykind4"]);
$paykind4=str_replace("\r\n","<BR>",$paykind4);


$sql="update tb_slogin set cid='$cid',pass='$pass',
      wwwname='$wwwname',cname='$cname',email='$email',url='$url',
	  fee11=$fee11,fee111=$fee111,fee12=$fee12,pages=10,
	  paykind1='$paykind1',paykind2='$paykind2',paykind3='$paykind3',paykind4='$paykind4'";
//echo $sql;
//exit;
	  mysql_query($sql);


//exit;
?>

<script language=javascript>
        alert ("修改成功.");
        document.location.href="pass.php";
</script>