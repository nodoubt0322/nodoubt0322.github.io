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
                        <li><a href="logout.php">登出</a></li>
                    </ul>
                    <div id="side_bom"></div>
                    <? include ("ksdfhsdf.php");?>
                </div>


                <?
		  $oid=carhow($_GET["oid"]);
		  if ($oid=="")
		  {
	?>
			<script language=javascript>
					document.location.href="order.php";
			</script>
	<?
			   exit;	
		  }
		  
		  if ($_SESSION["nod_isfb"]=="Y")
	      {
			  $fbid=$_SESSION["nod_fb_id"];
		      $sql="select * from tb_orders where oid=$oid and fbid='$fbid'";
		  }else{
              $sql="select * from tb_orders where oid=$oid and member_id=$myid";
          }		  
		  $rs=mysql_query($sql);
		  
		  $totnum= mysql_num_rows($rs);
			
		  if ($totnum==0)
		  {
	?>
			<script language=javascript>
					document.location.href="order.php";
			</script>
	<?
			   exit;	
		  }	
	 
		  $row = mysql_fetch_array($rs);
		  $paykind=$row["paykind"];
		  $zip=$row["zip"];
		  
		  $zipdata="209,210,211,212,880,881,882,883,884,885,890,891,892,893,894,896,";
		  $sayyy="(本島)";
		  if (strstr($zipdata,$zip.",")!="")
		  {
			  $sayyy="(外島)";
		  }
    ?> 
      <div class="contentpage">
      	<div class="page-title-r">訂單查詢 /</div>
        <div class="word">
        <div id="order">
    <div class="titlestyle-s">
      <span class="title"><span class="color-r">+</span> 訂單查詢 / <span class="titleE"> Order</span></span>
      <a href="order.php"><span class="more font10px">回上一層</span></a>
    </div><!---titlestyle--->
    <div>
      <div class="titlestyle02 b6">訂單明細</div>
<div>
  <table width="100%">
    <tbody>
       <tr>
        <td width="98" align="right" class="tbtt">訂單編號：</td>
        <td width="556" align="left"><?=$row["ono"];?></td>
        </tr>
      <tr>
        <td align="right" class="tbtt">填寫日期：</td>
        <td align="left"><?=substr($row["order_time"],0,10);?></td>
        </tr>
		<?
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
      <tr>
        <td align="right" class="tbtt">訂單狀態：</td>
        <td align="left"><?=$say;?></td>
        </tr>
      <tr>
        <td align="right" class="tbtt">對帳狀態：</td>
        <td align="left"><?=$say3;?></td>
        </tr>
      <tr>
        <td align="right" class="tbtt">總金額：</td>
        <td align="left"><span class="nt"><?=number_format($row["amount"]);?></span></td>
        </tr>
     
      <tr>
        <td align="right" class="tbtt">付款方式：</td>
        <td align="left">
		<? if ($paykind=="1"){ ?>
				      貨到付款
				 <? } 
				 
				 if ($paykind=="2"){ ?>
				      ATM轉帳
				<? }
				
				if ($paykind=="3"){ ?>
				      銀行匯款
				<? } 

if ($paykind=="4"){ ?>
				      門市取貨付款
				<? } 
				?>
		</td>
      </tr>
	  <? if ($paykind!="1" && $paykind!="4"){ ?>
	   <tr>
        <td align="right" class="tbtt">轉帳後5碼：</td>
        <td align="left">
		    <?
			$fiveno=$row["fiveno"];
			if ($fiveno=="")
			{
			?>
			   <form name="fiveform" action="fiveno_ok.php" method="post">
			   <input type="hidden" name="oid" value="<?=$oid;?>">
			   <input type=text name="fiveno" id="fiveno" size=10 maxlength=5>　
			   <input type="button" value="送出" onclick="javascript:checks();">
			   <script language=javascript>
			   function checks()
			   {
			            a=document.fiveform.fiveno.value;
						if (a=="")
						{
						    alert ("請輸入轉帳後5碼");
							document.fiveform.fiveno.focus();
							return;
						}
						if (a.length!=5)
						{
						    alert ("轉帳後5碼必須為五位數");
							document.fiveform.fiveno.focus();
							return;
						}
						
						if (confirm("送出後就不能再修改，是否確定送出?"))
						{
						    document.fiveform.submit();
						}
			   }
			   </script>
			   </form>
			<?
			}else{
			?>
			    <?=$fiveno;?>
			<?
			}
			?>
		</td>
	   </tr>
	  <? } ?> 
      <tr>
        <td align="right" class="tbtt">包裏編號：</td>
        <td align="left"><?=$row["packageno"];?>&nbsp;</td>
        </tr>
      <tr>
        <td align="right" class="tbtt">備註1：</td>
        <td align="left"><?=$row["memo1"];?> </td>
      </tr>
    </tbody>
  </table>
