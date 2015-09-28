<? include ("session.php"); 
   include ("title.php");
   $cid=$_POST["cid"];
   if ($cid=="") $cid=$_GET["cid"];
?>
<div  class="right">
  <div class="right01"> 產品-第2層分類管理</div>
  
<ul>
      
      <li>

<?	  
$sql="select * from tb_item_kind order by standing";
$rs2=mysql_query($sql);
$totnum= mysql_num_rows($rs2);  

if ($totnum<=0) {
   echo "<center>沒有任何產品-第1層分類,<BR>無法新增產品-第2層分類!</center>";
   exit;
}

$say="";	
?>
<form name="form2" method="post" action="item_kind2.php">
<table border='0' width=750 style="color:black;" cellspacing='0' cellpadding='1' bordercolorlight='#006699' bordercolordark='#FFFFFF' align='center'>
<tr><td align=center>
選擇產品-第1層分類:
<select name="cid" onChange="javascript:document.form2.submit();">
<option value="">-請選擇-</option>
<?
  while ( $row = mysql_fetch_array($rs2)) 
  {
          $sel="";
          if ($cid==$row["cid"]) {
              $sel=" selected";
              $say=$row["cname"];
          }
?>
         <option value="<?=$row["cid"];?>"<?=$sel;?>><?=$row["cname"];?></option>
<?
  }
?>
</select>
</form>
<HR>
<form name=form1 method=post>
<center><font size=3 color=black><?=$say;?></font>　　
<?
if ($cid!=""){
$sql="select * from tb_item_kind2 where cid=$cid order by standing";
$rs=mysql_query($sql);
$totnum= mysql_num_rows($rs);  

if ($totnum<=0) {
   echo "<BR><BR><center>沒有任何產品-第2層分類資料...<input type=button value=\"新增產品-第2層分類\" onclick=\"location.replace('item_kind2_add.php?cid=$cid')\"></center>";
}else{
?>
<input type=button value="新增第2層分類" onclick="location.replace('item_kind2_add.php?cid=<?=$cid;?>')"><BR><BR>
</td></tr>
</table>

<table border='1' width=750 style="color:black;" cellspacing='0' cellpadding='1' bordercolorlight='#006699' bordercolordark='#FFFFFF' align='center'>
<tr  bgcolor="#6C6C6C">
<td align=center><font color=white>刪除</td>
<td align=center width="40%"><font color=white>第2層分類名稱</td>
<td align=center><font color=white>狀態</td>
<td align=center><font color=white>修改</td>
<td align=center><font color=white>目前順序</td>
<td align=center><font color=white>改變順序</td>
</tr>
<? 
  $iii=0;
  $cidstr="";
  while ( $row = mysql_fetch_array($rs)) 
  {
          $iii=$iii+1;
		  
		  if ($row["isshow"]=="Y") {
		      $isshow="顯示";
		  }else{
		      $isshow="不顯示";
		  }
		  $cidstr.=$row["ccid"].",";
?>
         <tr>
             <td align=center><input type=checkbox name="delme" value="<?=$row["ccid"];?>"></td>
			 <td align=left><?=$row["cname"];?></td>
			 <td align=center><?=$isshow;?></td>
             <td align=center><a href="item_kind2_edit.php?cid=<?=$cid;?>&ccid=<?=$row["ccid"];?>">修改</a></td>
             <td align=center><input type=text name="standing_<?=$iii;?>" value="<?=$row["standing"];?>" style="width:40px;"></td>
<td align=center>
<input type=button value="上移" onclick="location.replace('item_kind2_standing.php?cid=<?=$cid;?>&ccid=<?=$row["ccid"];?>&kind=1')">
<input type=button value="下移" onclick="location.replace('item_kind2_standing.php?cid=<?=$cid;?>&ccid=<?=$row["ccid"];?>&kind=2')">
<input type=button value="置頂" onclick="location.replace('item_kind2_standing.php?cid=<?=$cid;?>&ccid=<?=$row["ccid"];?>&kind=3')">
<input type=button value="最後" onclick="location.replace('item_kind2_standing.php?cid=<?=$cid;?>&ccid=<?=$row["ccid"];?>&kind=4')">
</td>
             </tr>
<?
  }  
?>
<tr><td colspan=6 align=center>
<input type=button value="刪　　除" onclick="javascript:delcid()">　
<input type=button value="更改順序" onclick="javascript:check();"></td></tr>
</table>
<script language=javascript>
function check(){
ss=",";
<? for ($j=1;$j<=$iii;$j++) { ?>
   a=document.form1.standing_<?=$j;?>.value;
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

document.form1.action="item_kind2_standing2.php?cid=<?=$cid;?>&cidstr=<?=$cidstr;?>";
document.form1.submit();
}

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
                if (form1.delme[i].checked){
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
            location.href="item_kind2_del.php?cid=<?=$cid;?>&cidstr="+cidstr;
         }
}
</script>
<? }
}else{
   echo "<center>請選擇第1層分類..</center>";
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