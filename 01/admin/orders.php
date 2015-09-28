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

   
    $sql="select a.*,b.cid from tb_orders a left join tb_member b on a.member_id=b.id where a.oid>0 ";
	
	if ($srhono!="") $sql.=" and (b.cid like '%$srhono%' or a.ono like '%$srhono%' or a.cname like '%$srhono%' or a.tel like '%$srhono%' or a.city like '%$srhono%' or a.town like '%$srhono%' or a.addr like '%$srhono%')";
    //if ($srhlevel!="") $sql.=" and RID<>'' ";
	
	$sql.=" order by a.order_time desc";
	
	//echo $sql."<BR>";
	
    $rs=mysql_query($sql);	
    $totnum= mysql_num_rows($rs);
?>
<div  class="right">
  <div class="right01"> 訂單</div>
  
<ul>
      
      <li>
	  <table width=1000 border=0 style="color:black;" align=center>
	  <tr><td align=center>
<form name="srhform" action="orders.php" method="post">
<center>
<?
$sel="";
if ($srhlevel=="1") $sel=" selected";
?>
查詢訂單關鍵字 (訂單編號/會員帳號/收貨人):<input type=text name="srhono" size=20 value="<?=$srhono;?>">
	
　
<input type=submit value="查詢">　
<input type=button value="所有訂單" onclick="location.replace('orders.php')">　
</center>
</form>
</td></tr></table>


<?	
if ($totnum<=0) {
   echo "<BR><BR><center>無訂單資料!";
   exit;
}   

$pagenum= 15;                                  //每頁顯示筆數
$pagenum2= 5;                                  //群組分頁每頁顯示頁數

$totpage = (int)ceil($totnum/$pagenum);        //總頁數
$grouppage = (int)ceil($totpage/$pagenum2);    //群組分頁總頁數

if(!isset($page)) $page=1;                     //目前位於頁數
if($page==0 || $page=="") $page=1;
if((int)$page > $totpage)
$page=$totpage;

if(!isset($page2)) $page2=1;                   //群組分頁目前位於頁數
if($page2==0 || $page2=="") $page2=1;
if((int)$page2 > $grouppage)
$page2=$grouppage;
		
