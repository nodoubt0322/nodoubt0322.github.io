<? include ("session.php"); 
   include ("title.php");

$sql="select * from tb_item_kind4 order by standing";
$rs=mysql_query($sql);
$totnum= mysql_num_rows($rs);  
?>
<div  class="right">
  <div class="right01"> 最新消息-分類管理</div>
  
<ul>
      
      <li>
<table width="100%" border="0" style="color:black;">
    <tr>
      <td align=center><BR>
<?	  
if ($totnum<=0) {
   echo "<center>沒有任何最新消息-分類資料...<input type=button value=\"新增分類\" onclick=\"location.replace('item_kind4_add.php')\"></center>";
}else{
?>


<input type=button value="新增分類" onclick="location.replace('item_kind4_add.php')">
<BR><BR>
<form name=form1 method=post>
<table border='1' width=650 style="color:black;" cellspacing='0' cellpadding='1' bordercolorlight='#006699' bordercolordark='#FFFFFF' align='center'>
<tr height=30 bgcolor="#cccccc">
<td align=center>刪除</td>
<td align=center width="40%">分類名稱</td>
<td align=center>狀態</td>
<td align=center>修改</td>
<td align=center>目前順序</td>
<td align=center>改變順序</td>
</tr>
<? 
  $iii=0;
  $cidstr="";
  while ( $row = mysql_fetch_array($rs)) 
  {
          $iii++;
 
		  if ($row["isshow"]=="Y") {
		      $isshow="顯示";
		  }else{
		      $isshow="不顯示";
		  }
		  $cidstr.=$row["cid"].",";
?>
         <tr height=30 onMouseOver="gbg(this)" onMouseOut="gbn(this)">
             <td align=center><input type=checkbox name="delme" id="delme" value="<?=$row["cid"];?>"></td>
             <td align=left>
			 <?=$row["cname"];?>
			 </td>
			 <td align=center><?=$isshow;?></td>
			 <td align=center><a href="item_kind4_edit.php?cid=<?=$row["cid"];?>">修改</a></td>
             <td align=center><input type=text name="standing_<?=$iii;?>" id="standing_<?=$iii;?>" value="<?=$row["standing"];?>" style="width:40px;"></td>
<td align=center>
<input type=button value="上移" onclick="location.replace('item_kind4_standing.php?cid=<?=$row["cid"];?>&kind=1')">
<input type=button value="下移" onclick="location.replace('item_kind4_standing.php?cid=<?=$row["cid"];?>&kind=2')">
<input type=button value="置頂" onclick="location.replace('item_kind4_standing.php?cid=<?=$row["cid"];?>&kind=3')">
<input type=button value="最後" onclick="location.replace('item_kind4_standing.php?cid=<?=$row["cid"];?>&kind=4')">
</td>
             </tr>
<?
  }  
?>
<input type=hidden name="num" value="<?=$iii;?>">
<input type=hidden name="cidstr" value="<?=$cidstr;?>">

<tr><td height=30 colspan=7 align=center>
<input type=button value="刪　　除" onclick="javascript:delcid();">　
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

document.forms['form1'].action="item_kind4_standing2.php";
document.forms['form1'].submit();
}

function delcid(){		 
         cidstr="";
         if ("<?=$iii;?>"=="1"){
            if (! document.getElementById("delme").checked){
               alert ("你沒有選擇任何東西哦..");
               return;
            }else{
               cidstr+=document.getElementById("delme").value+",";
            }               
         }else{
	  	    counter=0;

            for (i=0;i<=<?=$iii-1;?>;i++){			
				if (document.getElementsByName("delme").item(i).checked){
                   counter++;					   
                   cidstr+=document.getElementsByName("delme").item(i).value+",";
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
            location.href="item_kind4_del.php?cidstr="+cidstr;
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