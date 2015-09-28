<?include ("session.php"); 
  include ("../connect.php"); 
   
$cid=$_POST["cid"];
$ccid=$_POST["ccid"];
if ($ccid=="") $ccid="-1";

$subject=carhow($_POST["subject"]);
$stock=carhow($_POST["stock"]);

$memo2=carhow($_POST["memo2"]);
$spec=carhow($_POST["spec"]);
$price2=carhow($_POST["price2"]);
$price=carhow($_POST["price"]);
$fno=carhow($_POST["fno"]);

$fee_include=carhow($_POST["fee_include"]);
if ($fee_include=="") $fee_include="N";

$ishot=carhow($_POST["ishot"]);
if ($ishot=="") $ishot="N";

$isintro=carhow($_POST["isintro"]);
if ($isintro=="") $isintro="N";

$editor=carhow2($_POST["editor"]);

$isshow=carhow($_POST["isshow"]);

$DestDIR2 = "../pic/prod";

if($_FILES['myfile']['error'] > 0 && $_FILES['myfile']['error'] < 4){
	switch($_FILES['myfile']['error']){
		case 1:die("檔案大小超出 php.ini:upload_max_filesize 限制");
		case 2:die("檔案大小超出 MAX_FILE_SIZE 限制");
		case 3:die("檔案僅被部分上傳");
		case 4:die("檔案未被上傳");
	}
}


$ServerFilename="";
if(is_uploaded_file($_FILES['myfile']['tmp_name'])){
	$File_Extension = explode(".", $_FILES['myfile']['name']);
	$File_Extension = $File_Extension[count($File_Extension)-1];
	$ServerFilename =date("YmdHis").".".$File_Extension;
	copy($_FILES['myfile']['tmp_name'], $DestDIR2."/".$ServerFilename);	
	
	
	if ($File_Extension!="swf" && $File_Extension!="SWF" && $File_Extension!="gif" && $File_Extension!="GIF") 
	{ 
	      $arr=getimagesize($DestDIR2."/".$ServerFilename); 
		  $strarr=explode("\"",$arr[3]);
		  $w=$strarr[1];
		  $h=$strarr[3];
		
		  if ($w%$h!=0){
			echo "寬高比例必須1:1....<a href=\"javascript:history.go(-1);\">回上一頁</a>";
			exit;
		  }
		  
		  $ServerFilename2 ="s_".$ServerFilename;
		   
		   //s
		   ImageCopyResizedTrue($DestDIR2."/".$ServerFilename,$DestDIR2."/".$ServerFilename2,200,126); 
	}	
}	

$fee_include="N";
$stock="100000";

$standing2="1"; //無第二層 
$standing3="1"; //有第二層

if ($ccid=="-1") //無第2層
{
    $standing3="-1";
}else{           //有第2層
    $standing2="-1";
}	

//standing1
mysql_query("update tb_prod set standing1=standing1+1 where standing1>=1");

//standing2
if ($standing2=="1")
{
    mysql_query("update tb_prod set standing2=standing2+1 where standing2>=1 and cid=$cid");
}

//standing3
if ($standing3=="1")
{
    mysql_query("update tb_prod set standing3=standing3+1 where standing3>=1 and cid=$cid and ccid=$ccid");
}

$sql="insert into `tb_prod` (`cid`,`ccid`,`subject`,
      `memo2`,`spec`,`price2`,`price`,`fee_include`,`pic`,`ishot`,`isintro`,`stock`,`write_time`,`memo`,
	  `isshow`,`fno`,`standing1`,`standing2`,`standing3`) 
       values ($cid,$ccid,'$subject','$memo2','$spec','$price2','$price','$fee_include',
	   '$ServerFilename','$ishot','$isintro',0,now(),'$editor','$isshow','$fno',
	   1,$standing2,$standing3)";
//echo $sql;
//exit;	 
mysql_query($sql);



$sql = "SELECT * FROM `tb_prod` order by pid desc limit 1";
//echo $sql;
//exit;
$rs=mysql_query($sql);
$findtot=mysql_num_rows($rs);

if ($findtot>0){
	$row = mysql_fetch_array($rs);
	$pid=$row["pid"]; 
}

include ("prod_retorder.php"); 

echo "<script language=javascript>
	 alert (\"新增成功. \");
	 location.href=\"prod.php?srhcid=$cid&srhcid2=$ccid&focuspid=$pid\";
	 </script>";
?>