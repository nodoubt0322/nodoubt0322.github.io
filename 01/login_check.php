<? session_start();

	if ($_POST["autologin"]=="Y") 
	{
		setcookie ("nod_cookie_autologin", "Y",time()+3600*24*180); /* expire in 1 hour */ 
		setcookie ("nod_cookie_cid", $_POST["cid"],time()+3600*24*180); /* expire in 1 hour */ 
		setcookie ("nod_cookie_pass", $_POST["pass"],time()+3600*24*180); /* expire in 1 hour */ 
		setcookie ("nod_cookie_islogout", "",time()-3600*24*180);		
	}
	
	if ($_POST["autologin"]=="") 
	{
		setcookie ("nod_cookie_autologin", "",time()-3600*24*180); /* expire in 1 hour */ 
		setcookie ("nod_cookie_cid", "",time()-3600*24*180); 
		setcookie ("nod_cookie_pass", "",time()-3600*24*180);	
        setcookie ("nod_cookie_islogout", "",time()-3600*24*180);		
	}						
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?					
   include ("connect.php");

		$autologin = $_POST["autologin"];
		if ($autologin=="") $autologin="N";
		
		$cid = $_POST["cid2"];
		if ($cid=="") $cid = $_POST["cidd"];
		
		$pass = $_POST["pass2"];
		if ($pass=="") $pass = $_POST["passs"];
		
        $today=date("Ymd");

        $sql= "select * from tb_member where ".
			  "cid = '$cid' and status='Y'";		
		$rs=mysql_query($sql);
		$findtot=mysql_num_rows($rs);
		$flag=0;
		
		if ($findtot>0)
		{   
		    $row= mysql_fetch_array($rs);
			$id=$row["id"];
			//$cname=$row["cname"];
			//$point=$row["point"];
			//$level=$row["level"];
			
			if ($row["status"]=="Y")
			{
				if ($row["pass"]==$pass)
				{
					$ip=getenv("remote_addr");
					
					//最後登入時間			
					$sql= "update tb_member set last_login=now(),last_login_ip='$ip' where id = $id";
					mysql_query($sql);
					
					$flag=1;
					
					$_SESSION["bowchan_id"]=$id;
                    $_SESSION["bowchan_cid"]=$cid;			
                }
             }
         }
		 
		 if ($flag==0)
		 {
            echo "<script>alert('帳號或密碼錯誤') </script>";
			echo "<script>history.go(-1);</script>";
		 }else{		    			
		    echo "<script>alert('登入成功') </script>";
			echo "<script>document.location.href='products.php';</script>";
		 }		 
?>	