<? session_start();
   include ("../connect.php");
 
		$username = $_POST["username"];
		$password = $_POST["password"];

		$sql= "select * from tb_slogin where ".
			  "cid = '$username' and pass = '$password'";	
//echo $sql;
//exit;			  
        $rs=mysql_query($sql);
        $findtot=mysql_num_rows($rs);

        if ($findtot>0){   
		   $row = mysql_fetch_array($rs);
		   $_SESSION['bowchan_admin']=$username;
		   
		   $ip=$_SERVER['REMOTE_ADDR']; 
		   mysql_query("update tb_slogin set last_login=now(),last_login_ip='$ip'");
		   
		   echo "<script>document.location.href='main.php';</script>";			  
		}
			
		else{			
			echo "<script>alert('帳號或密碼錯誤') </script>";
			echo "<script>history.go(-1);</script>";
		}
?>	