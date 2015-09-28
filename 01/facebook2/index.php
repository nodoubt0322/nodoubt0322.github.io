<?php session_start();
require 'fbconfig.php';   // Include fbconfig.php file
?>
<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    <title>使用 Facebook 登入 秉醇烘焙坊</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="http://www.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet"> 
 </head>
  <body>
  <?php if ($user): 
            
			
			//已登入FB
            $_SESSION["bake_isfb"]="Y";
			
			//Facebook 帳號
			$_SESSION["bake_fb_id"]=$fbid;
			$_SESSION["bake_fb_name"]=$fbfullname;
			$_SESSION["bake_fb_email"]=$femail;

				echo "<script>alert('登入成功') </script>";
			    echo "<script>document.location.href='../index.php';</script>";
			
  else: ?>     <!-- Before login --> 
			<div class="container">
			<h1>登入 Facebook</h1>
					   未登入
			<div>
				  <a href="<?php echo $loginUrl; ?>">按此登入 Facebook</a>　
				  <a href="../login.php">返回</a>
				  </div>
				  </div>
    <?php endif ?>
  </body>
</html>
