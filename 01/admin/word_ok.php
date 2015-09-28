<? include ("session.php"); 
   include ("../connect.php"); 
   
$kind=carhow($_POST["kind"]);
$memo=carhow2($_POST["editor"]);

$sql="update tb_word set memo='$memo' where kind='$kind'";
mysql_query($sql);
?>

<script language=javascript>
        alert ("修改成功.");
        document.location.href="word.php?kind=<?=$kind;?>";
</script>