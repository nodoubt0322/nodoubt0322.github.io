<? include ("session.php");
    include ("../connect.php");
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
	$eid=$_GET["eid"];

    
		$sql="select * from tb_edm where eid=$eid";
		$rs=mysql_query($sql);
        $totnum= mysql_num_rows($rs);
		
if ($totnum>0) {
    $row= mysql_fetch_array($rs);
?>
<title><?=$row["subject"];?></title>
<?	
    echo $row["memo"];
}	
?>	
<HR>
	<center>

<input type=button value="關　　閉" onclick="javascript:xxx();">　


<script language=javascript>
	
   function xxx(){
   window.open('','_parent','');   
window.close();   

   }
   </script>   
