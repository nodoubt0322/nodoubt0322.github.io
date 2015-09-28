<?
   include ("title.php");
   

 $buy_pid=$_SESSION["bowchan_buy_pid"];
		$buy_qty=$_SESSION["bowchan_buy_qty"];
		
		if ($buy_pid=="" || $buy_qty=="") {
		?>
			<script language=javascript>
			document.location.href="products.php";
			</script>
		<?
			exit;
		}
   ?>
            <div id="container">
      <div class="contentpage-c">
      	<h2 class="titlestyle">購物車 /</h2>
        <div class="word">
        <div class="products-c products-h">
        <div class="cart">
          <ul class="guide">
          	<li class="color-gr3">
            <p class="font22px ts1">1</p>
            <p class="font12px font-b ts2">確認購買清單</p>
            </li>
            
            <li class="color-r">
            <p class="font22px ts1"><span class="font18px">Step </span>[2]</p>
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
          </ul><!---guide--->
		  
<form name="form1" action="shopping3.php" method="post">		  		  
          <div class="data-all">
            <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="b60">
              <tr class="tbtt">
                <td width="49%">商品名稱</td>
                <td width="5%">數量</td>
                <td width="7%">單價</td>
                <td width="7%">小計</td>
              </tr>
              <?
$sqla="select * from tb_slogin";
	$rsa=mysql_query($sqla);
	$rowa = mysql_fetch_array($rsa);
	
	$fee11=0;
	$fee111=0;
	$fee12=0;
	
	$fee11=$rowa["fee11"];
	$fee111=$rowa["fee111"];
	$fee12=$rowa["fee12"];
	
	$paykind1=$rowa["paykind1"]; 
	$paykind2=$rowa["paykind2"]; 
	$paykind3=$rowa["paykind3"];
	
	  $ccc=split(",",$buy_pid);
	  $qqq=split(",",$buy_qty);
	  $tot=0;
	  $tot_qty=0;
	  $nofee=0;//運費內含
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
?>
            </table>
            
            <div class="settle">
              <p class="sst2 cp">消費滿: <span class="rnt"><?=number_format($fee11);?></span> 免運費。</p>
              <table width="700" border="0" align="center" cellpadding="0" cellspacing="0" >
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
    <td><?=number_format($tot);?></td>
    <td>+</td>
	
	<?
	$sel1="";
	$sel2="";
	$sel3="";
        $sel4="";
	
	$paykind=carhow($_POST["paykind"]);
	if ($paykind=="1") $sel1=" selected";
	if ($paykind=="2") $sel2=" selected";
	if ($paykind=="3") $sel3=" selected";
	if ($paykind=="4") $sel4=" selected";
	
	$fee=0;
	
	//echo $tot."<BR>";
	//echo $fee11."<BR>";
	//echo $fee111."<BR>";
	//echo (int)$tot<(int)$fee11."<BR>";
	
	if ((int)$tot<(int)$fee11) 
	{
	   $fee=$fee111;
	}
	
	//echo "fee=".$fee."<BR>";
	?>
    <td><select name="paykind" class="sss" style="width:200px;" id="paykind" onchange="javascript:showmemosss();">
      <option value="">-請選擇-</option>
	  <option value="1"<?=$sel1;?>>貨到付款(另加收手續費:<?=number_format($fee12);?>元)</option>
	  <option value="2"<?=$sel2;?>>ATM轉帳</option>
	  <option value="3"<?=$sel3;?>>銀行匯款</option>
	  <option value="4"<?=$sel4;?>>門市取貨付款</option>
    </select></td>
    <td>+</td>
    <td> 
	
      <span id="showfee"><?=number_format($fee);?></span>
    </td>
    <td>=</td>
    <td>NT$ <span id="showfee2"><span class="nt"><?=number_format($tot+$fee);?></span></span></td>
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
              </table>
            </div>
             <div class="ps">
               <p>
                 <span id="showmemo"></span>
			   </p>	 
            </div>
            <div class="btn"><a href="shopping.php" class="btt2 r25">← 上一步</a>　
			<a href="javascript:check();" class="btt2">下一步 →</a></div>
          </div>
        </div><!---cart--->
        <div style="clear:both"></div>
      </div>
      </div>
      <div style="clear:both"></div>
      </div>
      
<script language="javascript">
<?
if ($paykind!=""){
?>
    showmemosss();
<? } ?>

function check()
{
         a=document.form1.paykind.value;
		 if (a=="")
		 {
		     alert ("請選擇付款方式");
			 return;
		 }
		 document.form1.submit();
}     
function showmemosss()
{
         a=document.form1.paykind.value;
		 //alert (a);
		 //return;
		 
		 if (a=="")
		 {
		     showmemo.innerHTML="";
			 showfee.innerHTML="<?=number_format($fee);?>";
			 showfee2.innerHTML="<span class=\"nt\"><?=number_format($tot+$fee);?></span>";
		 }
		 if (a=="1")
		 {
		     showmemo.innerHTML="<?=$paykind1;?>";
			 showfee.innerHTML="<?=number_format($fee+$fee12);?>(<?=number_format($fee);?>+<?=number_format($fee12);?>)";
			 showfee2.innerHTML="<span class=\"nt\"><?=number_format($tot+$fee+$fee12);?></span>";
		 }
		 if (a=="2")
		 {
		    showmemo.innerHTML="<?=$paykind2;?>";
			showfee.innerHTML="<?=number_format($fee);?>";
			showfee2.innerHTML="<span class=\"nt\"><?=number_format($tot+$fee);?></span>";
		 }
		 if (a=="3")
		 {
		    showmemo.innerHTML="<?=$paykind3;?>";
			showfee.innerHTML="<?=number_format($fee);?>";
			showfee2.innerHTML="<span class=\"nt\"><?=number_format($tot+$fee);?></span>";
		 }
		 
}
</script>
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
