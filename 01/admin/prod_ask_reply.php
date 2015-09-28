<?include ("session.php"); 
   include ("title.php");
$cid=$_GET["cid"];
$page=$_GET["page"];

$sql = "SELECT a.*,b.subject as pname FROM `tb_prod_ask` a left join `tb_prod` b on a.pid=b.pid where a.cid=$cid";
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
  <div class="right01"> 商品諮詢內容</div>
  
<ul>
      
      <li>
<form name="form1" method="post" action="prod_ask_reply_ok.php">
<input type=hidden name="cid" value="<?=$cid;?>"> 
<input type=hidden name="page" value="<?=$page;?>"> 
<input type=hidden name="page2" value="<?=$page2;?>"> 

<BR>

<table border="1" cellpadding="0" cellspacing="1" style="color:black;" width=1200>
          <tbody>
            <tr>
              <td valign="top"  bgcolor="#C9C9C9" style="vertical-align:bottom;">商品名稱</td>
              <td><?=$row["pname"];?></td>
			</tr>
            <tr>  
              <td valign="top"  bgcolor="#C9C9C9" style="vertical-align:bottom;">標題</td>
              <td><?=$row["subject"];?></td>
            </tr>
            <tr>
              <td valign="top"  bgcolor="#C9C9C9"><span class="star">姓名</span></td>
              <td><?=$row["cname"];?></td>
			</tr>
			<tr>
              <td valign="top"  bgcolor="#C9C9C9"><span class="star">手機</span></td>
              <td><?=$row["mobile"];?></td>
			</tr>
            <tr>  
              <td valign="top"  bgcolor="#C9C9C9" style="vertical-align:bottom;">Email</td>
              <td><?=$row["email"];?></td>
            </tr>
            <tr>
              <td valign="top"  bgcolor="#C9C9C9">內容</td>
              
              <td><?=$row["memo"];?></td>
            </tr>
            
			<tr>
              <td valign="top"  bgcolor="#C9C9C9"><span class="star">填寫時間</span></td>
              <td align="left" ><?=$row["write_time"];?></td>
            </tr>
            <tr>
              <td valign="top"  bgcolor="#C9C9C9"><span class="star">回覆內容</span></td>
              <td align="left" ><textarea cols=80 rows=10 name="memo_reply" id="memo_reply"><?=str_replace("<BR>","\r\n",$row["memo_reply"]);?></textarea></td>
            </tr>
			<tr>
              <td valign="top"  bgcolor="#C9C9C9"><span class="star">回覆時間</span></td>
              <td align="left" ><?=str_replace("0000-00-00 00:00:00","",$row["reply_time"]);?></td>
            </tr>
			<tr>
              <td colspan="2" align="center" >
			  <input type="button" value="回覆" onclick="javascript:check();">　
	
			  <input type="button" value="返回.." onclick="location.replace('prod_ask.php?page=<?=$page;?>')" />
			  </td>
            </tr>
          </tbody>
        </table>
		<script language=javascript>
			function check()
			{
                 if (document.getElementById("memo_reply").value==""){
					   alert ("請輸入回覆內容.");
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