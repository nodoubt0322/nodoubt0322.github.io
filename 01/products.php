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
      	<div class="page-title-r">熱門商品</div>
        <div class="word">
        <div class="page-product">
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
		?>
      	         <a href="products-detail.php?backkind=2&cid=<?=$cid;?>&ccid=<?=$ccid;?>&page=<?=$page;?>&pid=<?=$pid;?>"><div class="column">
				  <p><img src="pic/prod/s_<?=$pic;?>" alt="" width="200" /></p>
				  <p class="font14px font-b"><?=$row["subject"];?></p>
				  <?//<p class="font12px color-gr3">每箱1入</p>?>
			      <p class="font10px color-g"><?=number_format($row["price"]);?>元</p>
				</div></a>
		<?       if ($iii%4==0)
                 {
		?>
                     <div style="clear:both"></div>
        <? 		 }
		    }
		} ?>
        <div style="clear:both"></div>
        
        
      </div>
        </div>
      </div>
      
      
      
      
      
      
      
      <div class="contentpage">
        <div class="page-title-r">推薦商品 // BEST</div>
        <div class="word">
          <div class="page-product">
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
		?>
      	         <a href="products-detail.php?cid=<?=$cid;?>&ccid=<?=$ccid;?>&page=<?=$page;?>&pid=<?=$pid;?>"><div class="column">
				  <p><img src="pic/prod/<?=$pic;?>" alt="" width="200" height="126" /></p>
				  <p class="font14px font-b"><?=$row["subject"];?></p>
				  <?//<p class="font12px color-gr3">每箱1入</p>?>
			      <p class="font10px color-g"><?=number_format($row["price"]);?>元</p>
				</div></a>
		<?       if ($iii%4==0)
                 {
		?>
                     <div style="clear:both"></div>
        <? 		 }
		    }
		} ?>
        <div style="clear:both"></div>
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
