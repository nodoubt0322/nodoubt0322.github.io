<?
   include ("title.php");
  
$buy_pid=$_SESSION["bowchan_buy_pid"];
$buy_qty=$_SESSION["bowchan_buy_qty"];
$paykind=carhow($_POST["paykind"]);


if ($buy_pid=="" || $buy_qty=="" || $paykind=="") {
?>
	<script language=javascript>
	document.location.href="products.php";
	</script>
<?
	exit;
}	
        $zip=carhow($_POST["zip"]);
		$cname=carhow($_POST["cname"]);
		
		$tel=carhow($_POST["tel"]);
		$mobile=carhow($_POST["mobile"]);
		$email=carhow($_POST["email"]);
		$addr=carhow($_POST["addr"]);
		$gettime=carhow($_POST["gettime"]);
		$isstore=carhow($_POST["isstore"]);
		$memo=carhow($_POST["memo"]);
		if ($memo!="")
		{
			$memo=str_replace("\r\n","<BR>",$memo);
		}
		
		//已登入FB
		if ($_SESSION["bake_isfb"]=="Y")
		{
		    $email=$_SESSION["bake_fb_email"];
		}
			
//echo "zip=".$zip."<BR>";
//echo "cname=".$cname."<BR>";
//echo "email=".$email."<BR>";
//echo "addr=".$addr."<BR>";
//echo "gettime=".$gettime."<BR>";
//exit;		
        
		if ($zip=="" || $cname=="" || $email=="" || $addr=="" || $gettime=="") {
		?>
			<script language=javascript>
			document.location.href="products.php";
			</script>
		<?
			exit;
		}	
?> 
<form name="form1" method="post">
        <input type="hidden" name="cname" value="<?=$cname;?>">
		<input type="hidden" name="tel1" value="<?=$tel1;?>">
		<input type="hidden" name="tel" value="<?=$tel;?>">
		<input type="hidden" name="mobile" value="<?=$mobile;?>">
		<input type="hidden" name="email" value="<?=$email;?>">
		<input type="hidden" name="zip" value="<?=$zip;?>">
	    <input type="hidden" name="city" value="<?=$city;?>">
		<input type="hidden" name="town" value="<?=$town;?>">
		<input type="hidden" name="addr" value="<?=$addr;?>">
		<input type="hidden" name="gettime" value="<?=$gettime;?>">
		<input type="hidden" name="memo" value="<?=$memo;?>">
		<input type="hidden" name="isstore" value="<?=$isstore;?>">
		<input type="hidden" name="usepoint" value="<?=$usepoint;?>">
		<input type="hidden" name="paykind" value="<?=$paykind;?>">
		<input type="hidden" name="flag" value="999">
                <div class="contentpage-c">
                    <div class="titlestyle">購物車 /</div>
                    <div class="word">
                        <div class="products-c products-h">
                            <div class="cart">
                                <ul class="guide">
                                    <li class="color-gr3">
                                        <p class="font22px ts1">1</p>
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

                                    <li class="color-r">
                                        <p class="font22px ts1"><span class="font18px">Step </span>[4]</p>
                                        <p class="font12px font-b ts2">購物完成</p>
                                    </li>
                                </ul>
                                <!--guide-->
                                <div class="data-all">
            <div class="settle"> 
              <p class="sst2 cp"><span class="cp">請仔細確認以下資訊</span></p>
            </div>
            <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="b60">
              <tr class="tbtt">
                <td width="49%">商品名稱</td>
                <td width="5%">數量</td>
                <td width="7%">單價</td>
                <td width="7%">小計</td>
              </tr>
              <?

	  $ccc=split(",",$buy_pid);
	  $qqq=split(",",$buy_qty);
	  $tot=0;
	  $tot_qty=0;
	  $nofee=0;
      for ($i=0;$i<=sizeof($ccc);$i++)
	  {
	       if ($ccc[$i]!="")
		   {	
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
			   if ($totnum>0) {
			       $row = mysql_fetch_array($rs);  
                   $subject=$row["subject"];;				   
				   $pic=$row["pic"];
				   $prices=$row["price"];
						   $zzz=split(",",$prices);
						   $price=$zzz[$spec];
				   $tot=$tot+($price*$qty);
				   $tot_qty=$tot_qty+($qty);
				   $fee_include=$row["fee_include"];
				   if ($fee_include=="Y") $nofee=$nofee+$qty;
				   $c=split(",",$row["spec"]);
					$spec_memo=$c[$spec];
			   }
?>		   
              <tr class="tr1">
                <td class="color-p b2"><?=$subject;?>(<?=$spec_memo;?>)</td>
                <td><?=$qty;?></td>
                <td><?=number_format($price);?></td>
                <td><?=number_format($price*$qty);?></td>
              </tr>
<?         }
      }
	  
	  //台東縣綠島鄉951
	  $zipdata="209,210,211,212,880,881,882,883,884,885,890,891,892,893,894,896,951,";
	  $sayyy="(本島)";
	  if (strstr($zipdata,$zip.",")!="")
	  {
	      $sayyy="(外島)";
	  }
