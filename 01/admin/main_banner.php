<? include ("session.php"); 
   include ("title.php");

$sql="select * from tb_main_banner order by standing";
$rs=mysql_query($sql);
$totnum= mysql_num_rows($rs);  
?>
<div  class="right">
  <div class="right01"> BANNER 輪撥(980x400)</div>
  
<ul>
      
      <li>
<table width=950 border="0" style="color:black;">
    <tr>
      <td align=center><BR>
<?	  
if ($totnum<=0) {
   echo "<center>沒有任何 BANNER 輪撥(980x400)資料...<input type=button value=\"新增 BANNER 輪撥(980x400)\" onclick=\"location.replace('main_banner_add.php')\"></center>";
}else{
?>


<input type=button value="新增 BANNER 輪撥(980x400)" onclick="location.replace('main_banner_add.php')">
<BR><BR>

<form name=form1 method=post>
<table width=950 border='1'  style="color:black;" cellspacing='0' cellpadding='1' bordercolorlight='#006699' bordercolordark='#FFFFFF' align='center'>
<tr height=30 bgcolor="#DAF5F8">
<td align=center>刪除</td>
<td align=center width="20%">標題</td>
<td align=center>圖片</td>
<td align=center>修改</td>
<td align=center>目前順序</td>
<td align=center>改變順序</td>
</tr>
<? 
  $iii=0;
  $aidstr="";
  while ( $row = mysql_fetch_array($rs)) 
  {
          $iii++;
 
		  
		  $aidstr.=$row["aid"].",";
?>
         <tr height=30 onMouseOver="gbg(this)" onMouseOut="gbn(this)">
             <td align=center><input type=checkbox name="delme" id="delme" value="<?=$row["aid"];?>"></td>
             <td align=left>
			 <?=$row["subject"];?>
			 </td>
			 <td align="center">
			  <? if ($row["url"]!=""){?>
		            <a href="<?=$row["url"];?>" target="_blank">
			  <? } ?>
			  
			  <img src="../pic/main_banner/<?=$row["pic"];?>" width=300 border=0></img>
			  
			  <? if ($row["url"]!=""){?>
			         </a>
			  <? } ?>
			  <BR>
			  
		</td>
			 <td align=center><a href="main_banner_edit.php?aid=<?=$row["aid"];?>">修改</a></td>
             <td align=center><input type=text name="standing_<?=$iii;?>" id="standing_<?=$iii;?>" value="<?=$row["standing"];?>" style="width:40px;"></td>
<td align=center>
<input type=button value="上移" onclick="location.replace('main_banner_standing.php?aid=<?=$row["aid"];?>&kind=1')">
<input type=button value="下移" onclick="location.replace('main_banner_standing.php?aid=<?=$row["aid"];?>&kind=2')">
<input type=button value="置頂" onclick="location.replace('main_banner_standing.php?aid=<?=$row["aid"];?>&kind=3')">
<input type=button value="最後" onclick="location.replace('main_banner_standing.php?aid=<?=$row["aid"];?>&kind=4')">
</td>
             </tr>
<?
  }  
?>
<input type=hidden name="num" value="<?=$iii;?>">
<input type=hidden name="aidstr" value="<?=$aidstr;?>">

<tr><td height=30 colspan=7 align=center>
<input type=button value="刪　　除" onclick="javascript:delaid();">　
<input type=button value="更改順序" onclick="javascript:check();">
</td></tr>
</table>
<script language=javascript>
function check(){
ss=",";
<? for ($j=1;$j<=$iii;$j++) { ?>
   a=document.getElementById("standing_<?=$j;?>").value;
   if (a==""){
      alert ("請輸入順序.");
      document.form1.standing_<?=$j;?>.focus();      
      return;
   }
   
   if (isNaN(a)){
      alert ("順序必須為數字.");
      document.form1.standing_<?=$j;?>.focus();
      return;
   }
   
   if (parseInt(a)<=0) {
      alert ("順序必須大於0.");
      document.form1.standing_<?=$j;?>.focus();
      return;
   }
   
   if (ss.indexOf(","+a+",")!=-1){
      alert ("順序:"+a+"重複設定.");
      document.form1.standing_<?=$j;?>.focus();
      return;
   }else{
      ss=ss+a+",";
   }      
<? } ?>

document.forms['form1'].action="main_banner_standing2.php";
document.forms['form1'].submit();
}

function delaid(){		 
         aidstr="";
         if ("<?=$iii;?>"=="1"){
            if (! document.getElementById("delme").checked){
               alert ("你沒有選擇任何東西哦..");
               return;
            }else{
               aidstr+=document.getElementById("delme").value+",";
            }               
         }else{
	  	    counter=0;

            for (i=0;i<=<?=$iii-1;?>;i++){			
				if (document.getElementsByName("delme").item(i).checked){
                   counter++;					   
                   aidstr+=document.getElementsByName("delme").item(i).value+",";
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
            location.href="main_banner_del.php?aidstr="+aidstr;
         }
}
</script>
<? } ?>
</td>
</tr>
</table>	
</form>
 </li> 
      
    </ul>
  </div>
  <?include ("bottom.php"); ?>