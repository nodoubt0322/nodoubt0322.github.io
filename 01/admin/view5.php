<?
$fid="13";
include ("title.php"); ?>

<div  class="right">
  <div class="right01"> 分析數據-每年不重複IP瀏覽統計</div>

  <ul>
      <li>
	  <?
	    
		$sql="select YEAR(vtime) as aa,count(*) as cc from tb_view group by YEAR(vtime) order by YEAR(vtime) desc";
		$rs=mysql_query($sql);
		$totnum= mysql_num_rows($rs);
      ?>

<center>	  
<a href="view.php">今日不重複IP瀏覽明細</a>　
<a href="view2.php">今日每小時不重複IP瀏覽統計（長條圖）</a>　
<a href="view3.php">每天不重複IP瀏覽統計（月曆式）</a><BR>

<a href="view4.php"><B>每月不重複IP瀏覽統計</a></B>　
<B>每年不重複IP瀏覽統計</B>
<HR>
<input type=button value="重新整理" onclick="location.replace('view5.php')"><BR><BR>
</center>

<?
if ($totnum<=0) {
   echo "<center>無瀏覽資料!";
}else{ ?>
    <table width=500 border='1' cellspacing='0' cellpadding='1' bordercolorlight='#006699' bordercolordark='#FFFFFF' align='center'>
	<tr>
	<td align=center bgcolor="#C9C9C9"><div align="center"><font color=black>年份</font></div></td>
	<td align=center bgcolor="#C9C9C9"><div align="center"><font color=black>瀏覽人數</font></div></td>
	</tr>
<?  while ($row= mysql_fetch_array($rs)) { ?>
            <tr>
				<td align=center><div align="center"><font color=black><?=$row["aa"];?>年</font></div></td>
				<td align=left><div align="center"><font color=black><?=$row["cc"];?></font></div></td>
			  </tr>
<?  } ?>
   
	</table>
<? } ?>   
      </li> 
    </ul>
 </body>
</html>
