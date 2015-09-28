<?php include ("../connect.php"); 
   
$dir ='../pic/prod/';//設定路徑
if(is_dir($dir)){//檢查是否是目錄
 if($dh=opendir($dir)){//打開目錄
 $g=0;
  while(($file=readdir($dh))!==false){
   //$file = 檔名+副檔名
   //第一個跟第二個檔名是 .. 及 . 
   if($file!='..' && $file!='.'){
       $file=iconv("BIG5", "UTF-8",$file); //必要,否則中文會亂碼
	    $g++; 
	   if ($file!="20141227131018.jpg")
	   {
	   $sql="INSERT INTO `tb_prod` ( `cid`, `ccid`, `subject`, `memo2`, `price`, `fee_include`, `pic`, `ishot`, `isintro`, `stock`, `write_time`, `memo`, `isshow`, `fno`, `standing1`, `standing2`, `standing3`) VALUES ".
      "(2, 1, '".$g."', '', 1111, 'N', '".$file."', 'Y', 'Y', 0, now(), '', 'Y', '', 1, -1, 1);";
	  
       echo $sql."</br>";
	   mysql_query($sql);
	   }
   }
  }
  
 }
}

?>