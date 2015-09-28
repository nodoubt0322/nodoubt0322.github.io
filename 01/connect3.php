<?	
  
	
	//去除HTML 取代 '
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
//防sql資料隱碼
while (list($key, $value) = each( $_POST)) {      
	   $temp1=strchr(strtolower($value),"insert"); 
	   $temp2=strchr(strtolower($value),"delete"); 
	   $temp3=strchr(strtolower($value),"update"); 
	   $temp4=strchr(strtolower($value),"drop"); 
	   $temp5=strchr(strtolower($value),"select"); 
	   
       if ($temp1!="" || $temp2!="" || $temp3!="" || $temp4!="" || $temp5!=""){
           echo "請勿輸入不合法的字元....";
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
           echo "請勿輸入不合法的字元....";
	       exit;
       }
}	

 /*  Convert image size. true color*/ 
    //$src        來源檔案 
    //$dest        目的檔案 
    //$maxWidth    縮圖寬度 
    //$maxHeight    縮圖高度 
    //$quality    JPEG品質 
    function ImageCopyResizedTrue($src,$dest,$maxWidth,$maxHeight,$quality=100) { 

        //檢查檔案是否存在 
        if (file_exists($src)  && isset($dest)) { 

            $destInfo  = pathInfo($dest); 
            $srcSize   = getImageSize($src); //圖檔大小 
            $srcRatio  = $srcSize[0]/$srcSize[1]; // 計算寬/高 
            $destRatio = $maxWidth/$maxHeight; 
            if ($destRatio > $srcRatio) { 
                $destSize[1] = $maxHeight; 
                $destSize[0] = $maxHeight*$srcRatio; 
            } 
            else { 
                $destSize[0] = $maxWidth; 
                $destSize[1] = $maxWidth/$srcRatio; 
            } 


            //GIF 檔不支援輸出，因此將GIF轉成JPEG 
            //if ($destInfo['extension'] == "gif") $dest = substr_replace($dest, 'jpg', -3); 

            //建立一個 True Color 的影像 
            $destImage = imageCreateTrueColor($destSize[0],$destSize[1]); 

            //根據副檔名讀取圖檔 
            switch ($srcSize[2]) { 
                case 1: $srcImage = imageCreateFromGif($src); break; 
                case 2: $srcImage = imageCreateFromJpeg($src); break; 
                case 3: $srcImage = imageCreateFromPng($src); break; 
                default: return false; break; 
            } 

            //取樣縮圖 
            ImageCopyResampled($destImage, $srcImage, 0, 0, 0, 0,$destSize[0],$destSize[1], 
                                $srcSize[0],$srcSize[1]); 

            //輸出圖檔 
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
//0:星期日 1:星期一 2:星期二 3:星期三 4:星期四 5:星期五 6:星期六

$time_tmp=explode('-',$caldate);
$caldate=mktime(0,0,0,$time_tmp[1],$time_tmp[2],$time_tmp[0]);

switch (date('w',$caldate)){
case 0:
     return "日";
     break;
case 1:
     return "一";
     break;
case 2:
     return "二";
     break;
case 3:
     return "三";
     break;
case 4:
     return "四";
     break;
case 5:
     return "五";
     break;	 
case 6:
     return "六";
     break;
}	 
}	

$nowfile=htmlentities($_SERVER['REQUEST_URI']); 
$ip=$_SERVER['REMOTE_ADDR']; 
?>

