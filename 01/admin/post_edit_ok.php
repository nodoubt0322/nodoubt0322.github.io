<?include ("session.php"); 
include ("../connect.php"); 
   
$pid=$_POST["pid"];
$page=$_POST["page"];	
$page2=$_POST["page2"];	
$srhkind=$_POST["srhkind"];
$srhcid=$_POST["srhcid"];
$srhccid=$_POST["srhccid"];
$srhcccid=$_POST["srhcccid"];

$cid=$_POST["cid"];
$ccid=$_POST["ccid"];

$subject=carhow($_POST["subject"]);
$editor=carhow2($_POST["editor"]);

$isshow=carhow($_POST["isshow"]);

$old_pic=$_POST["old_pic"];

$DestDIR2 = "../pic/post";

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
		
		  if ($w!=180)
		  {
			echo "寬必須為180px....<a href=\"javascript:history.go(-1);\">回上一頁</a>";
			exit;
		  }
		  if ($h!=180)
		  {
			echo "高必須為180px....<a href=\"javascript:history.go(-1);\">回上一頁</a>";
			exit;
		  }
	}	

    $sql="update tb_post set pic='$ServerFilename' where pid=$pid";
	mysql_query($sql);

	if (is_file("../pic/post/".$old_pic)) {
		unlink("../pic/post/".$old_pic);
	}	
	
}

	$cid="-1";
$sql="update `tb_post` 
	   set `cid`=$cid,
	   `subject`='$subject',`write_time`=now(),`memo`='$editor' where pid=$pid";
//echo $sql;
//exit;	 
mysql_query($sql);


echo "<script language=javascript>
	 alert (\"修改成功. \");
	 location.href=\"post.php?srhcid=$srhcid&srhccid=$srhccid&srhcccid=$srhcccid&srhkind=$srhkind&page=$page&page2=$page2\";
	 </script>";
			 
?>