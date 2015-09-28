<?
$fid="13";
include ("title.php"); ?>

<div  class="right">
  <div class="right01"> 分析數據-每天不重複IP瀏覽統計（月曆式）</div>

  <ul>
      <li>
	  <?
	    $today=date("Ymd");
		
      ?>

<center>	  
<a href="view.php">今日不重複IP瀏覽明細</a>　
<a href="view2.php">今日每小時不重複IP瀏覽統計（長條圖）</a>　
<B>每天不重複IP瀏覽統計（月曆式）</B><BR>

<a href="view4.php">每月不重複IP瀏覽統計</a>　
<a href="view5.php">每年不重複IP瀏覽統計</a>
<HR>
<?
$year=$_GET["year"];
if ($year=="") $year=$_POST["year"];

$month=$_GET["month"];
if ($month=="") $month=$_POST["month"];

if ($year=="" && $month=="")
{
	$date =time ();
	$day = date('d', $date);
	$month = date('m', $date);
	$year = date('Y', $date);
}
?>
<input type=button value="重新整理" onclick="location.replace('view3.php?year=<?=$year;?>&month=<?=$month;?>')"><BR><BR>
</center>

<?
$p=date('D',time());

switch($p){
		case "Mon": $pp = 1; break;
		case "Tue": $pp = 2; break;
		case "Wed": $pp = 3; break;
		case "Thu": $pp = 4; break;
		case "Fri": $pp = 5; break;
		case "Sat": $pp = 6; break;
		case "Sun": $pp = 7; break;
}

if ($pp!=1){
    $date = date("Y")."/".date("m")."/".date("d");
    $tmp = explode("/", $date); 
    $inputdate = mktime(0, 0, 0, $tmp[1], $tmp[2], $tmp[0]);
    $mondaydate = date("Y/m/d", ($inputdate - (($pp-1) * 24 * 60 * 60)));
}else{
    $mondaydate = date("Y/m/d");
}	

$tmp2 = explode("/", $mondaydate); 
$inputdate2 = mktime(0, 0, 0, $tmp2[1], $tmp2[2], $tmp2[0]);

  
if ((int)$month==1){
    $preyear=$year-1;
	$premonth=12;
}else{	
    $preyear=$year;
	$premonth=(int)$month-1;
}	

if ((int)$month==12){
    $nxtyear=$year+1;
	$nxtmonth=1;
}else{	
    $nxtyear=$year;
	$nxtmonth=(int)$month+1;
}	

$first_day = mktime(0,0,0,$month, 1, $year);
$title = date('F', $first_day);
$day_of_week = date('D',$first_day);

switch($day_of_week){
		case "Sun": $blank = 6; break;
		case "Mon": $blank = 0; break;
		case "Tue": $blank = 1; break;
		case "Wed": $blank = 2; break;
		case "Thu": $blank = 3; break;
		case "Fri": $blank = 4; break;
		case "Sat": $blank = 5; break;
}

$days_in_month = cal_days_in_month(0, $month, $year);

$aa = date("Y"); //用date()函式取得目前年份格式0000
$bb = date("m"); //用date()函式取得目前月份格式00
$cc = date("d"); //用date()函式取得目前日期格式00
$ddate = date("Y-m-d",mktime(0,0,0,$bb,$cc+60,$aa)); //可預約的最後一天（２個月）
//echo $day;
//echo   "2011-08-30和2011-10-29相差 ".((strtotime( "2011-10-29")-strtotime("2011-10-29"))/86400). "天 "; 

