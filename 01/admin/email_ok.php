<? include ("session.php"); 
   include ("../connect.php"); 

$sql="delete from tb_email";
mysql_query($sql);

for ($i=1;$i<=10;$i++){ 
$email=$_POST["email".$i];
$sql="insert into tb_email (eid,email) values($i,'$email')";
//echo $sql."<BR>";
//exit;	 
mysql_query($sql);

}

//exit;
?>

<script language=javascript>
        alert ("修改成功.");
        location.href="email.php";
</script>