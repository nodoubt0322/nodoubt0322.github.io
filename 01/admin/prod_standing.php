<?include ("session.php"); 
   include ("../connect.php"); 
   
   $s_flag=$_GET["s_flag"];
   
   
$srhcid=$_GET["cid"];
$srhcid2=$_GET["ccid"];

   $addsql="";
   if ($s_flag=="1") $addsql=" and pid>0 ";
   if ($s_flag=="2") $addsql=" and cid=$srhcid and ccid=-1 ";
   if ($s_flag=="3") $addsql=" and cid=$srhcid and ccid=$srhcid2 ";
   
$pid=$_GET["pid"];   
$kind=$_GET["kind"]; 

$sql="select * from tb_prod where pid<>0 $addsql and pid=$pid";
$rs=mysql_query($sql);
$findtot=mysql_num_rows($rs);

//echo $sql."<BR>";
//echo $findtot;
//exit;
if ($findtot==0){
?>
    <script language=javascript>
            location.href="main.php";
    </script>
<?
    exit;	
}	

$row = mysql_fetch_array($rs);
$standing=$row["standing".$s_flag];

$sql="SELECT max( standing$s_flag ) as ms FROM tb_prod where pid<>0 $addsql ";
$rs2=mysql_query($sql);
$row2 = mysql_fetch_array($rs2);
$ms=$row2["ms"];

$standing2=$standing-1; //前一個
$standing3=$standing+1; //後一個

if ($standing2==0) $standing2=$ms;
if ($standing3>$ms) $standing3=1;

//if ($standing2<0) $standing2=1;
//if ($standing3<0) $standing3=1;

//echo $ms."<BR>";
//echo $standing2."<BR>";
//echo $standing3;
//exit;

$sql="select pid from tb_prod where pid<>0 $addsql  and standing$s_flag=$standing2";
$rs3=mysql_query($sql);
$row3 = mysql_fetch_array($rs3);
$pid2=$row3["pid"]; //前一個的pid

$sql="select pid from tb_prod where pid<>0 $addsql  and standing$s_flag=$standing3";
$rs4=mysql_query($sql);
$row4 = mysql_fetch_array($rs4);
$pid3=$row4["pid"]; //後一個的pid

$sql="select pid from tb_prod where pid<>0 $addsql  and standing$s_flag=1";
$rs5=mysql_query($sql);
$row5 = mysql_fetch_array($rs5);
$pid_top=$row5["pid"]; //置頂的pid

$sql="select pid from tb_prod where pid<>0 $addsql  and standing$s_flag=$ms";
$rs6=mysql_query($sql);
$row6 = mysql_fetch_array($rs6);
$pid_last=$row6["pid"]; //置底的pid

switch($kind){
  case "1":
        $sql="update tb_prod set standing$s_flag=$standing2 where pid=$pid";
        mysql_query($sql);

        $sql="update tb_prod set standing$s_flag=$standing where pid=$pid2";
        mysql_query($sql);

        break;
 case "2":
        $sql="update tb_prod set standing$s_flag=$standing3 where pid=$pid";
        mysql_query($sql);

        $sql="update tb_prod set standing$s_flag=$standing where pid=$pid3";
        mysql_query($sql);

        break;
 case "3":
        $sql="update tb_prod set standing$s_flag=1 where pid=$pid";
        mysql_query($sql);

        $sql="update tb_prod set standing$s_flag=$standing where pid=$pid_top";
        mysql_query($sql);

        break;
 case "4":
        $sql="update tb_prod set standing$s_flag=$ms where pid=$pid";
        mysql_query($sql);

        $sql="update tb_prod set standing$s_flag=$standing where pid=$pid_last";
        mysql_query($sql);

        break;
}
?>
    <script language=javascript>
	<? if ($s_flag!="3") { ?>
            document.location.href="prod.php?focuspid=<?=$pid;?>&srhcid=<?=$srhcid;?>&srhcid2=<?=$srhcid2;?>#prod<?=$pid;?>";
	<? }else{ ?>		
	        document.location.href="prod.php?focuspid=<?=$pid;?>&srhcid=<?=$srhcid;?>&srhcid2=<?=$srhcid2;?>";
	<? } ?>		
    </script>
