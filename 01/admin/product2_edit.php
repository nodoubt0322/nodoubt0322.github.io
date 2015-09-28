<?include ("session.php"); 
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
	
	$id=carhow($_GET["id"]);
   if ($id=="") $id=carhow($_POST["id"]);
   
$sql="select * from tb_product2 where id=$id";
$rs=mysql_query($sql);
$findtot=mysql_num_rows($rs);

if ($findtot==0){
?>
    <script language=javascript>
            document.location.href="main.php";
    </script>
<?
    exit;	
}	

$row = mysql_fetch_array($rs);	
$sel1="";
$sel2="";
			  if ($row["isshow"]=="Y") $sel1=" checked";
			  if ($row["isshow"]=="N") $sel2=" checked";
?>
<div  class="right">
  <div class="right01"> 產品圖片-修改</div>
  
<ul>
      
      <li>
<table width=900 border="0" style="color:black;">
    <tr>
      <td align=center>
<form name=form1 method=post action="product2_edit_ok.php" enctype="multipart/form-data">
<input type=hidden name="srhcid" value="<?=$srhcid;?>">
<input type=hidden name="page" value="<?=$page;?>">
<input type=hidden name="page2" value="<?=$page2;?>">
<input type=hidden name="pid" value="<?=$pid;?>">
<input type=hidden name="id" value="<?=$id;?>">
<input type=hidden name="old_pic1" value="<?=$row["pic"];?>">

<center>產品名稱:<?=$row2["subject"];?>
<table width=900 border='1' cellspacing='0' style="color:black;" cellpadding='1' bordercolorlight='#006699' bordercolordark='#FFFFFF' align='center'>

<tr>
<TD align=right bgcolor="#6C6C6C"><font color=white>產品圖:</font></td>
    <td align=left colspan=2><input type=file name="myfile1" id="myfile1" size=60>
<?	
	    echo " (格式:jpg/png,寬高比例需為1:1)";
?>	
	</td>
</tr>

<tr><td colspan=2 align=center>
<input type="button" value="確定修改" onclick="javascript:check();">　
<input type=reset value="清除重填">　
<input type=button value="放棄修改.." onclick="location.replace('product2.php?srhcid=<?=$srhcid;?>&page=<?=$page;?>&page2=<?=$page2;?>&pid=<?=$pid;?>')">
</td></tr>
</table>
<?
if ($row["pic"]!="") { ?>
       <BR><BR><center><img src="../pic/prod2/<?=$row["pic"]; ?>" /></img></center>
<? } ?>

			<script language=javascript>
			function check(){
			
			if (document.getElementById("myfile1").value!=""){	  
				 b=document.getElementById("myfile1").value.toLowerCase();
				 if (b.indexOf(".jpg")<0 && b.indexOf(".gif")<0) {
					alert ("產品圖圖檔格式錯誤(jpg/gif/png)...");
					return;
				 }		 
		   }
		
			document.form1.submit();
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
