<?
include("connect.php");

$regno=$_GET["regno"];
$email=$_GET["email"];

$sql="select * from tb_member where regno='$regno' and email='$email'";
$rs=mysql_query($sql);
$findtot=mysql_num_rows($rs);

if ($findtot==0){
    $kind="找不到帳號!";
}else{
   $sql="update tb_member set status='Y',confirm_time=now() where regno='$regno' and email='$email'";
   mysql_query($sql);
   $kind="認證成功,您可以開始登入使用!";
}
?>
<script language=javascript>
        alert ("<?=$kind;?>");
        document.location.href="login.php";
</script>
