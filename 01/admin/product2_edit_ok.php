<?include ("session.php"); 
   include ("../connect.php"); 
   
 $srhcid=carhow($_GET["srhcid"]);
   if ($srhcid=="") $srhcid=carhow($_POST["srhcid"]);
   
   $srhccid=carhow($_GET["srhccid"]);
   if ($srhccid=="") $srhccid=carhow($_POST["srhccid"]);
   
   $srhcccid=carhow($_GET["srhcccid"]);
   if ($srhcccid=="") $srhcccid=carhow($_POST["srhcccid"]);
   
   $page=carhow($_GET["page"]);
   if ($page=="") $page=carhow($_POST["page"]);
   $maxsize=carhow($_POST["maxsize"]);
   $page2=carhow($_GET["page2"]);
   if ($page2=="") $page2=carhow($_POST["page2"]);
   
   $pid=carhow($_GET["pid"]);
   if ($pid=="") $pid=carhow($_POST["pid"]);
   
   if ($pid=="")
   {
?>
        <script language=javascript>
		document.location.href="prod.php";
		</script>
<?	
       exit;
	}   

	$sql2 = "SELECT a.* FROM `tb_prod` a ".
		       "where a.pid=$pid";
    $rs2=mysql_query($sql2);
	$totnum2= mysql_num_rows($rs2);
	if ($totnum2==0)
	{
?>
        <script language=javascript>
		document.location.href="prod.php";
		</script>
<?	
       exit;	
	}
	$id=$_POST["id"];
	
	$old_pic1=$_POST["old_pic1"];

for ($i=1;$i<=1;$i++){
     $ServerFilename22=$old_pic1;
     if($_FILES['myfile'.$i]['error'] > 0 && $_FILES['myfile'.$i]['error'] < 4){
	    switch($_FILES['myfile'.$i]['error']){
		case 1:die("檔案大小超出 php.ini:upload_max_filesize 限制");
		case 2:die("檔案大小超出 MAX_FILE_SIZE 限制");
		case 3:die("檔案僅被部分上傳");
		case 4:die("檔案未被上傳");
	    }
    }

    if(is_uploaded_file($_FILES['myfile'.$i]['tmp_name'])){
	   $ww=900;
	
	   $DestDIR2 = "../pic/prod2";
	   $File_Extension = explode(".", $_FILES['myfile'.$i]['name']);
	   $File_Extension = $File_Extension[count($File_Extension)-1];
	   $ServerFilename1 =date("YmdHis").".".$File_Extension;
	   copy($_FILES['myfile'.$i]['tmp_name'], $DestDIR2."/".$ServerFilename1);
	   
	   $arr=getimagesize($DestDIR2."/".$ServerFilename1); 
	   $strarr=explode("\"",$arr[3]);
	   $w=$strarr[1];
		$h=$strarr[3];
		
		if ($w%$h!=0){
			echo "第".$i."張圖片---寬高比例必須1:1....<a href=\"javascript:history.go(-1);\">回上一頁</a>";
			exit;
		}
		if ($File_Extension!="swf" && $File_Extension!="SWF" && $File_Extension!="gif" && $File_Extension!="GIF") { 
	       $ServerFilename2 ="s_".$ServerFilename1;
		   
		   //s
		   ImageCopyResizedTrue($DestDIR2."/".$ServerFilename1,$DestDIR2."/".$ServerFilename2,80,80); 
           
	   }else{
           copy($_FILES['myfile'.$i]['tmp_name'], $DestDIR2."/".$ServerFilename2);
       }
	   
	   $sql="update tb_product2 set pic='$ServerFilename1' where id=$id";
	   mysql_query($sql);
       	
       if (is_file("../pic/prod2/".$ServerFilename22)) {
           unlink("../pic/prod2/".$ServerFilename22);
       }	

       if (is_file("../pic/prod2/s_".$ServerFilename22)) {
           unlink("../pic/prod2/s_".$ServerFilename22);
       }	   
	   
    }	
}

 $subject=carhow($_POST["subject"]);
$isshow=$_POST["isshow"];

$sql="update tb_product2 set isshow='$isshow' where id=$id";
mysql_query($sql);

				echo "<script language=javascript>
				     alert (\"修改成功. \");
					 document.location.href=\"product2.php?pid=$pid&srhcid=$srhcid&srhccid=$srhccid&srhcccid=$srhcccid&page=$page&page2=$page2\";
					 </script>";
?>
