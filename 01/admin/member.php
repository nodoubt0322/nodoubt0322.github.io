<? include ("session.php"); 
   include ("title.php");
   ?>
<div  class="right">
  <div class="right01"> 會員</div>
  
<ul>
      
      <li>
	  <?
   
   $keys=$_POST["keys"];
   if ($keys=="") $keys=$_GET["keys"];
   
   $srhdate1=$_POST["srhdate1"];
   if ($srhdate1=="") $srhdate1=$_GET["srhdate1"];
   
   $srhdate2=$_POST["srhdate2"];
   if ($srhdate2=="") $srhdate2=$_GET["srhdate2"];
   
   $srhlevel=$_POST["srhlevel"];
   if ($srhlevel=="") $srhlevel=$_GET["srhlevel"];
   
   $srhstatus=$_POST["srhstatus"];
   if ($srhstatus=="") $srhstatus=$_GET["srhstatus"];
   
   $srhtime1=$_POST["srhtime1"];
   if ($srhtime1=="") $srhtime1=$_GET["srhtime1"];
   
   $srhtime2=$_POST["srhtime2"];
   if ($srhtime2=="") $srhtime2=$_GET["srhtime2"];
   
   $page=$_GET["page"];
   $page2=$_GET["page2"];
   
   $addsql="";
   
   if ($keys!="") $addsql.=" and ((a.cid like '%$keys%') or (a.cname like '%$keys%') or (a.nickname like '%$keys%') or (b.country like '%$keys%') or (b.town like '%$keys%') or (a.addr like '%$keys%') or (a.email like '%$keys%') or (a.tel like '%$keys%')) ";
    
   if ($srhstatus!="") $addsql.=" and a.status='$srhstatus' ";
   
        $sql = "SELECT a.*,b.country,b.town FROM `tb_member` a 
		        left join `tb_zipcode` b on a.zip=b.zip where a.cid<>'' $addsql 
		        order by a.reg_time desc,a.id DESC";
   	    //echo $sql."<BR>";
		$rs=mysql_query($sql);
        $totnum= mysql_num_rows($rs);
		

		
		echo "<BR><center>
		     <form name=\"srhform\" action=\"member.php\" method=\"post\">
            <table border=0 align=center width='1200' style=\"color:black;\">
			<tr><td align=center bgcolor=#FFFFCC>";　
?>			
			關鍵字查詢(姓名/地址/電話/EMAIL):
			<input type=text size=25 name="keys" value="<?=$keys;?>">
			
			<BR>
				 　
			<? 
			$sel1="";
			$sel2="";
			if ($srhstatus=="Y") $sel1=" selected"; 
			if ($srhstatus=="N") $sel2=" selected"; 
			?>
			狀態:
			   <select name="srhstatus" id="srhstatus" onchange="javascript:document.srhform.submit();">
				<option value="">-全部-</option>
				<option value="Y"<?=$sel1;?>>己確認</option>
				<option  value="N"<?=$sel2;?>>未確認</option>
				</select>　
				
			
			<BR>
			<input type=submit value="查詢" style="cursor:hand;">　
			<input type=button value="所有會員" style="cursor:hand;" onclick="location.replace('member.php')">　
			<input type=button value="新增會員" style="cursor:hand;" onclick="location.replace('member_add.php')">　
			
			</td></tr>
			
			</table>
			</form>
<?			

