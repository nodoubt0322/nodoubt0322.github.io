<?include ("session.php"); 
   include ("../connect.php"); 
   
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
	$DestDIR2 = "../pic/sdfsxfv";
	$File_Extension = explode(".", $_FILES['myfile']['name']);
	$File_Extension = $File_Extension[count($File_Extension)-1];
	$ServerFilename =date("YmdHis").".".$File_Extension;
	copy($_FILES['myfile']['tmp_name'], $DestDIR2."/".$ServerFilename);
	
	$arr=getimagesize($DestDIR2."/".$ServerFilename); 
    $strarr=explode("\"",$arr[3]);
    $w=$strarr[1];
    $h=$strarr[3];
	
	if ($w!=191)
	{
	    echo "寬必須為191px....<a href=\"javascript:history.go(-1);\">回上一頁</a>";
	    exit;
	}
	
}

$sql="select max(standing)+1 as ma from tb_ad";
$rs=mysql_query($sql);
$totnum= mysql_num_rows($rs); 

if (mysql_result($rs,0,"ma")=="") {
   $ma=1;
}else{
   $ma=mysql_result($rs,0,"ma");
}

$subject_ct=carhow($_POST["subject_ct"]);

$url=carhow($_POST["url"]);
$openkind=carhow($_POST["openkind"]);

$sql="insert into tb_ad (subject,pic,url,openkind,standing) ".
     "values('$subject_ct','$ServerFilename','$url','$openkind',$ma)";
//echo $sql;
//exit;	 
mysql_query($sql);

				echo "<script language=javascript>
				     alert (\"新增成功. \");
					 location.href=\"ad.php\";
					 </script>";
?>