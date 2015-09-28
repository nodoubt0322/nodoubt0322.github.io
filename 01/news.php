<?
   include ("title.php");
   ?>
            <div id="container">
                <!-- ----------------------------------  menu ------------------------------------ -->
                <div class="ind-menu">
                    <? include ("menu_prod.php"); ?> 
                    <div id="side_bom"></div>
                    <? include ("ksdfhsdf.php"); ?> 
                </div>
                <!-- menu end -->
                <!-- ----------------------------------  contentpage ------------------------------------ -->
                <div class="contentpage">
                    <div class="page-title-r inside-page">最新消息列表 /</div>
                    <div class="word">

                        <div class="news">
                            <?
if ($cid==""){		
	$sql="select * from tb_post order by `write_time` desc";
}else{
	  $sql="select * from tb_post where cid=$cid order by `write_time` desc";
	 		 
}
	//echo $sql."<BR>";	
$rs=mysql_query($sql);
$totnum= mysql_num_rows($rs);

//echo $totnum."<BR>";	
//exit;

if ($totnum>0) {
$page=carhow($_GET["page"]);
$page2=carhow($_GET["page2"]);
$pagenum= 10;                                   //每頁顯示筆數
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
			  $title=$row["subject"];
			  $createtime=$row["write_time"];
			  $memo=strip_tags($row["memo"]);
			  if (mb_strlen($memo,"UTF-8")>100) $memo=mb_substr($memo,0,100,"UTF-8")."...<a href=\"news-detail.php?kind=3&page=".$page."&page2=".$page2."&pid=".$pid."\">more</a>";;
?>			  
            <div class="line">
				<div class="title">
					<h2><a href="news-detail.php?kind=1&cid=<?=$cid;?>&page=<?=$page;?>&pid=<?=$pid;?>"><span class="data"><?=mb_substr($createtime,0,10,"UTF-8");?></span><?=$title?></a></h2>
				</div>
				  <div class="news-content">
				  <? if ($pic!="") { ?>
                     <div class="news-img"><a href="news-detail.php?kind=1&cid=<?=$cid;?>&page=<?=$page;?>&pid=<?=$pid;?>"><img src="pic/post/<?=$pic;?>" alt="" width="193" height="192" border="0" /></a></div>
              <? } ?>
					<p><?=$memo;?></p>
				  </div>
			</div>
<?        
         }
       }
    }	
}	
		
if ($totnum>0) { ?>
           <div class="digg">
		  <? if ($page!=1) { ?>
		        <a href="?cid=<?=$cid;?>&page=<?=$page-1;?>"> &lt; </a>
		  <? } 
		  
		     for ($i=1;$i<=$totpage;$i++){ 
				  if ($i===(int)$page){
		  ?>
		              <span class="current"><?=$i;?></span>
			<?    }else{ ?>			
			          <a href="?cid=<?=$cid;?>&page=<?=$i;?>"><?=$i;?></a>
			<?    } 
			}
												
			if ($page!=$totpage) { ?>
		        <a href="?cid=<?=$cid;?>&page=<?=$page+1;?>"> &gt; </a>
			<? } ?>	
		  </div>
<? }else{ ?>
        <center>無資料.</center>
<? } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    </div>
    <!--hot product end-->

    <div style="clear:both"></div>
    </div>
    <!-- container end -->
    </div>
    <!-- content end-->
    </div>
    <!-- wrapper end-->
    <!-- ----------------------------------  footer ------------------------------------ -->
    <?
   include ("bottom.php");
   ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/totop/js/jquery.ui.totop.js" type="text/javascript"></script>
    <script src="js/goodchange.js" type="text/javascript"></script>
    <!-- 選單js -->
    <script src="js/slick.min.js" type="text/javascript"></script>
    <!-- 熱門商品js -->
    <script src="js/main.js"></script>
</body>

</html>
