<?
   include ("title.php");
   ?>
            <div id="container">
                <div class="ind-menu">
                    <div class="menu-title">關於我們 /</div>
                    <ul class="menu-list">
                        <?
		  $cid=carhow($_GET["cid"]);
		  $sqlw="select * from tb_item_kindQA where isshow='Y' order by standing";
		  $rsw=mysql_query($sqlw);
		  
          $i=0;
		  $cname="";
		  $memo="";
		  while ( $roww = mysql_fetch_array($rsw)) 
		  {
		         $cids=$roww["cid"]; 
				 $i++;
				 if ($i==1 && $cid=="") $cid=$cids;
				 
				 if ((int)$cids==(int)$cid)
				 {
				     $cname=$roww["cname"];
					 $memo=$roww["memo"];
				 }
		?>  
                  <li><a href="about.php?cid=<?=$cids;?>"><?=$roww["cname"];?></a></li>
		<?       } ?>  
                    </ul>
                    <div id="side_bom"></div>
                    <ul class="advlist">
                        <? include ("ksdfhsdf.php"); ?> 
                    </ul>
                </div>
                <div class="contentpage">
                    <div class="page-title-r inside-page"><?=$cname;?> /</div>
                    <div class="word">
                        <?=$memo;?>
                        
                    </div>
                    <div class="about_form_f">&nbsp;</div>
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
    <script src="js/totop/js/jquery.ui.totop.js" type="text/javascript"></script>
    <script src="js/goodchange.js" type="text/javascript"></script>
    <!-- 選單js -->
    <script src="js/slick.min.js" type="text/javascript"></script>
    <!-- 熱門商品js -->
    <script src="js/main.js"></script>
</body>

</html>
