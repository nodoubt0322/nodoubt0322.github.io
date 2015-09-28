<? session_start();

if (isset($_SESSION["bowchan_admin"]) && $_SESSION["bowchan_admin"] != "") {
}else{
?>
<script language=javascript>
        document.location.href="index.php";
</script>
<?
    exit;
}

$myid=$_SESSION["bowchan_admin"];
?>
<script>
  function gbg(obj)
  {}
  function gbn(obj)
  {}
 </script>
</head>