</div>
<div class="t40">
  <div class="titlestyle02 b6">購買物品內容</div>
  <div>
    <div>
      <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="b40">
        <tr class="tbtt">
          <td>商品名稱</td>
          <td>數量</td>
          <td>單價</td>
          <td>小計</td>
		  <td>缺貨</td>
		  <td>備註</td>
        </tr>
        <?
        $sqla="select * from tb_slogin";
		$rsa=mysql_query($sqla);
		$rowa = mysql_fetch_array($rsa);
		
		$fee1=0;
		$fee2=0;
		$fee11=$rowa["fee11"];
	    $fee111=$rowa["fee111"];
		$fee12=$rowa["fee12"];
		
		
				
		$sql3="select a.* from 
			   `tb_orders_detail` a 
			   where a.oid=$oid order by ooid";

		//echo $sql3."<BR>";

		$rs3=mysql_query($sql3);
		$iii=0;

		while ( $row3 = mysql_fetch_array($rs3)) 
		{
		?>
			<tr class="tr1">
			  <td class="color-p b2"><?=$row3["pname"];?></td>
			  <td><?=$row3["num"];?></td>
			  <td><?=number_format($row3["price"]);?></td>
			  <td><?=number_format($row3["price"]*$row3["num"]);?></td>
			  <td><?=str_replace("N","",str_replace("Y","V",$row3["islack"]));?></td>
		      <td><?=$row3["memo"];?></td>
			</tr>
        <? } ?>
      </table>
      <p>&nbsp;</p>
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="b40">
              <tr class="tr1">
                <td width="9%">小計</td>
                <td width="1%">&nbsp;</td>
                <td width="26%">付款方式</td>
                <td width="1%">&nbsp;</td>
                <td width="20%">運費</td>
                <td width="2%">&nbsp;</td>
                <td width="19%">應付金額</td>
              </tr>
              <tr>
                <td class="rnt font-b"><?=number_format($row["tot"]);?></td>
                <td>+</td>
                <td>
				<? if ($paykind=="1"){ ?>
				      貨到付款(另加運費:<?=$fee12;?>元)
				 <? } 
				 
				 if ($paykind=="2"){ ?>
				      ATM轉帳
				<? }
				
				if ($paykind=="3"){ ?>
				      銀行匯款
				<? }?> 
				</td>
                <td>+</td>
                <td> 
                  <?=number_format((int)$row["fee1"]+(int)$row["fee2"]);?> 
				</td>
                <td>=</td>
                <td>NT$ <span class="nt">
				<?=number_format($row["amount"]);?>
				</span></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table>
      <p>&nbsp;</p>
      <div class="titlestyle02 b6">運送明細</div>
      <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="b40">
        <tr class="tbtt">
          <td colspan="2" class="ldata">收件人資料</td>
        </tr>
        <tr class="tr1">
          <td width="19%" class="rdata">帳號/E-mail</td>
          <td width="81%" class="ldata">
		  <? //ynch*****@gmail.com 
				  $e=$mycid;
				  $ee=explode("@",$e); 
                  $eee=substr($ee[0],0,3)."****@".$ee[1];
				  ?>
				  <?=$eee;?>
				  </td>
        </tr>
        <tr class="tr1">
          <td class="rdata">收件人姓名</td>
          <td class="ldata"><?=$row["cname"];?></td>
        </tr>
        <tr class="tr1">
          <td class="rdata">收件人電話</td>
          <td class="ldata"><?=$row["tel"];?></td>
        </tr>
        <tr class="tr1">
          <td class="rdata">收件人手機</td>
          <td class="ldata"><?=$row["mobile"];?></td>
        </tr>
        <tr class="tr1">
          <td class="rdata">地址</td>
          <td class="ldata"><p> <?				  
		            $zip=$row["zip"];
					$sqlww="select * from tb_zipcode where zip='$zip'";
						$rsww=mysql_query($sqlww);
						
						$rowww= mysql_fetch_array($rsww);
						$city22=$rowww["country"];
						$town22=$rowww["town"];
					?>	
                    <?=$city22;?> 
                        <?=$town22;?>
            ********* </p>
            <?//<p>需要注意的地方，請寫在住址欄後唷~（例如：公司、宿舍、管理員簽收...等等) </p>?>
			</td>
        </tr>
        <tr class="tr1">
          <td class="rdata">收貨時間</td>
          <td class="ldata">
		  <?
				if ($row["gettime"]=="1") echo "上午";
				if ($row["gettime"]=="2") echo "下午";
				if ($row["gettime"]=="3") echo "晚上";
				?></td>
        </tr>
        <tr class="tr1">
          <td class="rdata">備註</td>
          <td class="ldata"><p><?=$row["memo"];?> </p></td>
        </tr>
      </table>
      <div class="btn"><a href="order.php" class="btt2">回上一層</a></div>
    </div>
  </div>
</div>
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
