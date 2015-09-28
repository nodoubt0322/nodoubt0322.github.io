<?
   include ("title.php");
   ?>
            <div id="container">
                <div class="contentpage-c">
                    <div class="titlestyle">購物車 /</div>
                    <div class="word">
                        <div class="products-c products-h">
                            <div class="cart">
                                <ul class="guide">
                                    <li class="color-r">
                                        <p class="font22px ts1"><span class="font18px">Step </span>[1]</p>
                                        <p class="font12px font-b ts2">確認購買清單</p>
                                    </li>

                                    <li class="color-gr3">
                                        <p class="font22px ts1">2</p>
                                        <p class="font12px font-b ts2">選擇付款方式</p>
                                    </li>

                                    <li class="color-gr3">
                                        <p class="font22px ts1">3</p>
                                        <p class="font12px font-b ts2">填寫運送資料</p>
                                    </li>

                                    <li class="color-gr3">
                                        <p class="font22px ts1">4</p>
                                        <p class="font12px font-b ts2">購物完成</p>
                                    </li>
                                </ul>
                                <!--guide-->
                                <?
		  $buy_pid=$_SESSION["bowchan_buy_pid"];
          $buy_qty=$_SESSION["bowchan_buy_qty"];
		  
		  //echo "buy_pid=".$buy_pid."<BR>";
		  //echo "buy_qty=".$buy_qty."<BR>";
          ?>
          <div class="data-all">
<?		  
if ($buy_pid!="")
{
?>		  
            <table width="100%" cellpadding="0" cellspacing="0" class="b40">
              <tr class="tbtt tr1">
                <td>商品圖片</td>
                <td>商品名稱</td>
                <td>數量</td>
                <td>單價</td>
                <td>小計</td>
                <td>刪除</td>
                </tr>
<form name="form1" action="car_show2.php" method="post">
<?
	  $ccc=split(",",$buy_pid);
	  $qqq=split(",",$buy_qty);
	  $tot=0;
	  $tot_qty=0;
	  $ppp=0;
      for ($i=0;$i<=sizeof($ccc);$i++)
	  {
	       if ($ccc[$i]!="")
		   {
		       $ppp++;
			   $ddd=split("＿＿",$ccc[$i]);
			   $pid=(int)$ddd[0];
			   $spec=(int)$ddd[1];
			   $qty=$qqq[$i];  //數量
			   
			   $sql = "SELECT a.* FROM `tb_prod` a ".
					  "where a.pid=$pid and a.isshow='Y'";
			   $rs=mysql_query($sql);
			   $totnum= mysql_num_rows($rs);
               $subject="";
			   $pic="";
			   $price="";
			   $spec_memo="";
			   if ($totnum>0) {
			       $row = mysql_fetch_array($rs);  
                   $subject=$row["subject"];;				   
				   $pic=$row["pic"];
				   $price=$row["price"];
				   $tot=$tot+($price*$qty);
				   $tot_qty=$tot_qty+($qty);
				   $c=split(",",$row["spec"]);
					$spec_memo=$c[$spec];
			   }
?>
			   <input type="hidden" name="pid_<?=$ppp;?>" value="<?=$pid;?>">				
			   <input type="hidden" name="spec_<?=$ppp;?>" value="<?=$spec;?>">				
              <tr class="tr1">
                <td><a href="products-detail.php?backkind=4&pid=<?=$pid;?>"><img src="pic/prod/s_<?=$pic;?>" alt="" /></a></td>
                <td class="color-p b2"><?=$subject;?>(<?=$spec_memo;?>)</td>
                <td><select id="qty_<?=$ppp;?>" name="qty_<?=$ppp;?>" onchange="javascript:check();">
                  <? for ($iii=1;$iii<=10;$iii++) { 
				          $sel="";
						  if ($iii==(int)$qty) $sel=" selected";
				  ?>
                  <option value="<?=$iii;?>"<?=$sel;?>><?=$iii;?></option>
				<? } ?> 
                </select></td>
                <td><?=number_format($price);?></td>
                <td><?=number_format($price*$qty);?></td>
                <td><a href='javascript:dels("<?=$pid;?>_<?=$spec;?>");'><img src="images/Trash.png" width="16" height="16" alt="刪除" /></a></td>
                
                </tr>
              <? }
}
?>	
		<input type="hidden" name="totnumss" value="<?=$ppp;?>">
            </table>
            <div class="settle"> 
              <p class="cp">總件數  (共 <span class="rnt"><?=$tot_qty;?></span> 件)</p>
              <p class="sst2 cp">總金額: NT$ <span class="nt"><?=number_format($tot);?></span></p>
            </div>
<? }else{ ?>			
         <div class="settle"><p class="sst2 cp">目前購物車是空的</p></div>
<? } ?>			
            <div class="btn"><a href="products.php" class="btt2 r25">繼續購物</a>
			<?
if ($buy_pid!="")
{
?>			
			<a href="shopping2.php" class="btt2">下一步 →</a>
<? } ?>
</div>
          </div>
        </div><!---cart--->
        <div style="clear:both"></div>
      </div>
      </div>
      <div style="clear:both"></div>
      </div>
    </div> 
  </div>
   </div>
<?
if ($buy_pid!="")
{
?>	   
<script language=javascript>
function check(){
         document.form1.action="car_show2.php";
		 document.form1.submit();  
}

function dels(aaa){
         if (confirm("是否確定刪除？"))
		 {
             location.href="car_del.php?pid="+aaa;
		 }
}
</script>
<? } ?>
</form> 



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
