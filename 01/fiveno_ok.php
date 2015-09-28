<? include('session.php'); 
   include('connect.php');
  ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?

          $oid=carhow($_POST["oid"]);
		  if ($oid=="")
		  {
	?>
			<script language=javascript>
					document.location.href="order.php";
			</script>
	<?
			   exit;	
		  }
		  
		  $fiveno=carhow($_POST["fiveno"]);
		  if ($fiveno=="")
		  {
	?>
			<script language=javascript>
					document.location.href="order.php";
			</script>
	<?
			   exit;	
		  }
		  
		  if ($_SESSION["nod_isfb"]=="Y")
	      {
			  $fbid=$_SESSION["nod_fb_id"];
		      $sql="select * from tb_orders where oid=$oid and fbid='$fbid'";
		  }else{
              $sql="select * from tb_orders where oid=$oid and member_id=$myid";
          }		  
		  $rs=mysql_query($sql);
		  
		  $totnum= mysql_num_rows($rs);
			
		  if ($totnum==0)
		  {
	?>
			<script language=javascript>
					document.location.href="order.php";
			</script>
	<?
			   exit;	
		  }
		  
		  if ($_SESSION["nod_isfb"]=="Y")
	      {
		      $fbid=$_SESSION["nod_fb_id"];
		      $sql="update tb_orders set fiveno='$fiveno' where oid=$oid and fbid='$fbid'";
		  }else{	  
		      $sql="update tb_orders set fiveno='$fiveno' where oid=$oid and member_id=$myid";
		  }	  
          mysql_query($sql);
?>
<script language=javascript> 
				alert ("更新成功");
				document.location.href="order-1.php?oid=<?=$oid;?>";
		   </script> 
    