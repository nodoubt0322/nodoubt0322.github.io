<?include ("session.php"); 
include ("../connect.php"); 
   
$pid=$_POST["pid"];
$page=$_POST["page"];	
$page2=$_POST["page2"];	
$srhkind=$_POST["srhkind"];
$srhcid=$_POST["srhcid"];
$srhcid2=$_POST["srhcid2"];

$cid=$_POST["cid"];
$ccid=$_POST["ccid"];

$old_cid=$_POST["old_cid"];
$old_ccid=$_POST["old_ccid"];

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

$old_pic=$_POST["old_pic"];

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

    $sql="update tb_prod set pic='$ServerFilename' where pid=$pid";
	mysql_query($sql);

	if (is_file("../pic/prod/".$old_pic)) {
		unlink("../pic/prod/".$old_pic);
	}	
	if (is_file("../pic/prod/s_".$old_pic)) {
		unlink("../pic/prod/s_".$old_pic);
	}
}

if ($cid!=$old_cid)
{
    if ($ccid=="-1")
	{
	   mysql_query("update tb_prod set standing2=1,standing3=-1 where pid=$pid");
	   mysql_query("update tb_prod set standing2=standing2+1 where standing2>=1 and cid=$cid and ccid=-1 and pid<>$pid");
	}else{
	   mysql_query("update tb_prod set standing2=-1,standing3=1 where pid=$pid");
	   mysql_query("update tb_prod set standing3=standing3+1 where standing3>=1 and cid=$cid and ccid=$ccid and pid<>$pid");
	}
}

if ($cid==$old_cid)
{
    if ($old_ccid!=$ccid)
	{
	    if ($ccid=="-1")
		{
		   mysql_query("update tb_prod set standing2=1,standing3=-1 where pid=$pid");
		   mysql_query("update tb_prod set standing2=standing2+1 where standing2>=1 and cid=$cid and ccid=-1 and pid<>$pid");
		}else{
		   mysql_query("update tb_prod set standing2=-1,standing3=1 where pid=$pid");
		   mysql_query("update tb_prod set standing3=standing3+1 where standing3>=1 and cid=$cid and ccid=$ccid and pid<>$pid");
		}
	}
}
	
$sql="update `tb_prod` 
	   set `cid`=$cid,`ccid`=$ccid,
	   `subject`='$subject',`memo2`='$memo2',
	   `spec`='$spec',`price2`='$price2',`price`='$price',`ishot`='$ishot',`isintro`='$isintro',
	   `isshow`='$isshow',`write_time`=now(),`memo`='$editor',`fno`='$fno' where pid=$pid";
//echo $sql;
//exit;	 
mysql_query($sql);

include ("prod_retorder.php"); 

echo "<script language=javascript>
	 alert (\"修改成功. \");
	 location.href=\"prod.php?focuspid=$pid&srhcid=$cid&srhcid2=$ccid&srhkind=$srhkind&page=$page&page2=$page2#prod$pid\";
	 </script>";
			 
?>