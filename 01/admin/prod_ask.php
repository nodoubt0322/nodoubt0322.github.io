<?include ("session.php"); 
   include ("title.php");
   
   $page=$_GET["page"];  
if ($page=="") $page=$_POST["page"];

$page2=$_GET["page2"];  
if ($page2=="") $page2=$_POST["page2"];

   $srhcid=$_GET["srhcid"];  
if ($srhcid=="") $srhcid=$_POST["srhcid"];
 	
	$srhcid2=$_GET["srhcid2"];  
if ($srhcid2=="") $srhcid2=$_POST["srhcid2"];

$srhcid3=$_GET["srhcid3"];  
if ($srhcid3=="") $srhcid3=$_POST["srhcid3"];

$srhkind=$_GET["srhkind"];     
if ($srhkind=="") $srhkind=$_POST["srhkind"];

 
?>
<div  class="right">
  <div class="right01"> 商品諮詢</div>
  
<ul>
      
      <li>
	  
<table width="1200" style="color:black;" border="0" align=center>
    <tr>
      <td align=center><BR>
<?	  
		$sql = "SELECT a.*,b.subject as pname FROM `tb_prod_ask` a left join `tb_prod` b on a.pid=b.pid order by a.write_time DESC";
//echo $sql;
//exit;
		$rs=mysql_query($sql);
        $totnum= mysql_num_rows($rs);
		
if ($totnum<=0) {
?>
   <center>無商品諮詢資料!
<?   
}else{
$page=$_GET["page"];
				$page2=$_GET["page2"];
				
				if ($page=="") $page=$_POST["page"];
				if ($page2=="") $page2=$_POST["page2"];
$pagenum= 10;                                   //每頁顯示筆數
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
<form name="form1">		
<center><font color=black>商品諮詢</font>　<BR><BR>
<table border="1" cellpadding="0" cellspacing="0" align=center style="color:black;border-collapse: collapse" bordercolor="black" width="1200">
<tr bgcolor="#C9C9C9">
<td align=center><font color=black>刪除</font></td>
<td align=center style="width:100px;"><font color=black>商品名稱</font></td>
<td align=center style="width:150px;"><font color=black>標題</font></td>
<td align=center style="width:100px;"><font color=black>姓名</font></td>
<td align=center><font color=black>手機</font></td>
<td align=center><font color=black>填寫時間</font></td>
<td align=center><font color=black>是否回覆?</font></td>
<td align=center><font color=black>回覆時間</font></td>
<td align=center><font color=black>回覆</font></td>
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
           $cid=$row["cid"];
		   $s="<font color=red>否</font>";
		   $ss="　";
		   $memo_reply=$row["memo_reply"];
		   if ($memo_reply<>"") 
		   {
		      $s="<font color=green>是</font>";
			  $ss=$row["reply_time"];
		   }
?>
	    <tr height=25 onMouseOver="gbg(this)" onMouseOut="gbn(this)">
             <td align=center><input type=checkbox name="delme" value="<?=$cid;?>"></td>
			 <td align=left><?=$row["pname"];?></td>	
			 <td align=left><?=$row["subject"];?></td>	
			 <td align=left><?=$row["cname"];?></td>	
			 <td align=left><?=$row["mobile"];?> 　</td>	
			 <td align=left><?=$row["write_time"];?></td>
			 <td align=center><?=$s;?></td>
			 <td align=left><?=$ss;?></td>
			 <td align=center><a href="prod_ask_reply.php?cid=<?=$cid;?>&page=<?=$page;?>&page2=<?=$page2;?>">回覆</a></td>
			 
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
            location.href="prod_ask_del.php?pid=<?=$pid;?>&srhcid=<?=$srhcid;?>&srhkind=<?=$srhkind;?>&page=<?=$page;?>&page2=<?=$page2;?>&cidstr="+cidstr;
         }
}
</script>
<?		


   if ($page2<>1){
       echo "<a href='?page=".($page2-1)*$pagenum2."&page2=".($page2-1)."'>上".$pagenum2."頁</a>　";    	
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
	    echo "[<a href='?page=".$i."&page2=".$page2."'>".$i."</a>]　";    
	}    
   }
   
   if ($page2<$grouppage){
       echo "<a href='?page=".($pagenum2*$page2+1)."&page2=".($page2+1)."'>下".$pagenum2."頁</a>　";    	
   }	
   
   echo "總筆數:".$totnum."筆</font>";	
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