<? include ("session.php"); 
   include ("title.php");
	
	$srhono=$_POST["srhono"];
    if ($srhono=="") $srhono=$_GET["srhono"];
	
	$page=$_POST["page"];
    if ($page=="") $page=$_GET["page"];
	
	$page2=$_POST["page2"];
    if ($page2=="") $page2=$_GET["page2"];

	$srhlevel=$_GET["srhlevel"];	  
   if ($srhlevel=="") $srhlevel=$_POST["srhlevel"];
   
    $oid=$_GET["oid"];
	
	$sql="select a.*,b.mobile as mobile2 from tb_orders a ".
	     "left join tb_member b on a.member_id=b.id ".
		 "where a.oid=$oid";
    
	$rs=mysql_query($sql);
    $totnum= mysql_num_rows($rs);

    if ($totnum==0) {
 ?>
   <script language=javascript>
   location.href="orders.php";
   </script>
<?    exit;
    }
	
	$row= mysql_fetch_array($rs);	
	
$tot=$row["tot"];	
$fee1=$row["fee1"];	
$fee2=$row["fee2"];
$amount=$row["amount"];	
$out_date=$row["out_date"];
	
$status=$row["status"];	
$status_money=$row["status_money"];	
$packageno=$row["packageno"];	
	
$memo1=$row["memo1"];	
$deal_time=$row["deal_time"];	

$ono=$row["ono"];
$paykind=$row["paykind"];
$cname=$row["cname"];

$tel1=$row["tel1"];
$tel=$row["tel"];

$mobile2=$row["mobile2"];
$mobile=$row["mobile"];
if ($mobile=="") $mobile=$mobile2;

$zip=$row["zip"];
		  $zipdata="209,210,211,212,880,881,882,883,884,885,890,891,892,893,894,896,";
		  $sayyy="(本島)";
		  if (strstr($zipdata,$zip.",")!="")
		  {
			  $sayyy="(外島)";
		  }
		  
$city=$row["city"];
$town=$row["subtype"];
$addr=$row["addr"];

$email=$row["email"];
$gettime=$row["gettime"];
$order_time=$row["order_time"];
$order_date=$row["order_date"];
$rec_time=$row["rec_time"];

$memo=$row["memo"];


$paykind_say="";

if ($paykind=="1") $paykind_say="貨到付款";
if ($paykind=="2") $paykind_say="ATM轉帳";
if ($paykind=="3") $paykind_say="銀行匯款";
if ($paykind=="4") $paykind_say="門市取貨付款";
$sql8="select * from tb_slogin";
$rs8=mysql_query($sql8);
$row8 = mysql_fetch_array($rs8);
$feekind="N";


$sql2="select * from tb_zipcode where zip='$zip'";
$rs2=mysql_query($sql2);
$row2= mysql_fetch_array($rs2);
$city=$row2["country"];
$town=$row2["town"];
	

$buy_pid="";
$buy_qty="";

				
	$sql4="select * from tb_orders_detail where oid=$oid order by ooid";
    $rs4=mysql_query($sql4);      
    while ( $row4 = mysql_fetch_array($rs4)) {
            $buy_pid.=$row4["pid"]."＿＿test＿＿^^＿＿".$row4["ooid"]."＿＿".$row4["price"]."＿＿".$row4["pname"]."＿＿".$row4["islack"]."＿＿".$row4["memo"].",";
            $buy_qty.=$row4["num"].",";	
	}
$ccc=split(",",$buy_pid);
      $qqqq=split(",",$buy_qty);
?> 
<div  class="right">
  <div class="right01"> 訂單內容</div>
  
<ul> 
      <li>
			<form name="form1" action="orders_detail_ok.php" method="post">
			<input type=hidden name="oid" value="<?=$oid;?>">
			<input type=hidden name="srhono" value="<?=$srhono;?>">
			<input type=hidden name="srhlevel" value="<?=$srhlevel;?>">
			<input type=hidden name="page" value="<?=$page;?>">
			<input type=hidden name="page2" value="<?=$page2;?>">
