<? include ("session.php"); 
   include ("title.php");
   
   $ip=$_SERVER['REMOTE_ADDR']; 
?>
<form name="form2" action="prod.php" method="post">

<div  class="right" style="background-color:white;">
  <div class="right01"> 商品</div>
  
<ul>
      
      <li>
<table width="1400" border="0" align="center" style="color:black;" bgcolor="white">
    <tr>
      <td align="center" valign="top">	  
			<?	  
			//if ($ip!="220.133.44.52" && $ip!="223.136.129.0")
			//{
			//   echo "修改中...";
			   
			//}else{
			
			$focuspid=$_POST["focuspid"];
			if ($focuspid=="") $focuspid=$_GET["focuspid"];
            
			
			$srhcid=$_POST["srhcid"];
			if ($srhcid=="") $srhcid=$_GET["srhcid"];
            
			$srhcid2=$_POST["srhcid2"];
			if ($srhcid2=="") $srhcid2=$_GET["srhcid2"];
			
			$srhcid3=$_POST["srhcid3"];
			if ($srhcid3=="") $srhcid3=$_GET["srhcid3"];
			
			$srhkind=$_POST["srhkind"];
			if ($srhkind=="") $srhkind=$_GET["srhkind"];

			$addsql="";
			if ($srhcid!="") $addsql.=" and (a.cid=".$srhcid.") ";
			if ($srhcid2!="") $addsql.=" and (a.ccid=".$srhcid2.") ";
			//if ($srhcid3!="") $addsql=" and (a.cccid=".$srhcid3.") ";
			if ($srhkind!="") $addsql.=" and (a.subject like '%".$srhkind."%') ";
?>
			
			第1層分類:
			<select name="srhcid" id="srhcid" onchange="javascript:document.form2.srhcid2.value='';document.form2.submit();">
			<option value="">-請選擇-</option>
			<? 
			$sql2="select * from tb_item_kind order by standing";
			$rs2=mysql_query($sql2);

			  while ( $row2 = mysql_fetch_array($rs2)) 
			  {          
					  $sel="";
					  if ($srhcid!=""){
						  if ((int)$row2["cid"]==(int)$srhcid){
							  $sel=" selected";
						  }
					  }
			?>
					  <option value="<?=$row2["cid"];?>"<?=$sel;?>><?=$row2["cname"];?></option>

			<?
			  }  
			?>
			</select>　
			
			第2層分類:
			<select name="srhcid2" id="srhcid2" onchange="javascript:document.form2.submit();">
			<option value="">-請選擇-</option>
			<?
			  if ($srhcid!="")
			  {
				  $sel="";
				  if ($srhcid2!="")
				  {
					  if ((int)$srhcid2==-1){
						  $sel=" selected";
					  }
				  }
			  ?>
			       <option value="-1"<?=$sel;?>><無第2層分類></option>
			<? }
			
			 if ($srhcid!=""){
				$sql2="select * from tb_item_kind2 where cid=$srhcid order by standing";
				$rs2=mysql_query($sql2);

				  while ( $row2 = mysql_fetch_array($rs2)) 
				  {          
						  $sel="";
						  if ($srhcid2!="")
						  {
							  if ((int)$row2["ccid"]==(int)$srhcid2){
								  $sel=" selected";
							  }
						  }
				?>
						  <option value="<?=$row2["ccid"];?>"<?=$sel;?>><?=$row2["cname"];?></option>

				<?
				  }  
			  }
			?>
			</select>
			<BR><BR>
			商品名稱關鍵字查詢:<input type=text size=25 name="srhkind" id="srhkind" value="<?=$srhkind;?>">　
			<input type=submit value="查詢">　
			<input type=button value="所有商品" onclick="location.replace('prod.php')">　
			</form>
			<?	