?>	
            </table>
            <p>&nbsp;</p>
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="b40">
              <tr class="tr1">
                <td width="9%">小計</td>
                <td width="1%">&nbsp;</td>
                <td width="26%">付款方式</td>
                <td width="1%">&nbsp;</td>
                <td width="20%">運送方式</td>
                <td width="2%">&nbsp;</td>
                <td width="19%">應付金額</td>
              </tr>
<?
    $sqla="select * from tb_slogin";
	$rsa=mysql_query($sqla);
	$rowa = mysql_fetch_array($rsa);
	
	$fee1=0;
	$fee111=0;
	$fee2=0;
	$fee11=$rowa["fee11"]; 
	$fee111=$rowa["fee111"];
	$fee12=$rowa["fee12"];  
	
	//echo "zip=".$zip."<BR>";
	//echo "fee11=".$fee11."<BR>";
	
	if ($zip!="")
	{
		if (strstr($zipdata,$zip.",")!="")
		{
			$fee11=$fee111;
		}
	}
	//echo "fee11=".$fee11."<BR>";
				
	$paykind1=$rowa["paykind1"]; 
	$paykind2=$rowa["paykind2"]; 
	$paykind3=$rowa["paykind3"]; 
	$paykind4=$rowa["paykind4"]; 
	
	$fee=0;
	
	//echo $tot."<BR>";
	//echo $fee11."<BR>";
	//echo $fee111."<BR>";
	//echo (int)$tot<(int)$fee11."<BR>";
	
	if ((int)$tot<(int)$fee11) 
	{
	   $fee=$fee111;
	}
	?>			  
              <tr>
                <td class="rnt font-b"><?=number_format($tot);?></td>
                <td>+</td>
                <td>
				<? if ($paykind=="1"){ ?>
				      貨到付款(另加收手續費:<?=number_format($fee12);?>元)
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
                <td>+</td>
                <td> 
                  <? if ($paykind=="1"){ ?> 
				  <?=number_format($fee+$fee12);?>(<?=number_format($fee);?>+<?=number_format($fee12);?>)
				<? }else{ ?>
                  <?=number_format($fee);?>
				<? } ?>  
				</td>
                <td>=</td>
                <td>NT$ <span class="nt">
				<? if ($paykind=="1"){ ?> 
				       <?=number_format($tot+$fee+$fee12);?>
				<? }else{ ?>
				       <?=number_format($tot+$fee);?>
				<? } ?>
				</span></td>
              </tr>
            </table>
            <div class="settle">
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
                  <td class="ldata"><?=$cname;?></td>
                </tr>
                <tr class="tr1">
                  <td class="rdata">收件人電話</td>
                  <td class="ldata"><?=$tel;?></td>
                </tr>
                <tr class="tr1">
                  <td class="rdata">收件人手機</td>
                  <td class="ldata"><?=$mobile;?></td>
                </tr>
                <tr class="tr1">
                  <td class="rdata">地址</td>
                  <td class="ldata">
                    <?				  
					$sql="select * from tb_zipcode where zip='$zip'";
						$rs=mysql_query($sql);
						
						$row= mysql_fetch_array($rs);
						$city22=$row["country"];
						$town22=$row["town"];
					?>	
                    <?=$city22;?><?=$town22;?><?=$addr;?>
                  
                  </td>
                </tr>
<?
	$say="";
	
	if ($gettime=="1") $say="上午";
	if ($gettime=="2") $say="下午";
	if ($gettime=="3") $say="晚上";
	?>				
                <tr class="tr1">
                  <td class="rdata">收貨時間</td>
                  <td class="ldata"><?=$say;?></td>
                </tr>
                <tr class="tr1">
                  <td class="rdata">備註</td>
                  <td class="ldata">
                    <p>
                      <?=$memo;?>
                  </p></td>
                </tr>
              </table>
            </div>
            
            <div class="settle"> 
              <p class="sst2 cp">              訂單完成後會寄至您的信箱: <?=$eee;?></p>
            </div>
            
            <div class="btn"><a href="javascript:pre();" class="btt2 r25">← 回上修改</a>
			<a href="javascript:check();" class="btt2">購物完成</a></div>
          </div>
        </div><!---cart--->
        <div style="clear:both"></div>
      </div>
      </div>
      <div style="clear:both"></div>
      </div>
      
<script language="javascript">
	  
	  function pre()
	  {
	           document.form1.action="shopping3.php";
			   document.form1.submit();
	  }
	   function check()
	  {
	           if (confirm("是否確定送出訂單資料?"))
			   {
				   document.form1.action="order_ok.php";
				   document.form1.submit();
			   }
	  }
	  </script>
</form> 

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