<?
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $data="<center>
		       <table border=\"0\" style=\"color:black;\" width=\"850\"><tr><td align=left>訂單編號:".$ono."</td></tr>
			    <tr>
                    <td align=left>訂購時間:<font color=black>".$order_time."</td>
				</tr>	
			   </table>
		       <table cellpadding=\"0\" cellspacing=\"0\" style=\"color:black;\" border=\"1\" width=\"850\">
				<tr bgcolor=lightblue>
				  <th>NO</th>
				  <th>產品名</th>
				  <th>價格</th>
				  <th>數量</th>
				  <th>小計</th>
				  <th>缺貨</th>
				  <th>備註</th>
				</tr>";
				
		  $xxx=0;  
		  
		  for ($i=0;$i<=sizeof($ccc);$i++)
		  {
			   if ($ccc[$i]!="")
			   {
				   $c=split("＿＿",$ccc[$i]);
				   
				   $price=$c[4];     //訂購明細-價格
				   $ooid=$c[3];     //訂購明細-編號
				   $pid=$c[0];      //購買的商品編號
				   
				   $islack=$c[6];
				   $memoss=$c[7];
				   //echo $pid."<BR>";
				   //echo $g."<BR>";
				   
				   //$bb=split("_",$g);
				   //$bbb=$bb[0];     
				   
				   $aqty=$qqqq[$i]; //數量
				   
				   $subject=$c[5];
				   
				   
				   $xxx++;
				   $sel="";
				   if ($islack	=="Y") $sel=" checked";
					
					$data.="<input type=hidden name=\"ooid_".$xxx."\" id=\"ooid_".$xxx."\" value=\"".$ooid."\">
					  <tr align=\"center\">
					  <td>".substr("00".$xxx,-3)."</td>
					  <td>".$subject."</td>
					  <td>".number_format($price)." 元</td>
					  <td>".number_format($aqty)."</td>
					  <td>".number_format($price*$aqty)." 元</td>
					  <td><input type=checkbox name=\"delme".$xxx."\" id=\"delme".$xxx."\" value=\"Y\"".$sel."> </td>
					  <td><input type=text name=\"memo_prod".$xxx."\" id=\"memo_prod".$xxx."\" value=\"".$memoss."\" size=40> </td>
					</tr>";  
					}							
				  }  
      
	     $data.="</table>
			  <table cellpadding=\"0\" style=\"color:black;\" cellspacing=\"0\" border=\"0\" width=\"850\">
				<tr>
				  <td align=\"right\">總和&nbsp;&nbsp;&nbsp;<span>".number_format($tot)." 元</span></td></tr>";
												
		
		 $data.="<input type=hidden name=\"xxx\" id=\"xxx\" value=\"".$xxx."\">
		        <tr>
				  <td align=\"right\">運費&nbsp;&nbsp;&nbsp;<span>".number_format($fee1+$fee2)." 元</span></td></tr>
		        <tr>
				  <td align=\"right\">商品金額總計&nbsp;&nbsp;&nbsp;<span>".number_format($tot+$fee1+$fee2)." 元</span>
					  </td>
					</tr>
				  </table><HR width=850>
				  <table width=850 style=\"color:black;\" align=center border=1\">
					
				<tr>
				  <td  bgcolor=lightblue>收件人資料</td>
				  </tr>
					
				  <tr>
						  <td>姓名 / ".$cname;

$sqlp="select * from tb_slogin";
$rsp=mysql_query($sqlp);
$rowp = mysql_fetch_array($rsp);
		
if ($gettime=="1") $gettime2="上午";
if ($gettime=="2") $gettime2="下午";
if ($gettime=="3")$gettime2="晚上";
				
$data.="</td></tr>
	  <tr><td>住址 / ".$zip." ".$city.$town.$addr."     </td></tr>
	  <tr><td>電話 / ".$tel."     </td></tr>
	  <tr><td>手機 / ".$mobile."     </td></tr>
	  <tr><td>收貨時間 / ".$gettime2."     </td></tr>
	  <tr><td>給商家的話 / <BR> ".str_replace("\r\n","<BR>",$memo)."     </td></tr>
	  <tr><td>付款方式  ： ".$paykind_say;