echo "<form name=\"yymmform\" action=\"view3.php\" method=post><table width='98%' border='0' align=center cellspacing='0' cellpadding='0' style='border-collapse:collapse;margin:0px;'>";
echo "<tr><td style=\"text-align:center;\"><span style=\"font-size:13px;\"><a href=\"?year=".($year-1)."&month=".(int)$month."\">前一年</a>　
<a href=\"?year=".$preyear."&month=".$premonth."\">上個月</a>　　<font size=4><B>".$year." 年 ".(int)$month." 月</B></font>　　
<a href=\"?year=".$nxtyear."&month=".$nxtmonth."\">下個月</a>　<a href=\"?year=".($year+1)."&month=".(int)$month."\">次一年</a></span>　";    
?>
<select name="year" id="year" style="font-size:13px;" onchange="javascript:document.yymmform.submit();">
			  
			  <?
			  $i=date("Y");
			   for ($yy=$i-5;$yy<=$i+5;$yy++){ 
			         $sel="";
					 if ($year!="") {
					    if ((int)$yy===(int)$year) $sel=" selected";
					 }	
			  ?>
                     <option value="<?=$yy;?>"<?=$sel;?>><?=$yy;?></option>
			  <?
			  } ?>	
              </select><span style="font-size:13px;">年</span>
              <select name="month" id="month" style="font-size:13px;" onchange="javascript:document.yymmform.submit();">
			  
			  <? for ($i=1;$i<=12;$i++){ 
			          if ($i<10) {
					      $ii="0".$i;
					  }else{
                          $ii=$i;
                      } 						  
			         $sel="";
					 if ($month!="") {
					    if ((int)$month===(int)$i) $sel=" selected";
					 }	
			  ?>
                     <option value="<?=$ii;?>"<?=$sel;?>><?=$i;?></option>
			  <? } ?>	
              </select><span style="font-size:13px;">月</span>　
			  <a href="?year=<?=date("Y");?>&month=<?=date("m");?>"><font size=2>本月</font></a>　
			  
			  </form>
<?
echo "</td></tr></table>";
echo "<table width=98% align=center border=1 align=center style=\"font-size:13px;\">";
echo "<tr bgcolor=E8E8E8>
<td align=center width=14% title=星期一>一</td>
<td align=center width=14% title=星期二>二</td>
<td align=center width=14% title=星期三>三</td>
<td align=center width=14% title=星期四>四</td>
<td align=center width=14% title=星期五>五</td>
<td align=center width=14% title=星期六><font color=green>六</font></td>
<td align=center width=14% title=星期日><font color=red>日</font></td></tr>";

$day_count = 1;
echo "<tr>";

while ( $blank > 0 )
{
       echo "<td>　</td>";
       $blank = $blank-1;
       $day_count++;
}

$day_num = 1;
$today=date("Ymd");
$tot=0;
while ( $day_num <= $days_in_month )
{
        $fcolor="black";
		if ($day_count==6) $fcolor="green";
		if ($day_count==7) $fcolor="red";
		
		$m=(int)$month;
		$d=(int)$day_num;
		
		if ((int)$m<10) $m="0".$m;
		if ((int)$d<10) $d="0".$d;
		
		$tt=$year.$m.$d;
		
		$sql="select count(*) as bb from tb_view where vdate='$tt'";
		$rs=mysql_query($sql);
		$row = mysql_fetch_array($rs);
		
		
		
		$bb=$row["bb"];
		$tot=$tot+(int)$bb;
		if ($bb=="0") $bb="　";
		//$bb=$tt;
					
        if($day_num == date("d") && $year==date("Y") && (int)$month==(int)date("m")) 
		{
           echo "<td bgcolor=#cccccc align=center height=25><font color=$fcolor>$day_num</font><br>"; //今天日期
        } else {
           echo "<td align=center height=25><font color=$fcolor>$day_num</font><br>";
        }
        
		echo "<font color=blue face=arial><B>".$bb."</B></font></td>";		
		
	    $day_num++;
        $day_count++;

        if ($day_count > 7)
        {
            echo "</tr><tr>";
            $day_count = 1;
        }
}

while ( $day_count >1 && $day_count <=7 )
{
        echo "<td></td>";
        $day_count++;
}
?>
</tr>
<tr><td colspan=7 align=right>本月合計:<?=$tot;?>人</td></tr>

</table>

			  
			

      </li> 
    </ul>
 </body>
</html>
