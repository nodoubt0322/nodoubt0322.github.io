<?include ("session.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?
//$nowfile=$_SERVER['PHP_SELF'];

include ("../connect.php"); 
$nowfile=str_replace("/admin","",$nowfile);

$kind="0";
//if (strstr($nowfile,"/pass")!="" || strstr($nowfile,"/email")!="") $kind="0";
//if (strstr($nowfile,"main_banner")!="" || strstr($nowfile,"/ad")!="" || strstr($nowfile,"/contact")!="" || strstr($nowfile,"/member")!="" || strstr($nowfile,"/orders")!="") $kind="0";
//if (strstr($nowfile,"/item_kind")!="" || strstr($nowfile,"/item_kind2")!="" || strstr($nowfile,"/prod")!="") $kind="1";
//if (strstr($nowfile,"/item_kind3")!="" || strstr($nowfile,"/item_kind4")!="" || strstr($nowfile,"/post")!="") $kind="2";
//if (strstr($nowfile,"/item_kind5")!="" || strstr($nowfile,"/item_kind6")!="" || strstr($nowfile,"/news2")!="") $kind="3";
//if (strstr($nowfile,"/item_kind7")!="" || strstr($nowfile,"/item_kind8")!="" || strstr($nowfile,"/news3")!="") $kind="4";
//if (strstr($nowfile,"/item_kind9")!="" || strstr($nowfile,"/item_kind10")!="" || strstr($nowfile,"/news4")!="") $kind="5";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>寶昌餅店後台管理系統</title>
<link href="layout.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryAccordion.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryAccordion.php?kind=<?=$kind;?>" type="text/javascript"></script>
<script type="text/javascript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
</head>

<body>
<div class="top">
  <div class="top-left"><a href="main.php"><img src="images/sub-top-left01.png" width="97" height="45" /></a><a href="<?=$nowfile;?>"><img src="images/sub-top-left02.png" width="91" height="45" /></a><a href="logout.php"><img src="images/sub-top-left03.png" width="96" height="45" /></a></div>
  <div class="top-right"> 
    <?
	    $sql="select * from tb_slogin";
		$rs=mysql_query($sql);
		$row = mysql_fetch_array($rs);
		$eachpages=$row["pages"];
		$ip=$_SERVER['REMOTE_ADDR'];
    ?>
    <p style="color:white;margin-top:15px;margin-right:15px;">登入者：<?=$row["cid"];?></p>
    <?//<p>登入權限：系統管理員</p>?>
    <p style="color:white;margin-right:15px;"> 登入時間：<?=$row["last_login"];?> </p>
    <p style="color:white;margin-right:15px;">登入IP：<?=$row["last_login_ip"];?></p>
  </div>
</div>
<div class="left">
  <div class="left-top">
    <div id="left_tit">後台管理</div>
  </div>
<div id="life_menu">
    <div id="Accordion1" class="Accordion" tabindex="0">
      <div class="AccordionPanel">
        <div class="AccordionPanelTab"><a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image1','','images/--.png',1)"><img src="images/++.png" name="Image1" width="19" height="15" border="0" id="Image1" /></a>系統設定</div>
        <div class="AccordionPanelContent">
        <li><a href="pass.php">帳號管理/系統設定</a></li>
        <li><a href="email.php">管理者信箱</a></li>
        <li><a href="../index.php" target="_blank">前台網頁</a></li>
        <li><a href="logout.php">登出</a></li>
        </div>
      </div>
    </div>
  </div>
  <div class="left-top">
  <div id="left_tit">各區管理</div>
  </div>
  <div id="life_menu">
    <div id="Accordion2" class="Accordion" tabindex="<?=$kind;?>">
      
	  <div class="AccordionPanel">
        <div class="AccordionPanelTab"><a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image2','','images/--.png',1)"></a><a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image2','','images/--.png',1)"><img src="images/++.png" name="Image2" width="19" height="15" border="0" id="Image2" /></a>各區管理</div>
        <div class="AccordionPanelContent">
         
            <li><a href="main_banner.php"> BANNER輪撥  </a></li>
			 <li><a href="ad.php"> 贊助廣告  </a></li>
			
			<?//<li><a href="item_kind4.php"> 最新消息分類  </a></li>?>
			<li><a href="post.php"> 最新消息  </a></li>
			
			<li><a href="item_kindQA.php"> 關於我們  </a></li>
		
			<li><a href="item_kind.php"> 商品大分類  </a></li>
			<li><a href="item_kind2.php"> 商品小分類  </a></li>
			<li><a href="prod.php"> 商品  </a></li>
			<li><a href="prod_ask.php"> 商品問答  </a></li>
			<?//
			//<li><a href="item_kind5.php"> 通路介紹大分類  </a></li>
			//<li><a href="item_kind6.php"> 通路介紹小分類  </a></li>
			//<li><a href="news4.php"> 通路介紹  </a></li>
			?>
			
			<li><a href="word.php?kind=1"> 訂購說明  </a></li>
			
			<li><a href="contact.php"> 聯絡我們</a></li>
			
			<li><a href="member.php"> 會員  </a></li>
			<li><a href="orders.php"> 訂單  </a></li>
			<li><a href="edm_list.php">EDM發送</a></li>	
			<li><a href="view.php"> 參觀人數統計  </a></li>
        </div>
      </div>
	  
      
	  
	  
	  
	  
    </div>
	
</div>
</div>