//echo $addsql."<HR>";
			$addsql2="";
			$s_flag="";
			
			if ($srhcid=="" && $srhcid2=="") 
			{
			    $addsql2="a.standing1,";
				$s_flag="1";
			}
			
			$seclevel="N";
			if ($srhcid!="") 
			{
			    $sql2 = "SELECT * FROM `tb_prod` where cid=$srhcid and ccid=-1";
		        $rs2=mysql_query($sql2);
				$totnum2= mysql_num_rows($rs2);	
				
				if ($totnum=0) {
				    $addsql2="a.standing2,"; //無第2層產品
					$s_flag="2";
				}else{
				    $addsql2="a.standing3,"; //有第2層產品
					$s_flag="3";
					$seclevel="Y";
				}	
			}
			
			if ($srhcid!="" && $srhcid2=="-1") 
			{
			    $addsql2="a.standing2,";
				$s_flag="2";
			}
			
			if ($srhkind!="") 
            {
			    $addsql2="";
				$s_flag="";
			}	
				
$sql = "SELECT a.*,b.cname,c.cname as cname2 FROM `tb_prod` a 
        left join tb_item_kind b on a.cid=b.cid 
		left join tb_item_kind2 c on a.ccid=c.ccid 
        where a.pid>0 ".$addsql."order by ".$addsql2."a.write_time DESC";
			//echo $sql."<BR>";
			$rs=mysql_query($sql);
			$totnum= mysql_num_rows($rs);			