if ($paykind=="1" || $paykind=="3" || $paykind=="5")
{
    
	if ($row["allpay_RtnCode"]=="")
	{
	    $data.="<BR><font color=red>未付款</font>";
	}else{
	    $data.="<BR><font color=blue>已付款</font>";
		
		if ($row["allpay_RtnCode"]=="1") 
		{
		    if ($row["allpay_RtnMsg"]=="Succeeded")
			{
		        $data.="<BR><font color=blue><B>付款狀態:</B>成功</font>";
		    }else{
		        $data.="<BR><font color=blue><B>付款狀態:</B>失敗(原因:".$row["allpay_RtnMsg"].")</font>";
			}	
		}
		$data.="<BR><font color=blue><B>Allpay交易編號:</B>".$row["allpay_TradeNo"]."</font>";
		$data.="<BR><font color=blue><B>Allpay付款金額:</B>".$row["allpay_TradeAmt"]."</font>";
		$data.="<BR><font color=blue><B>Allpay交易時間:</B>".$row["allpay_TradeDate"]."</font>";
		$data.="<BR><font color=blue><B>Allpay付款時間:</B>".$row["allpay_PaymentDate"]."</font>";
	}
}			  

$data.="</td></tr>";

 if ($paykind=="4")
 {
     $data.="<tr><td>轉帳後5碼  ： ".$row["fiveno"]."</td></tr>";
 }
 
$data.="</table><BR><table width=850 align=center style=\"font-size:16PX;\" border=0>";	  
	   
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
<?=$data;?>	
</table>

<HR width=850>

<table width=850 style="color:black;" align=center border=1>
<tr>
  <td  bgcolor=lightblue>訂單處理</td>
</tr>
<?
$sel1="";
$sel2="";

if ($status=="N") $sel1=" checked";
if ($status=="Y") $sel2=" checked";
?>
<tr><td>
訂單狀態 / 
<input type="radio" name="status" id="status" value="N"<?=$sel1;?>>未完成　
<input type="radio" name="status" id="status" value="Y"<?=$sel2;?>>已完成
<input type="hidden" name="old_status" id="old_status" value="<?=$status;?>">
</td></tr>				

<?
$sel1="";
$sel2="";

if ($status_money=="N") $sel1=" checked";
if ($status_money=="Y") $sel2=" checked";
?>
<tr><td>
對帳狀態 / 
<input type="radio" name="status_money" id="status_money" value="N"<?=$sel1;?>>處理中　
<input type="radio" name="status_money" id="status_money" value="Y"<?=$sel2;?>>已處理
</td></tr>				

<tr><td>
包裹編號 / 
<input type="text" size=25 name="packageno" id="packageno" value="<?=$packageno;?>">
</td></tr>	

<tr><td>
寄出日期 / 
<input type="text" name="out_date" id="out_date" value="<?=str_replace("0000-00-00","",$out_date);?>" size=15 onclick="javascript:void(0);if(self.gfPop)gfPop.fPopCalendar(document.form1.out_date);return false;" readonly style="font-family:arial;">&nbsp;<a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.out_date);return false;" ><img src="HelloWorld2/calbtn.gif" border=0></a>

</td></tr>	

<tr><td>
處理備註 / 
<input type="text" size=50 name="memo1" id="memo1" value="<?=$memo1;?>">
</td></tr>	

<tr><td>
處理時間 / 
<font color=blue><?=str_replace("0000-00-00 00:00:00","未處理",$deal_time);?></font>
</td></tr>	
</table>
			  
                <BR><center>
				
                    <input value="送出" type="button" onclick="javascript:check();" />　
				
					<input value="返回" type="button" onclick="javascript:check2();" />
		  </td>
        </tr>
      </table>
<input type="hidden" name="cidstr">
            <script language="JavaScript">

function check(){
         
 		    document.form1.submit();
}

function check2(){
		 document.location.href="orders.php?page=<?=$page;?>&page2=<?=$page2;?>&srhono=<?=$srhono;?>&srhlevel=<?=$srhlevel;?>";
}
              </script>	
</form>	

      </li> 
      
    </ul>
  
  </td>
</tr>
</table>	
</form>
 </li> 
      
    </ul>
  </div>
  <?include ("bottom.php"); ?>
<iframe width=174 height=189 name="gToday:normal:HelloWorld2/agenda.js" id="gToday:normal:HelloWorld2/agenda.js" src="HelloWorld2/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">   