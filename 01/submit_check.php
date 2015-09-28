<?php
   //生成驗證碼圖片
        Header("Content-type: image/PNG"); 
        srand((double)microtime()*1000000);
        $im = imagecreate(80,28);
        $black = ImageColorAllocate($im, 0,0,0);
        $white = ImageColorAllocate($im, 255,255,255);
        $gray = ImageColorAllocate($im, 200,200,200);
imagefill($im,0,0,$white);   
   //將四位元整數驗證碼繪入圖片
        imagestring($im, 5, 10, 8, $_GET["authnum"], $black);

        for($i=0;$i<50;$i++)   //加入干擾象素
        {
                imagesetpixel($im, rand()%70 , rand()%30 , $black);

        }

        ImagePNG($im);
        ImageDestroy($im);

?>