<?include ("session.php"); 
   include ("title.php");
$cid=$_GET["cid"];
$page=$_GET["page"];

$sql = "SELECT a.* FROM `tb_contact` a where a.cid=$cid";
$rs=mysql_query($sql);
$findtot=mysql_num_rows($rs);

if ($findtot==0){
?>
    <script language=javascript>
            location.href="main.php";
    </script>
<?
    exit;	
}	

$row = mysql_fetch_array($rs);
?>
<div  class="right">
  <div class="right01"> 連絡我們資料內容</div>
  
<ul>
      
      <li>
<form name="form1" method="post" action="contact_ok.php">
<input type=hidden name="cid" value="<?=$cid;?>"> 
<input type=hidden name="page" value="<?=$page;?>"> 
<input type=hidden name="page2" value="<?=$page2;?>"> 

<BR>

<table border="1" cellpadding="0"  style="color:black;" cellspacing="1" width=900>
          <tbody>
           
            <tr>
              <td valign="top"  bgcolor="#C9C9C9"><span class="star">姓名</span></td>
              <td ><?=$row["cname"];?></td>              
            </tr>
			
			<tr>
              <td valign="top"  bgcolor="#C9C9C9">手機</td>
              <td ><?=$row["mobile"];?></td>
            </tr>
            <tr>
              <td valign="top"  bgcolor="#C9C9C9">電子信箱</td>
              <td ><?=$row["email"];?></td>
            </tr>
            
            <tr>
              <td valign="top"  bgcolor="#C9C9C9"><span class="star">內容</span></td>
              <td ><?=$row["memo"];?></td>
            </tr>
            
			<tr>
              <td valign="top"  bgcolor="#C9C9C9"><span class="star">填寫時間</span></td>
              <td align="left" ><?=$row["write_time"];?></td>
            </tr>
            <tr>
	<td bgcolor="#C9C9C9"><font color=black>回覆留言:</font></td>
	<td align="left">
	<? $memo_reply=$row["memo_reply"]; 
	   if ($memo_reply!="") {
	        $memo_reply=str_replace("<BR>","\r\n",$memo_reply);
	?>
	        <textarea cols=60 rows=5 name="memo_reply" id="memo_reply"><?=$memo_reply;?></textarea>
	<? }else{ ?>
	        <textarea cols=60 rows=5 name="memo_reply" id="memo_reply"></textarea>
	<? } ?>
	</td>
</tr>
<tr>
	<td  bgcolor="#C9C9C9"><font color=black>回覆時間:</font></td>
	<td align="left">
	<? $reply_time=$row["reply_time"]; 
	   if ($reply_time!="") {
	        $reply_time=str_replace("0000-00-00 00:00:00","",$reply_time);
	?>
	        <?=$reply_time;?>
	<? } ?>
	　</td>
</tr>
			<tr>
              <td colspan="2" align="center" >
			  <input type="button" value="回覆" onclick="javascript:check();">　
	&nbsp;&nbsp;
			  <input type="button" value="返回.." onclick="location.replace('contact.php?page=<?=$page;?>')" /></td>
            </tr>
          </tbody>
        </table>
		<script language=javascript>
			function check()
			{
                 if (document.getElementById("memo_reply").value==""){
					   alert ("請輸入回覆留言.");
					   document.form1.memo_reply.focus();
					   return;
					}	 

					
					if (confirm("是否確定回覆？")){
					   document.forms['form1'].submit();	
					}
			}
			 
			</script>
</td>
</tr>
</table>	
</form>
 </li> 
      
    </ul>
  </div>
  <?include ("bottom.php"); ?>