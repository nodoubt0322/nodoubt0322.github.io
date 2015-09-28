<? include ("session.php"); 
   include ("../connect.php");

   $keys=$_GET["keys"];
   
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
   
   $addsql="";
   
   if ($keys!="") $addsql.=" and ((cid like '%$keys%') or (cname like '%$keys%') or (city like '%$keys%') or (town like '%$keys%') or (addr like '%$keys%') or (email like '%$keys%') or (tel like '%$keys%') or (mobile like '%$keys%')) ";
   if ($srhdate1!="") {
       $kkk=explode("/",$srhdate1);
	   $a=$kkk[0];
	   $b=$kkk[1];
	   $c=$kkk[2];
	   $sd1=$a.substr("0".$b,-2).substr("0".$c,-2);
	   $addsql.=" and (reg_date>='$sd1') ";
   }
   if ($srhdate2!="") {
       $kkk=explode("/",$srhdate2);
	   $a=$kkk[0];
	   $b=$kkk[1];
	   $c=$kkk[2];
	   $sd2=$a.substr("0".$b,-2).substr("0".$c,-2);
	   $addsql.=" and (reg_date<='$sd2') ";
   }   
   if ($srhlevel!="") $addsql.=" and level='$srhlevel' ";
   if ($srhstatus!="") $addsql.=" and status='$srhstatus' ";
   if ($srhtime1!="") $addsql.=" and logintimes>=$srhtime1 ";
   if ($srhtime2!="") $addsql.=" and logintimes<=$srhtime2 ";
   
        $sql = "SELECT * FROM `tb_member` where cid<>'' $addsql order by reg_time DESC";
		
$rs=mysql_query($sql);
$totnum3= mysql_num_rows($rs);
$data="";
if ($totnum3>0){
   $data="<table border=\"1\" align=\"center\">".
		 "<tr bgcolor=\"#DDDDDD\">".
		 "<td nowrap><div align=\"center\">會員等級</div></td>".
		 "<td nowrap><div align=\"center\">帳號</div></td>".
		 "<td nowrap><div align=\"center\">密碼</div></td>".
		 "<td nowrap><div align=\"center\">姓名</div></td>".
		 "<td nowrap><div align=\"center\">性別</div></td>".
		 "<td nowrap><div align=\"center\">電話</div></td>".		 
		 "<td nowrap><div align=\"center\">手機</div></td>".		 
		 "<td nowrap><div align=\"center\">E-mail</div></td>".
		 "<td nowrap><div align=\"center\">地址</div></td>".
		 "</tr>";
     while ($row= mysql_fetch_array($rs))
     {
	         
		  $sex = $row["sex"];
		  $level = $row["level"];
			if ($level=="0") $say2="一般會員";
			if ($level=="1") $say2="<font color=blue>VIP會員</font>";
			
		  $data.="<tr>".
		    "<td><div align=\"left\">".$say2."</div></td>".
		    "<td><div align=\"left\">".$row["cid"]."</div></td>".
			"<td><div align=\"left\">".$row["pass"]."</div></td>".
			"<td><div align=\"left\">".$row["cname"]."</div></td>".
			"<td><div align=\"left\">".str_replace("1","男",str_replace("0","女",$sex))."</div></td>".
			"<td><div align=\"left\">".$row["tel"]."</div></td>".			
			"<td><div align=\"left\">".$row["mobile"]."</div></td>".						
			"<td><div align=\"left\">".$row["email"]."</div></td>".
			"<td><div align=\"left\">".$row["city"].$row["town"].$row["addr"]."</div></td>".			
		  "</tr>";
     } 
$data.="</table>";
//echo $data;
//exit;
	   $fn2="Member.xls";
	   $fn=iconv("UTF-8","big5//IGNORE",$fn2); //解決中文檔名亂碼問題
	   $fp = fopen("12sdf45sdf4s5dfwerw252432342/".$fn, "w+");
       fputs($fp, "\xEF\xBB\xBF".$data);
       fclose($fp);
?>
下載視窗15秒後會自動關閉...
       <script language=javascript>
             location.href="12sdf45sdf4s5dfwerw252432342/<?=$fn2;?>";
			  setTimeout("self.close();",15000);
       </script>	
<?	   
}
?>

