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
   ?>
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
            
            <li class="color-gr3">
            <p class="font22px ts1">2</p>
            <p class="font12px font-b ts2">選擇付款方式</p>
            </li>
            
            <li class="color-r">
            <p class="font22px ts1"><span class="font18px">Step </span>[3]</p>
            <p class="font12px font-b ts2">填寫運送資料</p>
            </li>
            
            <li class="color-gr3">
            <p class="font22px ts1">4</p>
            <p class="font12px font-b ts2">購物完成</p>
            </li>
          </ul><!---guide--->
<form name="form1" method="post">	
<input type="hidden" name="paykind" value="<?=$paykind;?>">			  
          <div class="data-all">
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
	  
	  //echo "zip=".$zip."<BR>";
	  //台東縣綠島鄉951
	  $zipdata="209,210,211,212,880,881,882,883,884,885,890,891,892,893,894,896,951,";
	  $sayyy="(本島)";
	  if ($zip!="")
	  {
		  if (strstr($zipdata,$zip.",")!="")
		  {
			  $sayyy="(外島)";
		  }
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
                <td width="20%">運費</td>
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
<?
$flag=carhow($_POST["flag"]);

$gettime="";
$memo="";

if ($flag=="999")
{
	$zip=carhow($_POST["zip"]);	
	
	$sql="select * from tb_zipcode where zip='$zip'";
	$rs=mysql_query($sql);
	
	$row= mysql_fetch_array($rs);
	$city22=$row["country"];
	$town22=$row["town"];
	
	$cname=carhow($_POST["cname"]);
	
	$tel=carhow($_POST["tel"]);
	$mobile=carhow($_POST["mobile"]);
	$email=carhow($_POST["email"]);
	$addr=carhow($_POST["addr"]);
    $gettime=carhow($_POST["gettime"]);
	$isstore=carhow($_POST["isstore"]);
    $memo=carhow2($_POST["memo"]);
	//echo $memo."<BR>";
	if ($memo!="")
	{
	    $memo=str_replace("<BR>","\r\n",$memo);
	}
}else{
	$sql= "select * from tb_member where cid = '$mycid'";		
	$rs=mysql_query($sql);
	$rowm = mysql_fetch_array($rs);
    
	$cname=carhow($rowm["cname"]);
	
	$zip=carhow($rowm["zip"]);	
	$sql="select * from tb_zipcode where zip='$zip'";
	$rs=mysql_query($sql);
	
	$row= mysql_fetch_array($rs);
	$city22=$row["country"];
	$town22=$row["town"];
	
	
	
	$tel=carhow($rowm["tel"]);
	$mobile=carhow($rowm["mobile"]);
	$email=carhow($rowm["email"]);
	$addr=carhow($rowm["addr"]);
}

if ($_SESSION["lkknet_isfb"]=="Y")
{
    $email=$_SESSION["lkknet_fb_email"];
}	
?>
<input type="hidden" name="flag" value="999">
<input type="hidden" name="email" value="<?=$email;?>">
<script LANGUAGE="javascript">  
function Buildkey(nums) {
    p=nums.split("_");
	kind=p[0];
	num=p[1];
	var ctr=1;
	document.form1.subtype.selectedIndex=0;
	if (kind=="1") document.form1.zip.value="";  
	document.form1.subtype.options[0]=new Option("請選擇區域...","");

<? 
$s=explode(",","台北市,新北市,基隆市,桃園市,新竹市,新竹縣,苗栗縣,台中市,彰化縣,南投縣,雲林縣,嘉義市,嘉義縣,".
           "台南市,高雄市,屏東縣,宜蘭縣,花蓮縣,台東縣,澎湖縣,金門縣,連江縣");
   $ccc="";
   for ($i=0;$i<sizeOf($s);$i++){
         $citys=$s[$i];
		 if ($city22!=""){
		     if ($citys==$city22) $city=$i+1;
		 }
         $sql="select * from tb_zipcode where country='$citys' order by zip";
         $rs=mysql_query($sql);
         $ii=1;
		 
         while ($row= mysql_fetch_array($rs)){
             $ii++;
             if ($zip!=""){
                if ((int)$row["zip"]==(int)$zip) {
				    $ccc=$ii;
				}	
             }
?>	
	         if(num=="<?=$i+1;?>") {document.form1.subtype.options[ctr]=new Option("<?=$row["town"];?>","<?=$row["zip"];?>");ctr=ctr+1;}
<?       }
   } 
?>	

	document.form1.subtype.length=ctr;
	
	if (kind=="1"){
   	       document.form1.subtype.options[0].selected=true;
	}else{
         document.form1.subtype.options[<?=$ccc-1;?>].selected=true;
	}
} 

</script>			
            <div class="settle">
              <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="b40">
                <tr class="tbtt">
                  <td colspan="2" class="ldata">收件人資料</td>
                </tr>
                <tr class="tr1">
                  <td width="19%" class="rdata">帳號</td>
                 
                  <td width="81%" class="ldata">
				  <? //ynch*****@gmail.com 
//已登入FB
		if ($_SESSION["bake_isfb"]=="Y")
		{
		    $email=$_SESSION["bake_fb_email"];
		}
		
				  $e=$email;
				  $ee=explode("@",$e); 
                  $eee=substr($ee[0],0,3)."****@".$ee[1];
				  ?>
				  <?=$eee;?>
				  </td>
                </tr>
                <tr class="tr1">
                  <td class="rdata">收件人姓名</td>
                  <td class="ldata">
				  <input name="cname" type="text" class="sss3" id="cname" value="<?=$cname;?>" reqmsg="收件人姓名" /></td>
                </tr>
                <tr class="tr1">
                  <td class="rdata">收件人電話</td>
                  <td class="ldata"><input id="tel" name="tel" reqmsg="電話" type="text"  class="sss42" value="<?=$tel;?>" /></td>
                </tr>
                <tr class="tr1">
                  <td class="rdata">收件人手機</td>
                  <td class="ldata"><input id="mobile" name="mobile" type="text" value="<?=$mobile;?>" class="sss3" reqmsg="手機" /></td>
                </tr>
                <tr class="tr1">
                  <td class="rdata">地址</td>
                  <td class="ldata"><p>
                    <select name="city" class="text02" id="city" onChange="Buildkey('1_'+this.options[this.options.selectedIndex].value);">
                  <option value="">-選擇縣市-</option>
                  <? for ($i=0;$i<sizeOf($s);$i++){ 
		        $sel="";
				if ($city!=""){
				    if ((int)$city==$i+1) $sel=" selected";
				}
		?>
                  <option value="<?=$i+1;?>"<?=$sel;?>>
                    <?=$s[$i];?>
                    </option>
                  <? } ?>
                </select>
                    <select name="subtype" class="text02" id="subtype" onChange="document.form1.zip.value=this.options[this.options.selectedIndex].value;">
                    <option value="">-選擇區域-</option>
                </select>
                    <input id="addr" name="addr" type="text" value="<?=$addr;?>" reqmsg="地址"  class="sss5"/>
                  </p>
                  <p>需要注意的地方，請寫在住址欄後唷~（例如：公司、宿舍、管理員簽收...等等) </p></td>
                </tr>