if ($totnum<=0) {
   echo "<BR><BR><center>無會員資料!";  
}else{
		
			
$pagenum= 15;                                  //每頁顯示筆數
$pagenum2= 10;                                  //群組分頁每頁顯示頁數

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
			echo "<table border='1' width='1200' style=\"color:black;\" align=center cellspacing='0' cellpadding='1' bordercolorlight='#006699' bordercolordark='#FFFFFF' align='center'>
				<tr bgcolor=#6C6C6C>					
					<th><font color=white>帳號</th>
					<th><font color=white>姓名</th>
					<th><font color=white>暱稱</th>
					<th><font color=white>電話/手機</th>
					<th><font color=white>地址</th>
					<th><font color=white>狀態</th>
					<th><font color=white>註冊時間</th>
					<th><font color=white>修改</th>
					<th><font color=white>刪除</th>
				</tr>
		 ";
		
						
   if(mysql_data_seek($rs,($page-1)*$pagenum) ){ 
       $i=0;
	   $iii=0;
       //循環顯示目前紀錄集
       for($i;$i<$pagenum;$i++){
           $row= mysql_fetch_array($rs);
           if($row){
		      $iii++;
			$id = $row["id"];
			$cid = $row["cid"];
			$cname = $row["cname"];
			$sex = $row["sex"];
			
			$addr = $row["country"].$row["town"].$row["addr"];
			$tel = $row["tel"];
			$mobile = $row["mobile"];
			
			
			$status = $row["status"];
			if ($status=="Y") $say="<font color=blue>正常</font>";
			if ($status=="N") $say="<font color=red>未認證</font>";
			?>
			
			<tr onMouseOver="gbg(this)" onMouseOut="gbn(this)">
                <td align=left><?=$row["cid"];?></td>				
				<td align=left><?=$cname;?></td>
                <td align=left><?=$row["nickname"];?></td>
				<td align=left><?=$tel;?><BR><?=$mobile;?></td>				
				<td align=left><?=str_replace("　","",$addr);?></td>
				
				<td align=left><?=$say;?></td>
				<td align=left><?=$row["reg_time"];?></td>
			<?	
			
			echo "<td align=\"center\">
						<input type=\"button\" value=\"修改\" style=\"cursor:hand;\" onClick=\"javascript:location='member_edit.php?keys=$keys&srhdate1=$srhdate1&srhdate2=$srhdate2&srhlevel=$srhlevel&srhstatus=$srhstatus&srhtime1=$srhtime1&srhtime2=$srhtime2&page=$page&page2=$page2&id=$id'\">					
				</td>
                <td align=\"center\">
						<input type=\"button\" value=\"刪除\" style=\"cursor:hand;\" onClick='javascript:delcid(\"$id\");'>
				</td>				
			</tr>";
		}	
		}
		}
		
		
		echo "</table>";
		
?>
<script language=javascript>
function delcid(aaa){
         if (confirm("是否確定刪除?")) {
		    location.href="member_del.php?keys=<?=$keys;?>&srhdate1=<?=$srhdate1;?>&srhdate2=<?=$srhdate2;?>&srhlevel=<?=$srhlevel;?>&srhstatus=<?=$srhstatus;?>&srhtime1=<?=$srhtime1;?>&srhtime2=<?=$srhtime2;?>&id="+aaa;
		 }
}
</script>

<table border=0 align=center width='900' style="color:black;">
<tr><td align=center  height=20>
<? 
   if ($page2<>1){
       echo "<a href='member.php?keys=".$keys."&srhdate1=".$srhdate1."&srhdate2=".$srhdate2."&srhlevel=".$srhlevel."&srhstatus=".$srhstatus."&srhtime1=".$srhtime1."&srhtime2=".$srhtime2."&page=".($page2-1)*$pagenum2."&page2=".($page2-1)."'>上".$pagenum2."頁</a>　";    	
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
	    echo "[<a href='member.php?keys=".$keys."&srhdate1=".$srhdate1."&srhdate2=".$srhdate2."&srhlevel=".$srhlevel."&srhstatus=".$srhstatus."&srhtime1=".$srhtime1."&srhtime2=".$srhtime2."&page=".$i."&page2=".$page2."'>".$i."</a>]　";    
	}    
   }
   
   if ($page2<$grouppage){
       echo "<a href='member.php?keys=".$keys."&srhdate1=".$srhdate1."&srhdate2=".$srhdate2."&srhlevel=".$srhlevel."&srhstatus=".$srhstatus."&srhtime1=".$srhtime1."&srhtime2=".$srhtime2."&page=".($pagenum2*$page2+1)."&page2=".($page2+1)."'>下".$pagenum2."頁</a>　";    	
   }	
   
   echo "總筆數:".$totnum."筆";
} 
 ?>
</td>
</tr>
</table>
 </li> 
      
    </ul>
  </div>
  <?include ("bottom.php"); ?>