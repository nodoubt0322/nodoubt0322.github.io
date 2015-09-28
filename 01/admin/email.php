<?include ("title.php"); ?>
<div  class="right">
  <div class="right01"> 管理者信箱</div>
  
<ul>
      
      <li>
	  <?
  
$sql="select * from tb_email order by eid";
$rs=mysql_query($sql);
?>
<form name=form1 method=post action="email_ok.php"><BR>
<center>
<table width=800 border=0 align=center style="color:black;">
	  <tr><td align=center>
(最多可設定10組Email,連絡我們及訂單通知時使用)
</td></tr></table>
<BR><BR>
<table width=350 border='1' cellspacing='0'  style="color:black;" cellpadding='1' bordercolorlight='#006699' bordercolordark='#FFFFFF' align='center'>
<tr bgcolor="#C9C9C9">
                    <td align=center><div align="center"><font color=black>編號</font></div></td>
					<td align=center><div align="center"><font color=black>Email</font></div></td>
</tr>					
<? 
  $iii=0;
  while ( $row = mysql_fetch_array($rs)) 
  {
          $iii++;
         
		  
?>		  
<tr>
<td align=left><?=$iii;?></td>
<td align=left><input type=text name="email<?=$iii;?>" id="email<?=$iii;?>" value="<?=$row["email"];?>" size=30></td>
</tr>
<?
  }

  for ($j=$iii+1;$j<=10;$j++){
?>
<tr>
<td align=left><?=$j;?></td>
<td align=left><input type=text name="email<?=$j;?>" id="email<?=$j;?>" size=30></td>
</tr>
<?
 }  
?>
<tr><td align=center colspan=3><input name="cmdOK" type="button" value="送出"  onclick="javascript:check();">　
<input type=reset value="重填"></td></tr>
</table>

<script language=javascript>
function check(){  
data="";
flag="";
<?
$s="ABC";
for ($i=1;$i<=10;$i++){ ?>       
         email=document.getElementById("email<?=$i;?>").value;
         if (email!=""){
		      flag="1";
			  if (data.indexOf(email+",")>=0){
				 alert ("Email:"+email+"重複設定.");
				document.form1.email<?=$i;?>.focus();
				return; 
			  }else{
				 data=data+email+",";
			  }
		  }

<? } ?>
         if (flag==""){
            alert ("請至少輸入一個Email.");
            document.form1.email1.focus();
            return;
         }           
		 document.form1.submit();
}		 
</script>         
</form>
      </li> 
      
    </ul>
  </div>
  <?include ("bottom.php"); ?>