<?
	$sel1="";
	$sel2="";
	$sel3="";
	
	if ($gettime=="1") $sel1=" checked";
	if ($gettime=="2") $sel2=" checked";
	if ($gettime=="3") $sel3=" checked";
	?>				
                <tr class="tr1">
                  <td class="rdata">收貨時間</td>
                  <td class="ldata"><input type="radio" name="gettime" id="gettime" value="1" <?=$sel1;?> />
                  上午 
                    <input type="radio" name="gettime" id="gettime" value="2" <?=$sel2;?> />
                  下午
                  <input type="radio" name="gettime" id="gettime" value="3" <?=$sel3;?> />
晚上</td>
                </tr>
                <tr class="tr1">
                  <td class="rdata">備註</td>
                  <td class="ldata"><p>如果有特別的注意事項也請告訴我們
                    </p>
                    <p>
                      <textarea id="memo" class="sss3" name="memo" title="如果有特別的注意事項也請告訴我們"><?=$memo;?></textarea>
                  </p></td>
                </tr>
              </table>
            </div>
            <div class="btn"><a href="javascript:pre();" class="btt2 r25">← 上一步</a>
			<a href="javascript:check();" class="btt2">下一步 →</a></div>
          </div>
        </div><!---cart--->
        <div style="clear:both"></div>
      </div>
      </div>
      <div style="clear:both"></div>
      </div>
      
<input type=hidden name="zip" id="zip" size=5 value="<?=$zip;?>">
	  <script language="javascript">
	  <? if ($city!="") { ?>
       Buildkey("0_<?=$city;?>");
<? } ?>
	  function pre()
	  {
	           document.form1.action="shopping2.php";
			   document.form1.submit();
	  }
	  
	  function check()
	  {
			 if (document.getElementById("cname").value==""){
				alert ("請輸入收件人姓名.");
				document.form1.cname.focus();
				return;
			 }
             if (document.getElementById("mobile").value=="" && document.getElementById("tel").value==""){
				alert ("請輸入收件人手機或電話...");
				document.form1.tel1.focus();
				return;
             }			 
			 if(document.getElementById("city").options[0].selected) {
				alert('請選擇收件人-縣市');
				return;
			 }
			   
			 if(document.getElementById("city").value!="5" && document.getElementById("city").value!="12")
			 {
			   
				 if(document.getElementById("subtype").options[0].selected) {
					alert('請選擇區域');
					return;
				}
			}
		
		    if(document.getElementById("city").value=="5")  document.getElementById("zip").value="300";
			if(document.getElementById("city").value=="12")  document.getElementById("zip").value="600";
			 
			
			 if (document.getElementById("addr").value==""){
				alert ("請輸入收件人-住址.");
				document.form1.addr.focus();
				return;
			 }
			 if (document.form1.gettime[0].checked==false && document.form1.gettime[1].checked==false && document.form1.gettime[2].checked==false){
				alert ("請選擇收貨時間.");
				return;		 
			 }
			 document.form1.action="shopping4.php";
			 document.form1.submit();
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
