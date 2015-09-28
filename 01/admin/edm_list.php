<? include ("session.php");
    include ("title.php");

	$kind2=$_GET["kind2"];
	if ($kind2=="") $kind2=$_POST["kind2"];
	
	$kind=$_GET["kind"];
	if ($kind=="") $kind=$_POST["kind"];
	
	$sel1="";
	$sel2="";
	$sel3="";
	$sel4="";
	$sel5="";
	
	if ($kind2=="") $kind2="0";
	
	if ($kind=="") $sel1=" selected";
	if ($kind=="0") $sel2=" selected";
	if ($kind=="1") $sel3=" selected";
	
	if ($kind2=="0") $sel4=" selected";
	if ($kind2=="1") $sel5=" selected";
?>
<div  class="right">
  <div class="right01"> 寄信列表</div>
<ul>
<li>

<table width="1000" border="0" align="center">
<tr>
	<td width="99%" colspan="2" align=center>
	<input type=button onclick="location.replace('edm_selfriend2.php')" value="寄信">
	</form>
	<table border="0" width="1000" height="300">
		<tr>
			<td valign=top>
<table width="100%" border="0">
    <tr>
      <td align=center valign=top><BR>
<?	  
    
		$sql="select * from tb_edm order by send_time desc";
		$rs=mysql_query($sql);
        $totnum= mysql_num_rows($rs);
		
if ($totnum<=0) {
   echo "<center>無資料!";
}else{
$pagenum= $eachpages;                                  //每頁顯示筆數
$pagenum2= 5;                                  //群組分頁每頁顯示頁數
$page=$_GET["page"];
$totpage = (int)ceil($totnum/$pagenum);        //總頁數
$grouppage = (int)ceil($totpage/$pagenum2);    //群組分頁總頁數

if(!isset($page)) $page=1;                     //目前位於頁數
if($page=="" || $page==0) $page=1;
if((int)$page > $totpage)
$page=$totpage;

if(!isset($page2)) $page2=1;                   //群組分頁目前位於頁數
if($page2==0) $page2=1;
if((int)$page2 > $grouppage)
$page2=$grouppage;
?>
<form name="form1">		
<table border="1" cellpadding="0" cellspacing="0" align=center style="border-collapse: collapse" bordercolor="#111111" width="95%">
<tr height=35 bgcolor="#1527A8">
<td align=center><font color=white>刪除</td>
<td align=center><font color=white>主旨</td>
<td align=center><font color=white>已寄送</td>
<td align=center><font color=white>已閱讀</td>
<td align=center><font color=white>閱讀率</td>
<td align=center><font color=white>開始寄送時間</td>
<td align=center><font color=white>結束寄送時間</td>
<td align=center><font color=white>寄送名單</td>
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
              $eid=$row["eid"];
			  
			  $sql3="select * from tb_edm2 where eid=$eid";
			  $rs3=mysql_query($sql3);
			  $totnum3= mysql_num_rows($rs3);
			  
			  $sql33="select * from tb_edm2 where eid=$eid and isread='Y'";
			  $rs33=mysql_query($sql33);
			  $totnum33= mysql_num_rows($rs33);
			  		  
?>
	         <tr height=35>
             <td align=center><input type=checkbox name="delme" value="<?=$eid;?>"></td>
			 <td align=left><a href="edm_content.php?eid=<?=$eid;?>" target="_blank"><?=$row["subject"];?></a></td>
			  <td align=right><?=$totnum3;?></td>
			   <td align=right><?=$totnum33;?></td>
			   <td align=right><?=round($totnum33/$totnum3*100,2);?> %</td>
			 <td align=left><?=$row["send_time"];?></td>			 
			 <td align=left><?=$row["finish_time"];?></td>			 
			 <td align=center><a href="edm_content2.php?kind2=<?=$kind2;?>&kind=<?=$kind;?>&page=<?=$page;?>&page2=<?=$page2;?>&eid=<?=$eid;?>">寄送名單</a></td>
			 </tr>
	<?    }	
		}
	}
?>		
	</table>
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
            location.href="edm_del.php?kind2=<?=$kind2;?>&kind=<?=$kind;?>&cidstr="+cidstr;
         }
}
</script>
<?		
   if ($page2<>1){
       echo "<a href='?kind2=".$kind2."&kind=".$kind."&page=".($page2-1)*$pagenum2."&page2=".($page2-1)."'>上".$pagenum2."頁</a>　";    	
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
	    echo "[<a href='?kind2=".$kind2."&kind=".$kind."&page=".$i."&page2=".$page2."'>".$i."</a>]　";    
	}    
   }
   
   if ($page2<$grouppage){
       echo "<a href='?kind2=".$kind2."&kind=".$kind."&page=".($pagenum2*$page2+1)."&page2=".($page2+1)."'>下".$pagenum2."頁</a>　";    	
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
  
  
 </body>
</html>