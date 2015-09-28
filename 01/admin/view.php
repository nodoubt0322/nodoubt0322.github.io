<?
$fid="13";
include ("title.php"); ?>

<div  class="right">
  <div class="right01"> 分析數據-今日不重複IP瀏覽明細</div>

  <ul>
      <li>
	  <?
	    $today=date("Ymd");
		$sql="select * from tb_view where vdate='$today' order by vtime desc";
		$rs=mysql_query($sql);
		$totnum= mysql_num_rows($rs);
      ?>

<center>	  
<B>今日不重複IP瀏覽明細</B>　
<a href="view2.php">今日每小時不重複IP瀏覽統計（長條圖）</a>　
<a href="view3.php">每天不重複IP瀏覽統計（月曆式）</a><BR>

<a href="view4.php">每月不重複IP瀏覽統計</a>　
<a href="view5.php">每年不重複IP瀏覽統計</a>
<HR>
<input type=button value="重新整理" onclick="location.replace('view.php')"><BR><BR>
</center>

<?
if ($totnum<=0) {
   echo "<center>今日無瀏覽資料!";
}else{ ?>
    <table width=500 border='1' cellspacing='0' cellpadding='1' bordercolorlight='#006699' bordercolordark='#FFFFFF' align='center'>
<?
    $page=$_GET["page"];
	$page2=$_GET["page2"];
	
	if ($page=="") $page=$_POST["page"];
	if ($page2=="") $page2=$_POST["page2"];
	
	$pagenum= 10;                                  //每頁顯示筆數
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
	<tr>
	<td align=center bgcolor="#C9C9C9"><div align="center"><font color=black>IP</font></div></td>
	<td align=center bgcolor="#C9C9C9"><div align="center"><font color=black>瀏覽時間</font></div></td>
	</tr>	
<?	
       if(mysql_data_seek($rs,($page-1)*$pagenum) )
	   { 
		   $i=0;
		   $iii=0;
		   //循環顯示目前紀錄集
		   for($i;$i<$pagenum;$i++)
		   {
			   $row= mysql_fetch_array($rs);
			   if($row)
			   {
				  $iii++;
?>
                  <tr>
					<td align=center><div align="center"><font color=black><?=$row["ip"];?></font></div></td>
					<td align=left><div align="center"><font color=black><?=$row["vtime"];?></font></div></td>
				  </tr>
<?				  
			   }
		   }	   
		}
?>		
	</table>
	<center>
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
   } ?>
   </center>
      </li> 
    </ul>
 </body>
</html>
