<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>寶昌餅店後台管理系統</title>
<link href="layout.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form name="form1" action="login_check.php" method="post">
<div class="index">

<div class="text"><p>帳號
  <label>
    <input name="username" type="text" id="username" value="" size="28" maxlength="20" />
  </label>
  </p>
  <p>密碼
  <label>
    <input name="password" type="password" id="password" size="28" />
  </label>
  </p>
  <?
		  srand((double)microtime()*1000000);
		   while(($authnum=rand()%10000)<1000);    
		   ?>
  認證<label>
    <input name="CAPTCHA" type="text" id="CAPTCHA" size="15" />
	<img src="submit_check.php?authnum=<?=$authnum;?>" />
  </label>  
</div>
<div class="images"><a href="javascript:check();"><img src="images/img.png" width="97" height="35" /></a> </div>
</div>
<script language=javascript>
	function check(){
			 if (document.getElementById("username").value==""){
				alert ("請輸入帳號.");
				document.form1.username.focus();
				return;
			}
			if (document.getElementById("password").value==""){
				alert ("請輸入密碼.");
				document.form1.password.focus();
				return;
			}
			
			if (document.form1.CAPTCHA.value==""){
				alert ("請輸入驗證碼.");
				document.form1.CAPTCHA.focus();
				return;
			 } 		 		 
			 
			 if (document.form1.CAPTCHA.value!="<?=$authnum;?>"){
				alert ("驗證碼輸入錯誤.");
				document.form1.CAPTCHA.focus();
				return;
			 }
			document.forms['form1'].submit();		
	}
	</script>
	</form>
</body>
</html>