?>
<form name="form1">
      <table width=1100 border="0" style="color:black;" cellspacing="0" align=center>
        <tr>
          <td align="center" valign="middle">
		  
		<table border='1' width=1100 cellspacing='0' style="color:black;" cellpadding='1' bordercolorlight='#006699' bordercolordark='#FFFFFF' align='center'>
				<tr bgColor="#6C6C6C">
				    <td align=center><font color=white>刪除</font></td>
					<td>
					<div align="center">
						<font color="white">訂單編號</font></div>
					</td>
					<td>
					<div align="center">
						<font color="white">會員帳號</font></div>
					</td>
					<td>
					<div align="center">
						<font color="white">收貨人</font></div>
					</td>
												
					<td>
					<div align="center">
						<font color="white">金額</font></div>
					</td>					
					
					<td>
					<div align="center">
						<font color="white">付款方式</font></div>
					</td>					
					
					<td>
					<div align="center">
						<font color="white">處理情形</font></div>
					</td>	
					
				  <td>
					<div align="center">
						<font color="white">寄出日期</font></div>
					</td>
					
				   <td>
					<div align="center">
						<font color="white">包裹編號</font></div>
					</td>
					
					<td>
					<div align="center">
						<font color="white">對帳狀態</font></div>
					</td>
					
					<td>
					<div align="center">
						<font color="white">訂購時間</font></div>
					</td>
					
					<td>
					<div align="center">
						<font color="white">訂單內容</font></div>
					</td>					
					
				</tr>
		<?
		   if(mysql_data_seek($rs,($page-1)*$pagenum) ){ 
			   $i=0;
			   $iii=0;
			   //循環顯示目前紀錄集
			   for($i;$i<$pagenum;$i++){
				   $row= mysql_fetch_array($rs);
				   if($row){
					  $iii++;
					  $oid=$row["oid"];
					  $paykind=$row["paykind"];

						//$say2="";

						//if ($row["status"]=="1") $say2="處理中";
						//if ($row["status"]=="2") $say2="已出貨";
						//if ($row["status"]=="3") $say2="未出貨";
						//if ($row["status"]=="4") $say2="已付款";
						//if ($row["status"]=="5") $say2="未付款";
						//if ($row["status"]=="6") $say2="待補貨";
						//if ($row["status"]=="7") $say2="已刪除";

						//$say3="";
						//if ($row["status"]=="N") $say3="處理中";
						//if ($row["status"]=="Y") $say3="<font color=blue>已出貨</font>";
						//if ($row["status"]=="D") $say3="<font color=red>取消訂單</font>";
						?>		
						<tr>
							<td align=center><input type=checkbox name="delme" value="<?=$oid;?>"></td>
							<td align=center><?=$row["ono"];?></td>	
							<td align=center>
							<? if ($row["fbid"]=="") { ?>
							       <?=$row["cid"];?>
							<? }else{ ?>
                                   <?=$row["fbname"];?>[FB]
                            <? } ?>							
							</td>	
							<td align=center>
							
							<?=$row["cname"];?></td>
                            						
							<td align=right><?=number_format($row["amount"]);?></td>
							<td align=center>
					  <?
						   $say="";
						   
							if ($paykind=="1") $say="貨到付款";
							if ($paykind=="2") $say="ATM轉帳";
							if ($paykind=="3") $say="銀行匯款";
if ($paykind=="4") $say="門市取貨付款";
						   ?>	
						   <?=$say;?>			
							</font></td>
							<?
							$say2="";
							$status=$row["status"];
							if ($status=="N") $say2="<font color=red>未完成</font>";
							if ($status=="Y") $say2="<font color=blue>已完成</font>";
							?>					
							<td align=center><?=$say2;?></td>
							<td align=left><?=str_replace("0000-00-00","",$row["out_date"]);?></td>
							<td align=left><?=$row["packageno"];?></td>
							<?
							$say3="";
							$status_money=$row["status_money"];
							if ($status_money=="N") $say3="<font color=red>處理中</font>";
							if ($status_money=="Y") $say3="<font color=blue>已處理</font>";
							?>						
							<td align=left><?=$say3;?></td>
							<td align=left><?=$row["order_time"];?></td>	
							
							<td align=center><a href="orders_detail.php?page=<?=$page;?>&page2=<?=$page2;?>&srhono=<?=$srhono;?>&srhlevel=<?=$srhlevel;?>&oid=<?=$oid;?>">訂單內容</a></td>	
							
						</tr>
		<?         }	
			}
		}
		?>
</table><BR>
<input type=button value="刪　　除" onclick="javascript:delcid();">　
<script language=javascript>
function delcid(){		 
         cidstr="";
         if ("<?=$iii;?>"=="1"){
            if (! document.form1.delme.checked){
               alert ("你沒有選擇任何東西哦..");
               return;
            }else{
               cidstr+=document.form1.delme.value+",";
            }               
         }else{
	  	    counter=0;

            for (i=0;i<=document.form1.delme.length-1;i++){			
                if (document.form1.delme[i].checked){
                   counter++;					   
                   cidstr+=document.form1.delme[i].value+",";
                }				
            }

            if (counter==0) {
               alert ("你沒有選擇任何東西哦...");
               return;
            }
         }
         
         if (! confirm("是否確定刪除?")){
            return;
         }else{
            location.href="orders_del.php?srhlevel=<?=$srhlevel;?>&srhlevel=<?=$srhlevel;?>&cidstr="+cidstr;
         }
}
</script>
</form>

<?	  

   if ($page2<>1){
       echo "<a href='orders.php?srhono=".$srhono."&srhlevel=".$srhlevel."&page=".($page2-1)*$pagenum2."&page2=".($page2-1)."'>上".$pagenum2."頁</a>　";    	
   }	
   
   if ($page2==$grouppage){
       $endpage=$totpage;	       
   }else{
       $endpage=$pagenum2*$page2;	       
   }
    	
   for ($i=($page2-1)*$pagenum2+1;$i<=$endpage;$i++) {
	if ($i==$page){
	    echo "<b><font size=4>".$i."</font></b>　";
	}else{
	    echo "[<a href='orders.php?srhono=".$srhono."&srhlevel=".$srhlevel."&page=".$i."&page2=".$page2."'>".$i."</a>]　";    
	}    
   }
   
   if ($page2<$grouppage){
       echo "<a href='orders.php?srhono=".$srhono."&srhlevel=".$srhlevel."&page=".($pagenum2*$page2+1)."&page2=".($page2+1)."'>下".$pagenum2."頁</a>　";    	
   }	
   
   echo "總筆數:".$totnum."筆";
   
  

?>
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