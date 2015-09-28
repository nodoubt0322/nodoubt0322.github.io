<?
   include ("title.php");
   ?>
            <div id="container">
                <div class="ind-menu">
                    <? include ("menu_prod.php"); ?>
                    <div id="side_bom"></div>
                    
                    <? include ("ksdfhsdf.php");?> 
                </div>



                <div class="contentpage">
                    <div class="page-title-r inside-page">商品分類 /</div>
                    <div class="word">
                        <div class="page-product">
                            <?
if ($ccid!="")
{							
$sql="select * from tb_prod where cid=$cid and ccid=$ccid order by `write_time` desc";	 
}else{
$sql="select * from tb_prod where cid=$cid order by `write_time` desc";	 
}
	 
	//echo $sql."<BR>";	
$rs=mysql_query($sql);
$totnum= mysql_num_rows($rs);

if ($totnum>0) {
$page=carhow($_GET["page"]);
$page2=carhow($_GET["page2"]);
$pagenum= 24;                                   //每頁顯示筆數
$pagenum2= 10;                                  //群組分頁每頁顯示頁數

$totpage = (int)ceil($totnum/$pagenum);        //總頁數
$grouppage = (int)ceil($totpage/$pagenum2);    //群組分頁總頁數

if(!isset($page)) $page=1;                     //目前位於頁數
if($page==0 || $page=="") $page=1;
if((int)$page > $totpage)
$page=$totpage;

if(!isset($page2)) $page2=1;                   //群組分頁目前位於頁數
if($page2==0 || $page2=="") $page2=1;
if((int)$page2 > $grouppage)
$page2=$grouppage;	

   if(mysql_data_seek($rs,($page-1)*$pagenum) ){ 
       $i=0;
	   $iii=0;
       //循環顯示目前紀錄集
       for($i;$i<$pagenum;$i++){
           $row= mysql_fetch_array($rs);
           if($row){
		      $iii++;
			  $pid=$row["pid"];
			  $pic=$row["pic"]; 

$p=$row["price2"];	
                $k=explode(",",$p); 
				
				$pp=$row["price"];
				$kk=explode(",",$pp); 			  
?>			  
        <a href="products-detail.php?backkind=3&cid=<?=$cid;?>&ccid=<?=$ccid;?>&page=<?=$page;?>&pid=<?=$pid;?>"><div class="column">
				  <p><img src="pic/prod/s_<?=$pic;?>" alt="" width="200" /></p>
				  <p class="font14px font-b"><?=$row["subject"];?></p>
				 <p class="font12px color-gr3 linethrough">售價：<?=number_format($k[0]);?>元</p>
                                    <p class="font10px color-g"><?=number_format($kk[0]);?>元</p>
				</div></a>
		<?       if ($iii%4==0)
                 {
		?>
                     <div style="clear:both"></div>
        <? 		 } 
     
         }
       }
    }	
}	
?>		
        <div style="clear:both"></div>
            
            
            
          </div>
		  <?
          if ($totnum>0) { ?>
           <div class="digg">
		  <? if ($page!=1) { ?>
		        <a href="?cid=<?=$cid;?>&ccid=<?=$ccid;?>&page=<?=$page-1;?>"> &lt; </a>
		  <? } 
		  
		     for ($i=1;$i<=$totpage;$i++){ 
				  if ($i===(int)$page){
		  ?>
		              <span class="current"><?=$i;?></span>
			<?    }else{ ?>			
			          <a href="?cid=<?=$cid;?>&ccid=<?=$ccid;?>&page=<?=$i;?>"><?=$i;?></a>
			<?    } 
			}
												
			if ($page!=$totpage) { ?>
		        <a href="?cid=<?=$cid;?>&ccid=<?=$ccid;?>&page=<?=$page+1;?>"> &gt; </a>
			<? } ?>	
		  </div>
<? } ?>
        </div>
      </div>
    </div>
    </div> 
  </div>



    </div>
    <?
   include ("bottom.php");
   ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script> -->
    <script src="js/totop/js/jquery.ui.totop.js" type="text/javascript"></script>
    <!-- <script src="js/totop/js/easing.js" type="text/javascript" ></script> -->
    <script src="js/goodchange.js" type="text/javascript"></script>
    <!-- 選單js -->
    <script src="js/jqbanner/rotatingbanner.js" type="text/javascript"></script>
    <!-- banner輪轉js -->
    <script src="js/slick.min.js" type="text/javascript"></script>
    <!-- 熱門商品js -->
    <script src="js/main.js"></script>
</body>

</html>