if ($totnum<=0) {
   echo "<BR><BR><center>無商品資料!
         <input type=button value=\"新增\" onclick=\"location.replace('prod_add.php?srhkind=$srhkind&page=$page&page2=$page2')\">";
}else{
	$page=$_GET["page"];
	if ($page=="") $page=$_POST["page"];
	
	$page2=$_GET["page2"];
	if ($page2=="") $page2=$_POST["page2"];
	
	$pagenum= 10000;                                  //每頁顯示筆數
	$pagenum2= 5;                                  //群組分頁每頁顯示頁數

	$totpage = (int)ceil($totnum/$pagenum);        //總頁數
	$grouppage = (int)ceil($totpage/$pagenum2);    //群組分頁總頁數

	if(!isset($page)) $page=1;                     //目前位於頁數
	if($page=="") $page=1;
	if((int)$page > $totpage)
	$page=$totpage;

	if(!isset($page2)) $page2=1;                   //群組分頁目前位於頁數
	if($page2=="") $page2=1;
	if((int)$page2 > $grouppage)
	$page2=$grouppage;
?>
		

<input type=button value="新增" onclick="location.replace('prod_add.php?srhcid=<?=$srhcid;?>&srhcid2=<?=$srhcid2;?>&srhkind=<?=$srhkind;?>&page=<?=$page;?>&page2=<?=$page2;?>')"><BR><BR>
<form name="form1" method="post">
<table border="1" cellpadding="0" style="color:black;" cellspacing="0" align=center style="border-collapse: collapse" bordercolor="#111111" width="1400">
<tr bgcolor="#C9C9C9">
<td align=center><font color=black>刪除</font></td>
<td align=center><font color=black>分類</font></td>
<td align=center><font color=black>產品圖</font></td>
<td align=center><font color=black>產品名稱</font></td>
<td align=center><font color=black>熱銷商品?</font></td>
<td align=center><font color=black>推薦商品?</font></td>
<td align=center><font color=black>狀態</font></td>
<td align=center><font color=black>更新時間</font></td>
<td align=center><font color=black>產品圖片</td>
<td align=center><font color=black>修改</font></td>

<?
if ($srhkind=="") 
{
   if (($srhcid=="" && $srhcid2=="") || ($srhcid!="" && $seclevel=="N") || ($srhcid!="" && $srhcid2!="")) { ?>
	<td align=center>目前順序</td>
	<td align=center>改變順序</td>
<? } 
}
?>
</tr>
<?					
    if(mysql_data_seek($rs,($page-1)*$pagenum) ){ 
       $i=0;
	   $iii=0;
	   $cidstr="";
       //循環顯示目前紀錄集
       for($i;$i<$pagenum;$i++){
           $row= mysql_fetch_array($rs);
           if($row){
		      $iii++;
              $pid=$row["pid"];
			  
			  $cidstr.=$pid.",";
			  
			  $say="";
			  $status=$row["isshow"];
			  if ($status=="Y") $say="<font color=blue>上架</font>";
			  if ($status=="N") $say="<font color=red>下架</font>";
			  
			  $say2="<font color=red>否</font>";
			  $ishot=$row["ishot"];
			  if ($ishot=="Y") $say2="<font color=blue>是</font>";
			  
			  $say22="<font color=red>否</font>";
			  $isintro=$row["isintro"];
			  if ($isintro=="Y") $say22="<font color=blue>是</font>";
			  
			  if ($focuspid!="" && (int)$focuspid==(int)$pid)
			  {
?>
                  <tr bgcolor="#C9F5AB">
<?           }else { ?>
	              <tr>
<?           } ?>			 
             <td align=center>
			 
			 <?//<a name="prod$pid" id="prod$pid;"></a>?>
			 <input type=checkbox name="delme" value="<?=$pid;?>"></td>
			 <td align=left>
			 <a href="prod.php?srhcid=<?=$row["cid"];?>"><font color=blue><?=$row["cname"];?></font></a>
             
			 <? if ($row["cname2"]!=""){?>
				  > <BR>
				 <a href="prod.php?srhcid=<?=$row["cid"];?>&srhcid2=<?=$row["ccid"];?>"><font color=blue><?=$row["cname2"];?></font></a>
			 <? } ?>
			 </td>
			 <td align=center>
			 <? if ($row["pic"]!=""){ ?>
			        <img src="../pic/prod/s_<?=$row["pic"];?>"></img>
			 <? } ?>
			 　</td>
			 <td align=left><font color=black><?=$row["subject"];?></font></td>
			 
			 <td align=left><?=$say2;?></td>
			 <td align=left><?=$say22;?></td>
			 <td align=left><font color=black><?=$say;?></font></td>
			 
			 <td align=left><font color=black><?=$row["write_time"];?></font></td>
			 <td align=center>
			 <a href="product2.php?srhcid=<?=$srhcid;?>&srhccid=<?=$srhccid;?>&srhcccid=<?=$srhcccid;?>&page=<?=$page;?>&page2=<?=$page2;?>&pid=<?=$pid;?>">產品圖片></a>
			 <?
			 $sql333 = "SELECT * FROM `tb_product2` ".
					 "where pid=".$pid;
						   
			  $rs333=mysql_query($sql333);
			  $totnum333= mysql_num_rows($rs333);
			  ?>(<?=$totnum333;?>)
			 </td>
			 
			 <td align=center><a href="prod_edit.php?srhkind=<?=$srhkind;?>&srhcid=<?=$srhcid;?>&srhcid2=<?=$srhcid2;?>&srhcid3=<?=$srhcid3;?>&page=<?=$page;?>&page2=<?=$page2;?>&pid=<?=$pid;?>">修改</a></td>
			 
<? 
if ($srhkind=="") 
{
			  if (($srhcid=="" && $srhcid2=="") || ($srhcid!="" && $seclevel=="N") || ($srhcid!="" && $srhcid2!="")) { 
			  ?>
						<td align=center><input type=text name="standing<?=$s_flag;?>_<?=$iii;?>" id="standing<?=$s_flag;?>_<?=$iii;?>" value="<?=$row["standing".$s_flag];?>" style="width:40px;"></td>
			  <?  if ($totnum>1)
			      {
			  ?>		   
						<td align=center>
						<input type=button value="上移" onclick="location.replace('prod_standing.php?s_flag=<?=$s_flag;?>&pid=<?=$row["pid"];?>&cid=<?=$srhcid;?>&ccid=<?=$srhcid2;?>&kind=1')">
						<input type=button value="下移" onclick="location.replace('prod_standing.php?s_flag=<?=$s_flag;?>&pid=<?=$row["pid"];?>&cid=<?=$srhcid;?>&ccid=<?=$srhcid2;?>&kind=2')">
						<input type=button value="置頂" onclick="location.replace('prod_standing.php?s_flag=<?=$s_flag;?>&pid=<?=$row["pid"];?>&cid=<?=$srhcid;?>&ccid=<?=$srhcid2;?>&kind=3')">
						<input type=button value="最後" onclick="location.replace('prod_standing.php?s_flag=<?=$s_flag;?>&pid=<?=$row["pid"];?>&cid=<?=$srhcid;?>&ccid=<?=$srhcid2;?>&kind=4')">
						</td>			 
			<?  }else{ ?>			
			           <td align=center>&nbsp;</td>
            <?  }					   
             }
}			 
			 ?>
			 </tr>
	<?    }	
		}
	}
?>		
	</table><BR>
	<center>

<input type=button value="刪　　除" onclick="javascript:delcid();">　
<?  if ($totnum>1 && $srhkind=="")
    {
?>
        <input type="hidden" name="cidstr" value="<?=$cidstr;?>">
		<input type=button value="更改順序" onclick="javascript:check();">
<? } ?>

<script language=javascript>
function check(){
ss=",";
<? for ($j=1;$j<=$iii;$j++) { ?>
   a=document.getElementById("standing<?=$s_flag;?>_<?=$j;?>").value;
   if (a==""){
      alert ("請輸入順序.");
      document.form1.standing<?=$s_flag;?>_<?=$j;?>.focus();      
      return;
   }
   
   if (isNaN(a)){
      alert ("順序必須為數字.");
      document.form1.standing<?=$s_flag;?>_<?=$j;?>.focus();
      return;
   }
   
   if (parseInt(a)<=0) {
      alert ("順序必須大於0.");
      document.form1.standing<?=$s_flag;?>_<?=$j;?>.focus();
      return;
   }
   
   if (ss.indexOf(","+a+",")!=-1){
      alert ("順序:"+a+"重複設定.");
      document.form1.standing<?=$s_flag;?>_<?=$j;?>.focus();
      return;
   }else{
      ss=ss+a+",";
   }      
<? } ?>

document.forms['form1'].action="prod_standing2.php?s_flag=<?=$s_flag;?>&cid=<?=$srhcid;?>&ccid=<?=$srhcid2;?>";
document.forms['form1'].submit();
}
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
            location.href="prod_del.php?srhcid=<?=$srhcid;?>&srhcid2=<?=$srhcid2;?>&srhcid3=<?=$srhcid3;?>&srhkind=<?=$srhkind;?>&cidstr="+cidstr;
         }
}
</script>
<?		
   if ($page2<>1){
       echo "<a href='prod.php?srhcid=".$srhcid."&srhcid2=".$srhcid2."&srhcid3=".$srhcid3."&srhkind=".$srhkind."&page=".($page2-1)*$pagenum2."&page2=".($page2-1)."'>上".$pagenum2."頁</a>　";    	
   }	
   
   if ($page2==$grouppage){
       $endpage=$totpage;	       
   }else{
       $endpage=$pagenum2*$page2;	       
   }
    	
   for ($i=($page2-1)*$pagenum2+1;$i<=$endpage;$i++) {
	if ($i==$page){
	    echo "<b><font size=2>".$i."</font></b>　";
	}else{
	    echo "[<a href='prod.php?srhcid=".$srhcid."&srhcid2=".$srhcid2."&srhcid3=".$srhcid3."&srhkind=".$srhkind."&page=".$i."&page2=".$page2."'>".$i."</a>]　";    
	}    
   }
   
   if ($page2<$grouppage){
       echo "<a href='prod.php?srhcid=".$srhcid."&srhcid2=".$srhcid2."&srhcid3=".$srhcid3."&srhkind=".$srhkind."&page=".($pagenum2*$page2+1)."&page2=".($page2+1)."'>下".$pagenum2."頁</a>　";    	
   }	
   
   echo "總筆數:".$totnum."筆";	
   }
   
   //}
  ?>
</td>
</tr>
</table>	
</form>
 </li> 
      
    </ul>
  </div>
  <?include ("bottom.php"); ?>