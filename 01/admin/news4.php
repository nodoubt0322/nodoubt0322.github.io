<? include ("session.php"); 
   include ("title.php");
?>
<form name="form2" action="news4.php" method="post">

<div  class="right">
  <div class="right01"> 通路介紹</div>
  
<ul>
      
      <li>
<table width="1200" border="0" align="center" style="color:black;">
    <tr>
      <td align="center" valign="top">	  
			<?	  
			$srhcid=$_POST["srhcid"];
			if ($srhcid=="") $srhcid=$_GET["srhcid"];
            
			$srhcid2=$_POST["srhcid2"];
			if ($srhcid2=="") $srhcid2=$_GET["srhcid2"];
			
			$srhcid3=$_POST["srhcid3"];
			if ($srhcid3=="") $srhcid3=$_GET["srhcid3"];
			
			$srhkind=$_POST["srhkind"];
			if ($srhkind=="") $srhkind=$_GET["srhkind"];

			$addsql="";
			if ($srhcid!="") $addsql=" and (a.cid=".$srhcid.") ";
			if ($srhcid2!="") $addsql=" and (a.ccid=".$srhcid2.") ";
			if ($srhcid3!="") $addsql=" and (a.cccid=".$srhcid3.") ";
			if ($srhkind!="") $addsql.=" and (a.subject like '%".$srhkind."%' or a.tel like '%".$srhkind."%' or a.addr like '%".$srhkind."%' or a.url like '%".$srhkind."%') ";
?>
			
			第1層分類:
			<select name="srhcid" id="srhcid" onchange="javascript:document.form2.srhcid2.value='';document.form2.submit();">
			<option value="">-請選擇-</option>
			<? 
			$sql2="select * from tb_item_kind5 order by standing";
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
			 if ($srhcid!=""){
				$sql2="select * from tb_item_kind6 where cid=$srhcid order by standing";
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
			<BR>
			關鍵字查詢:<input type=text size=25 name="srhkind" id="srhkind" value="<?=$srhkind;?>">　
			<input type=submit value="查詢">　
			<input type=button value="所有通路介紹" onclick="location.replace('news4.php')">　
			</form>
			<?	

$sql = "SELECT a.*,b.cname,c.cname as cname2 FROM `tb_news4` a 
        left join tb_item_kind5 b on a.cid=b.cid 
		left join tb_item_kind6 c on a.ccid=c.ccid 
        where a.pid>0 ".$addsql."order by a.write_time DESC";
			//echo $sql;
			$rs=mysql_query($sql);
			$totnum= mysql_num_rows($rs);			
if ($totnum<=0) {
   echo "<BR><BR><center>無通路介紹資料!
         <input type=button value=\"新增\" onclick=\"location.replace('news4_add.php?srhkind=$srhkind&page=$page&page2=$page2')\">";
}else{
	$page=$_GET["page"];
	$page2=$_GET["page2"];
	$pagenum= $eachpages;                                  //每頁顯示筆數
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
		

<input type=button value="新增" onclick="location.replace('news4_add.php?srhcid=<?=$srhcid;?>&srhcid2=<?=$srhcid2;?>&srhkind=<?=$srhkind;?>&page=<?=$page;?>&page2=<?=$page2;?>')"><BR><BR>
<form name="form1">
<table border="1" cellpadding="0" style="color:black;" cellspacing="0" align=center style="border-collapse: collapse" bordercolor="#111111" width="1200">
<tr bgcolor="#C9C9C9">
<td align=center><font color=black>刪除</font></td>
<td align=center><font color=black>分類</font></td>
<td align=center><font color=black>機構名稱</font></td>
<td align=center><font color=black>地址</font></td>
<td align=center><font color=black>電話</font></td>
<td align=center><font color=black>更新時間</font></td>
<td align=center><font color=black>修改</font></td>
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
              $pid=$row["pid"];
?>
	         <tr>
             <td align=center><input type=checkbox name="delme" value="<?=$pid;?>"></td>
			 <td align=left>
			 <font color=black><?=$row["cname"];?></font> > <BR>
			 <font color=black><?=$row["cname2"];?></font>
			 </td>
			 
			 <td align=left>
			 <? if ($row["url"]!="") { ?>
			      <a href="<?=$row["url"];?>" target="_blank"><?=$row["subject"];?></a>
			 <? }else{ ?>
			      <font color=black><?=$row["subject"];?></font>
			 <? } ?>
			 
			 </td>
			 <td align=left><font color=black><?=$row["addr"];?></font></td>
			 <td align=left><font color=black><?=$row["tel"];?></font></td>
			 <td align=left><font color=black><?=$row["write_time"];?></font></td>
			 <td align=center><a href="news4_edit.php?srhkind=<?=$srhkind;?>&srhcid=<?=$srhcid;?>&srhcid2=<?=$srhcid2;?>&srhcid3=<?=$srhcid3;?>&page=<?=$page;?>&page2=<?=$page2;?>&pid=<?=$pid;?>">修改</a></td>
			 </tr>
	<?    }	
		}
	}
?>		
	</table><BR>
	<center>

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
            location.href="news4_del.php?srhcid=<?=$srhcid;?>&srhcid2=<?=$srhcid2;?>&srhcid3=<?=$srhcid3;?>&srhkind=<?=$srhkind;?>&cidstr="+cidstr;
         }
}
</script>
<?		
   if ($page2<>1){
       echo "<a href='news4.php?srhcid=".$srhcid."&srhcid2=".$srhcid2."&srhcid3=".$srhcid3."&srhkind=".$srhkind."&page=".($page2-1)*$pagenum2."&page2=".($page2-1)."'>上".$pagenum2."頁</a>　";    	
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
	    echo "[<a href='news4.php?srhcid=".$srhcid."&srhcid2=".$srhcid2."&srhcid3=".$srhcid3."&srhkind=".$srhkind."&page=".$i."&page2=".$page2."'>".$i."</a>]　";    
	}    
   }
   
   if ($page2<$grouppage){
       echo "<a href='news4.php?srhcid=".$srhcid."&srhcid2=".$srhcid2."&srhcid3=".$srhcid3."&srhkind=".$srhkind."&page=".($pagenum2*$page2+1)."&page2=".($page2+1)."'>下".$pagenum2."頁</a>　";    	
   }	
   
   echo "總筆數:".$totnum."筆";	
   }
   
  ?>
</td>
</tr>
</table>	
</form>
 </li> 
      
    </ul>
  </div>
  <?include ("bottom.php"); ?>