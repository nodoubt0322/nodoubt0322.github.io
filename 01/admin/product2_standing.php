<?include ("session.php"); 
   include ("../connect.php");

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

	$sql2 = "SELECT a.*,b.cname as cname2 FROM `tb_prod` a ".
		       "left join tb_item_kind b on a.cid=b.cid ".
			   "where a.pid=$pid";
//echo $sql2;
//exit;   		   
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
	
$kind=$_GET["kind"]; 
$id=$_GET["id"];

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
$standing=$row["standing"];

$sql="SELECT max( standing ) as ms FROM tb_product2 where pid=$pid";
$rs2=mysql_query($sql);
$row2 = mysql_fetch_array($rs2);
$ms=$row2["ms"];

$standing2=$standing-1; //前一個
$standing3=$standing+1; //後一個

if ($standing2==0) $standing2=$ms;
if ($standing3>$ms) $standing3=1;

$sql="select id from tb_product2 where pid=$pid and standing=$standing2";
$rs3=mysql_query($sql);
$row3 = mysql_fetch_array($rs3);
$pid2=$row3["id"]; //前一個的pid

$sql="select id from tb_product2 where pid=$pid and standing=$standing3";
$rs4=mysql_query($sql);
$row4 = mysql_fetch_array($rs4);
$pid3=$row4["id"]; //後一個的pid

$sql="select id from tb_product2 where pid=$pid and standing=1";
$rs5=mysql_query($sql);
$row5 = mysql_fetch_array($rs5);
$pid_top=$row5["id"]; //置頂的pid

$sql="select id from tb_product2 where pid=$pid and standing=$ms";
$rs6=mysql_query($sql);
$row6 = mysql_fetch_array($rs6);
$pid_last=$row6["id"]; //置底的pid

//echo "pid2=".$pid2."<BR>";
//echo "pid3=".$pid3."<BR>";
//echo "pid_top=".$pid_top."<BR>";
//echo "pid_last=".$pid_last."<BR>";
//exit;
switch($kind){
  case "1":
        $sql="update tb_product2 set standing=$standing2 where id=$id";
        mysql_query($sql);

        $sql="update tb_product2 set standing=$standing where id=$pid2";
        mysql_query($sql);

        break;
 case "2":
        $sql="update tb_product2 set standing=$standing3 where id=$id";
        mysql_query($sql);

        $sql="update tb_product2 set standing=$standing where id=$pid3";
        mysql_query($sql);

        break;
 case "3":
        $sql="update tb_product2 set standing=1 where id=$id";
        mysql_query($sql);

        $sql="update tb_product2 set standing=$standing where id=$pid_top";
        mysql_query($sql);

        break;
 case "4":
        $sql="update tb_product2 set standing=$ms where id=$id";
        mysql_query($sql);

        $sql="update tb_product2 set standing=$standing where id=$pid_last";
        mysql_query($sql);

        break;
}
?>
    <script language=javascript>
            document.location.href="product2.php?srhcid=<?=$srhcid;?>&srhccid=<?=$srhccid;?>&srhcccid=<?=$srhcccid;?>&page=<?=$page;?>&page2=<?=$page2;?>&pid=<?=$pid;?>";
    </script>
