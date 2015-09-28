<?
   include ("title.php");
   ?>
            <div id="container">
                <div class="ind-menu">
                    <? include ("menu_prod.php"); ?> 
                    <div id="side_bom"></div>
                    <? include ("ksdfhsdf.php"); ?> 
                </div>
<?
     $pid=carhow($_GET["pid"]);
		  
		  $cid=carhow($_GET["cid"]);
  $page=carhow($_GET["page"]);
  $flag=carhow($_GET["flag"]);
//echo "pid=".$pid;
//exit;

     
  if ($pid==""){
?>
        <script language=javascript>
		 document.location.href="news.php";
		 </script>
<?	 
	     exit;
	 }
	 
	 
	 //$sql = "SELECT a.*,b.cname as cn1 FROM tb_post a left join tb_item_kind4 b on a.cid=b.cid 
		//	 where a.pid=$pid and b.isshow='Y'";
		
		$sql = "SELECT a.* FROM tb_post a 
			 where a.pid=$pid";
		
	 //echo $sql;
	 //exit;
	 $rs=mysql_query($sql);
	 $totnum= mysql_num_rows($rs);
			
	 if ($totnum==0)
	 {
?>
		<script language=javascript>
				document.location.href="news.php";
		</script>
<?
		   exit;	
	 }			
     $row= mysql_fetch_array($rs);
	 
			  $pic=$row["pic"];
			  $title=$row["subject"];
			  $createtime=$row["write_time"];
			  $memo=$row["memo"]; 
			  ?>
                <div class="contentpage">
                    <div class="page-title-r inside-page">最新消息內容 /</div>
                    <div class="word">

                        <div class="news">
                            <div class="line">
                                <div class="news-title">
                                    <h2><?=mb_substr($createtime,0,10,"UTF-8");?></span>　<?=$title?></h2>
                                </div>
                                <div class="news-content2">

                                    <p><?=$memo;?></p>
                                    <p>&nbsp;</p>
                                </div>

                            </div>
                            <div class="digg">
							<? if ($flag!="999") { ?>
		     <a href="news.php?cid=<?=$cid;?>&&page=<?=$page;?>">
		<? }else{ ?>
		     <a href="index.php">
		<? } ?>
							back</a>
                            </div>
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
