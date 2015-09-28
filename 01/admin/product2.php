<? include ("session.php"); 
   include ("title.php");
   
   $srhcid=carhow($_GET["srhcid"]);
   if ($srhcid=="") $srhcid=carhow($_POST["srhcid"]);
   
   $srhccid=carhow($_GET["srhccid"]);
   if ($srhccid=="") $srhccid=carhow($_POST["srhccid"]);
   
   $srhcccid=carhow($_GET["srhcccid"]);
   if ($srhcccid=="") $srhcccid=carhow($_POST["srhcccid"]);
   
   $page=carhow($_GET["page"]);
   if ($page=="") $page=carhow($_POST["page"]);
   
   $page2=carhow($_GET["page2"]);
   if ($page2=="") $page2=carhow($_POST["page2"]);
   
   $pid=carhow($_GET["pid"]);
   if ($pid=="") $pid=carhow($_POST["pid"]);
   
   if ($pid=="")
   {
?>
        <script language=javascript>
		document.location.href="prod.php";
		</script>
<?	
       exit;
	}   

	$sql2 = "SELECT a.* FROM `tb_prod` a ".
		    "where a.pid=$pid";
//echo $sql2."<BR>";			   
    $rs2=mysql_query($sql2);
	$totnum2= mysql_num_rows($rs2);
	if ($totnum2==0)
	{
?>
        <script language=javascript>
		document.location.href="prod.php";
		</script>
<?	
       exit;	
	}
	$row2 = mysql_fetch_array($rs2);
	
?>
<div  class="right">
  <div class="right01"> 產品圖片</div>
  
<ul>
      
      <li>
<center>
<table width=900 border='0' align=center style="color:black;">
<tr><td align=center>
產品名稱:<?=$row2["subject"];?>　
<input type="button" value="回產品管理首頁" onclick="location.replace('prod.php?srhcid=<?=$srhcid;?>&srhccid=<?=$srhccid;?>&srhcccid=<?=$srhcccid;?>&page=<?=$page;?>&page2=<?=$page2;?>&pid=<?=$pid;?>')">
</td></tr></table>
</center>

<form name=form1 method=post>
<center>
<input type=button value="新增圖片" onclick="location.replace('product2_add.php?srhcid=<?=$srhcid;?>&srhccid=<?=$srhccid;?>&srhcccid=<?=$srhcccid;?>&page=<?=$page;?>&page2=<?=$page2;?>&pid=<?=$pid;?>')"><BR><BR>
<table width=900 border='1' cellspacing='0' cellpadding='1' bordercolorlight='#006699' bordercolordark='#FFFFFF' align='center' style="color:black;">
<tr  bgcolor="#6C6C6C">
<td align=center><font color=white>刪除</td>
<td align=center><font color=white>圖片</td>
<td align=center><font color=white>狀態</td>
<td align=center><font color=white>修改</td>
<td align=center><font color=white>目前順序</td>
<td align=center><font color=white>改變順序</td>
</tr>
<? 
  $iii=0;
  $cidstr="";
  
  $sql = "SELECT * FROM `tb_product2` ".
		 "where pid=".$pid." order by standing";
			   
  $rs=mysql_query($sql);
  $totnum= mysql_num_rows($rs);
if ($totnum>0)
{ 
  while ( $row = mysql_fetch_array($rs)) 
  {
          $iii=$iii+1;
		  
		  if ($row["isshow"]=="Y") {
		      $isshow="顯示";
		  }else{
		      $isshow="<font color=red>不顯示</font>";
		  }
		  
		  $cidstr.=$row["id"].",";
?>
        <tr>
             <td align=center><input type=checkbox name="delme" value="<?=$row["id"];?>"></td>
			 <td align=center><img src="../pic/prod2/<?=$row["pic"];?>" width=100>
			 </td>
			 <td align=center><?=$isshow;?></td>
             <td align=center><a href="product2_edit.php?srhcid=<?=$srhcid;?>&srhccid=<?=$srhccid;?>&page=<?=$page;?>&page2=<?=$page2;?>&pid=<?=$pid;?>&id=<?=$row["id"];?>">修改</a></td>
             <td align=center><input type=text name="standing_<?=$iii;?>" value="<?=$row["standing"];?>" style="width:40px;"></td>
			 <td align=center>
				 <input type=button value="上移" onclick="location.replace('product2_standing.php?srhcid=<?=$srhcid;?>&srhccid=<?=$srhccid;?>&page=<?=$page;?>&page2=<?=$page2;?>&pid=<?=$pid;?>&id=<?=$row["id"];?>&kind=1')">
				 <input type=button value="下移" onclick="location.replace('product2_standing.php?srhcid=<?=$srhcid;?>&srhccid=<?=$srhccid;?>&page=<?=$page;?>&page2=<?=$page2;?>&pid=<?=$pid;?>&id=<?=$row["id"];?>&kind=2')">
				 <input type=button value="置頂" onclick="location.replace('product2_standing.php?srhcid=<?=$srhcid;?>&srhccid=<?=$srhccid;?>&page=<?=$page;?>&page2=<?=$page2;?>&pid=<?=$pid;?>&id=<?=$row["id"];?>&kind=3')">
				 <input type=button value="最後" onclick="location.replace('product2_standing.php?srhcid=<?=$srhcid;?>&srhccid=<?=$srhccid;?>&page=<?=$page;?>&page2=<?=$page2;?>&pid=<?=$pid;?>&id=<?=$row["id"];?>&kind=4')">
			 </td>
        </tr>
<?
  }  
?>
	<tr><td colspan=8 align=center>
	<input type=button value="刪　　除" onclick="javascript:delcid()">　
	<input type=button value="更改順序" onclick="javascript:check();"></td></tr>


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

	document.form1.action="product2_standing2.php?srhcid=<?=$srhcid;?>&srhccid=<?=$srhccid;?>&page=<?=$page;?>&page2=<?=$page2;?>&pid=<?=$pid;?>&cidstr=<?=$cidstr;?>";
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
            document.location.href="product2_del.php?srhcid=<?=$srhcid;?>&srhccid=<?=$srhccid;?>&page=<?=$page;?>&page2=<?=$page2;?>&pid=<?=$pid;?>&cidstr="+cidstr;
         }
}
</script>

</td>
</tr>
<? }else{ ?>
	<tr><td colspan=6 align=center>目前沒有資料.</td></tr>
<? } ?>

</table>	
</form>

 </li> 
      
    </ul>
  </div>
  <?include ("bottom.php"); ?>
