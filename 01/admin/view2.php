<?
$fid="13";
include ("title.php"); ?>

<div  class="right">
  <div class="right01"> 分析數據-今日每小時不重複IP瀏覽統計（長條圖）</div>

  <ul>
      <li>
	  <?
	    $today=date("Ymd");
		
      ?>

<center>	  
<a href="view.php">今日不重複IP瀏覽明細</a>　
<B>今日每小時不重複IP瀏覽統計（長條圖）</B>　
<a href="view3.php">每天不重複IP瀏覽統計（月曆式）</a><BR>

<a href="view4.php">每月不重複IP瀏覽統計</a>　
<a href="view5.php">每年不重複IP瀏覽統計</a>
<HR>
<input type=button value="重新整理" onclick="location.replace('view2.php')"><BR><BR>
</center>


    <table align=center>
            <tr>                
                <td>
                <table height=290 align=center border=1>
                <tr>
        
            <?  $tot=0;			
			    $j=0;
				//echo "H=".date("h")."<BR>";
				
			    for ($i=0;$i<=date("H")+8;$i++){ 
					$sql="select count(*) as bb from tb_view where vdate='$today' and HOUR(vtime)=$i";
					$rs=mysql_query($sql);
					$row = mysql_fetch_array($rs);
					$tot=$tot+(int)$row["bb"];
					$j++;
			?>
						<td align=center valign=bottom width=15 style="font-size:10px;">
							 <?=$row["bb"];?><br />
							 
							 <? if ((int)$row["bb"]>0) { 
							        
							 ?>
									 <table width=15 height="<?=(int)$row["bb"]*5;?>" bgcolor=blue>
									 <tr><td>&nbsp;</td></tr></table><br />
							 <? } ?>
							 
							 <font color=green><?=$i;?>~<?=$i+1;?></font>
						</td>
			<? 
			    } ?>
        
               </tr>
			   
			   
               </table>
               </td>
             </tr> 

        <tr>                
                <td align=right colspan="<?=$j;?>">
					 合計:<?=$tot;?>人
                </td>				
             </tr>	
        </table>


      </li> 
    </ul>
 </body>
</html>
