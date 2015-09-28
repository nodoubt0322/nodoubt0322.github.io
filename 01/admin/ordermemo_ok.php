<? include ("session.php"); 
   include ("../connect.php"); 
   

$editor=carhow2($_POST["editor"]);

$sql="update tb_slogin set ordermemo='$editor'";
//echo $sql;
//exit;
	  mysql_query($sql);


//exit;
?>

<script language=javascript>
        alert ("修改成功.");
        document.location.href="ordermemo.php";
</script>