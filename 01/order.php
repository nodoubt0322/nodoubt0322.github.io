<?
   include ("title.php");
   ?>
            <div id="container">
                <div class="ind-menu">
                    <div class="menu-title">會員中心 /</div>
                    <ul class="menu-list">
                        <li><a href="member.php">密碼/資料修改</a>
                        </li>
                        <li><a href="order.php">訂單查詢</a>
                        </li>
                        <li><a href="logout.php">登出</a>
                        </li>
                    </ul>
                    <div id="side_bom"></div>
                    <? include ("ksdfhsdf.php");?> 
                </div>


                <div class="contentpage">
                    <div class="page-title-r inside-page">訂單查詢 /</div>
                    <div class="word">
                        <div id="order">
                            <div class="titlestyle-s">
                                <span class="title"><span class="color-r">+</span> 訂單查詢 / <span class="titleE"> Order</span></span>
                            </div>
                            <!--titlestyle-->
                            <div>
                                <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="b60">
              <tr class="tbtt">
                <td>訂單編號</td>
                <td>訂單日期</td>
                <td>處理情形</td>
                <td>寄送日期</td>
                <td>對帳狀態</td>
                <td>付款方式</td>
                <td>&nbsp;</td>
              </tr>
              <?
			  if ($_SESSION["nod_isfb"]=="Y")
	          {
			      $fbid=$_SESSION["nod_fb_id"];
				  $sql="select * from tb_orders where fbid='$fbid' order by oid desc";
			  }else{
			      $sql="select * from tb_orders where member_id=$myid order by oid desc";
			  }
			  $rs=mysql_query($sql);
			  
			  $totnum= mysql_num_rows($rs);
			
			 if ($totnum==0)
			 {
			 ?>
			      <tr><td align=center colspan=7>無訂單資料</td></tr>
			 <?
			 }else{
					  $i=0;
					  while ( $row = mysql_fetch_array($rs)) 
					  {
							   $i++;
							   $paykind=$row["paykind"];
							   
								$say="";
					
								$s=$row["status"];
								if ($s=="N") $say="處理中";
								if ($s=="Y") $say="已完成";
								
								$say2="";	
								$o=$row["out_date"];
								
								if ($o=="0000-00-00")
								{
								   $say2="未出貨";
								}else{
								   $say2=$o;
								}	
								
								$say3="";
								$sm=$row["status_money"];
								if ($sm=="N") $say3="處理中";
								if ($sm=="Y") $say3="已完成";
					  ?>
							  <tr class="tr1">
								<td><?=$row["ono"];?></td>
								<td class="color-p b2"><?=substr($row["order_time"],0,10);?></td>
								<td><?=$say;?></td>
								<td><span class="color-p b2"><?=$say2;?></span></td>
								<td><?=$say3;?></td>
								<td>
								<?
								$paykind_say="";

								if ($paykind=="1") $paykind_say="貨到付款";
							    if ($paykind=="2") $paykind_say="ATM轉帳";
							    if ($paykind=="3") $paykind_say="銀行匯款";	
if ($paykind=="4") $paykind_say="門市取貨付款";	
								?>
								<?=$paykind_say;?>
								</td>
								<td><a href="order-1.php?oid=<?=$row["oid"];?>"><font color=red>匯款通知</font></a></td>
							  </tr>
			<?     } 
			  }
			  ?>
            </table>
                            </div>
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
