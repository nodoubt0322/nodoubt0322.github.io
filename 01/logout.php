<? session_start();  
   unset($_SESSION["bowchan_id"]); 
   unset($_SESSION["bowchan_cid"]);
   
	unset($_SESSION["bowchan_buy_pid"]); 
	unset($_SESSION["bowchan_buy_qty"]);
	
	unset($_SESSION["bowchan_isfb"]);
	unset($_SESSION["bowchan_fb_id"]);
	unset($_SESSION["bowchan_fb_name"]);
	unset($_SESSION["bowchan_fb_email"]);
?>
<SCRIPT language=javascript>
	document.location.href="login.php";
</SCRIPT>