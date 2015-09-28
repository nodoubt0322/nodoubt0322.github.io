<?
   include ("title.php");
   ?>
       
            <div id="container">
                <!-- ----------------------------------  menu ------------------------------------ -->
                <div class="ind-menu">
                    <? include ("menu_prod.php"); ?>
                    <div id="side_bom"></div>
                    
                    <? include ("ksdfhsdf.php");?> 
                </div>
                <!-- menu end -->
                <!-- ----------------------------------  contentpage ------------------------------------ -->
                <div class="contentpage">
                <div class="search_bar">
                    <form>
                        <input type="text" id="search" placeholder="站內搜尋"><i class="fa fa-search fa-fw"></i>
                    </form>
                </div>
      	<!-- ----------------------------------  hot product ------------------------------------ -->
                    <div class="page-title-r"><span>熱銷商品</span>
                    </div>
                    <div id="hot-product" class="page-product" style="width:800px;margin:-20px 0 0 25px;">
<?
		$sql="select * from tb_prod where ishot='Y' and isshow='Y' order by `write_time` desc";
		$rs=mysql_query($sql);
        $totnum= mysql_num_rows($rs); 
		
		if ($totnum>0)
		{
		    $iii=0;
			while ($row= mysql_fetch_array($rs))
		    {
		         $iii++;
                 $pid=$row["pid"];
			     $pic=$row["pic"];

				$p=$row["price2"];	
                $k=explode(",",$p); 
				
				$pp=$row["price"];
				$kk=explode(",",$pp); 
		?>					
                        <div>
                            <a href="products-detail.php?backkind=1&cid=<?=$cid;?>&ccid=<?=$ccid;?>&page=<?=$page;?>&pid=<?=$pid;?>">
                                <div class="column">
                                    <div class="locate">
                                        <div class="hot"></div><img src="pic/prod/<?=$pic;?>" alt="" width="400" height="400" />
                                    </div>
                                    <p class="font14px font-b"><?=$row["subject"];?></p>
                                    <p class="font12px color-gr3 linethrough">售價：<?=number_format($k[0]);?>元</p>
                                    <p class="font10px color-g"><?=number_format($kk[0]);?>元</p>
                                </div>
                            </a>
                        </div>
                        
    <?    }
       }
    ?>	   
                       
                        
                    </div>
                </div>
                <!--hot product end-->
      
      
      <div class="contentpage">
        <div class="page-title-r"><span>推薦商品</span>
                    </div>
                    <div id="best-product" class="page-product" style="width:800px;margin-left:15px;">
                        <?
		$sql="select * from tb_prod where isintro='Y' and isshow='Y' order by `write_time` desc";
		$rs=mysql_query($sql);
        $totnum= mysql_num_rows($rs); 
		
		if ($totnum>0)
		{
		    $iii=0;
			while ($row= mysql_fetch_array($rs))
		    {
		         $iii++;
                 $pid=$row["pid"];
			     $pic=$row["pic"];   
		$p=$row["price2"];	
                $k=explode(",",$p); 
				
				$pp=$row["price"];
				$kk=explode(",",$pp); 
		?>					
                        <div>
                            <a href="products-detail.php?backkind=1&cid=<?=$cid;?>&ccid=<?=$ccid;?>&page=<?=$page;?>&pid=<?=$pid;?>">
                                <div class="column">
                                    <div class="locate">
                                        <div class="new"></div><img src="pic/prod/<?=$pic;?>" alt="" width="400" height="400" />
                                    </div>
                                    <p class="font14px font-b"><?=$row["subject"];?></p>
                                    <p class="font12px color-gr3 linethrough">售價：<?=number_format($k[0]);?>元</p>
                                    <p class="font10px color-g"><?=number_format($kk[0]);?>元</p>
                                </div>
                            </a>
                        </div>
                        
    <?    }
       }
    ?>	   
                    </div>
                </div>
                <!-- best product end-->
                <div style="clear:both"></div>
            </div>
            <!-- container end -->
        </div>
        <!-- content end-->
    </div>
    <!-- wrapper end-->
    </div></div></div>
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
