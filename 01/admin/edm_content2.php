<? include ("session.php");
    include ("title.php");

	$eid=$_GET["eid"];
?>
<div  class="right">
  <div class="right01"> 寄信-名單資料</div>
<ul>
<li>


<table border="0" width="910" id="table10" align=center>
<tr>
	<td width="99%" colspan="2" align=center>名單資料　<input type=button value="返回.." onclick="location.replace('edm_list.php')">
	<table border="0" width="900" height="300">
		<tr>
			<td valign=top>
<table width="100%" border="0">
    <tr>
      <td align=center valign=top><BR>
<?	  
		$sql="select * from tb_edm2 where eid=$eid order by read_time desc,cid";
		$rs=mysql_query($sql);
        $totnum= mysql_num_rows($rs);
		
if ($totnum<=0) {
   echo "<center>無資料!";
}else{
$pagenum= 10;                                  //每頁顯示筆數
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

<td align=center><font color=white>會員EMAIL</td>
<td align=center><font color=white>是否已閱讀?</td>
<td align=center><font color=white>閱讀時間</td>
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
			  
			  $sql3="select * from tb_member where cid='$cid'";
			  $rs3=mysql_query($sql3);
			  $totnum3= mysql_num_rows($rs3);
			  $nn="";
			  if ($totnum3>0){
			      $row3= mysql_fetch_array($rs3);
				  $nn="(".$row3["nickname"].")";
			  }
			  		  
?>
	         <tr height=35>
           
			  <td align=left><?=$row["email"];?></td>
			   <td align=left><?=str_replace("N","<font color=red>否</font>",str_replace("Y","是",$row["isread"]));?></td>
			   <td align=left><?=str_replace("0000-00-00 00:00:00","",$row["read_time"]);?>　</td>
			 </tr>
	<?    }	
		}
	}
?>		
	</table>
	<center>


<?		
   if ($page2<>1){
       echo "<a href='?eid=".$eid."&kind2=".$kind2."&kind=".$kind."&page=".($page2-1)*$pagenum2."&page2=".($page2-1)."'>上".$pagenum2."頁</a>　";    	
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
	    echo "[<a href='?eid=".$eid."&kind2=".$kind2."&kind=".$kind."&page=".$i."&page2=".$page2."'>".$i."</a>]　";    
	}    
   }
   
   if ($page2<$grouppage){
       echo "<a href='?eid=".$eid."&kind2=".$kind2."&kind=".$kind."&page=".($pagenum2*$page2+1)."&page2=".($page2+1)."'>下".$pagenum2."頁</a>　";    	
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