<?	
  
	
	//�h��HTML ���N '
function  carhow($str){
          $p=trim($str);
		  $p=str_replace("'","`",$p);
		  //$p=stripslashes($p);
		  $p = strip_tags($p);
		  return $p;
}	
function  carhow2($str){
          $p=trim($str);
		  $p=str_replace("'","`",$p);		  
		  //$p=stripslashes($p);
		  return $p;
}
//0-9
function  carhow3($str){
          $p=trim($str);
		  $p=str_replace("'","`",$p);	
		  for ($z=1;$z<=strlen($p);$z++)
		  {
		       $pp=substr($p,$z-1,1);
			   if (strstr("0123456789",$pp)=="")
			   {
			       echo ("<script>document.location.href='index.php';</script>");
				   exit;
				}   
		  }
		  return $str;
}
//��sql������X
while (list($key, $value) = each( $_POST)) {      
	   $temp1=strchr(strtolower($value),"insert"); 
	   $temp2=strchr(strtolower($value),"delete"); 
	   $temp3=strchr(strtolower($value),"update"); 
	   $temp4=strchr(strtolower($value),"drop"); 
	   $temp5=strchr(strtolower($value),"select"); 
	   
       if ($temp1!="" || $temp2!="" || $temp3!="" || $temp4!="" || $temp5!=""){
           echo "�Фſ�J���X�k���r��....";
	       exit;
       }
}

while (list($key, $value) = each( $_GET)) {
	   //$_GET[$key] = mysql_real_escape_string($value);
	   
	   $temp1=strchr(strtolower($value),"insert"); 
	   $temp2=strchr(strtolower($value),"delete"); 
	   $temp3=strchr(strtolower($value),"update"); 
	   $temp4=strchr(strtolower($value),"drop"); 
	   $temp5=strchr(strtolower($value),"select"); 
	   
       if ($temp1!="" || $temp2!="" || $temp3!="" || $temp4!="" || $temp5!="")
	   {
           echo "�Фſ�J���X�k���r��....";
	       exit;
       }
}	

 /*  Convert image size. true color*/ 
    //$src        �ӷ��ɮ� 
    //$dest        �ت��ɮ� 
    //$maxWidth    �Y�ϼe�� 
    //$maxHeight    �Y�ϰ��� 
    //$quality    JPEG�~�� 
    function ImageCopyResizedTrue($src,$dest,$maxWidth,$maxHeight,$quality=100) { 

        //�ˬd�ɮ׬O�_�s�b 
        if (file_exists($src)  && isset($dest)) { 

            $destInfo  = pathInfo($dest); 
            $srcSize   = getImageSize($src); //���ɤj�p 
            $srcRatio  = $srcSize[0]/$srcSize[1]; // �p��e/�� 
            $destRatio = $maxWidth/$maxHeight; 
            if ($destRatio > $srcRatio) { 
                $destSize[1] = $maxHeight; 
                $destSize[0] = $maxHeight*$srcRatio; 
            } 
            else { 
                $destSize[0] = $maxWidth; 
                $destSize[1] = $maxWidth/$srcRatio; 
            } 


            //GIF �ɤ��䴩��X�A�]���NGIF�নJPEG 
            //if ($destInfo['extension'] == "gif") $dest = substr_replace($dest, 'jpg', -3); 

            //�إߤ@�� True Color ���v�� 
            $destImage = imageCreateTrueColor($destSize[0],$destSize[1]); 

            //�ھڰ��ɦWŪ������ 
            switch ($srcSize[2]) { 
                case 1: $srcImage = imageCreateFromGif($src); break; 
                case 2: $srcImage = imageCreateFromJpeg($src); break; 
                case 3: $srcImage = imageCreateFromPng($src); break; 
                default: return false; break; 
            } 

            //�����Y�� 
            ImageCopyResampled($destImage, $srcImage, 0, 0, 0, 0,$destSize[0],$destSize[1], 
                                $srcSize[0],$srcSize[1]); 

            //��X���� 
            switch ($srcSize[2]) { 
                case 1: case 2: imageJpeg($destImage,$dest,$quality); break; 
                case 3: imagePng($destImage,$dest); break; 
            } 
            return true; 
        } 
        else { 
            return false; 
        } 
    } 	
	
function www($caldate){
//0:�P���� 1:�P���@ 2:�P���G 3:�P���T 4:�P���| 5:�P���� 6:�P����

$time_tmp=explode('-',$caldate);
$caldate=mktime(0,0,0,$time_tmp[1],$time_tmp[2],$time_tmp[0]);

switch (date('w',$caldate)){
case 0:
     return "��";
     break;
case 1:
     return "�@";
     break;
case 2:
     return "�G";
     break;
case 3:
     return "�T";
     break;
case 4:
     return "�|";
     break;
case 5:
     return "��";
     break;	 
case 6:
     return "��";
     break;
}	 
}	

$nowfile=htmlentities($_SERVER['REQUEST_URI']); 
$ip=$_SERVER['REMOTE_ADDR']; 
?>

