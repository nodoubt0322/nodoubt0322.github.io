<?include ("session.php"); 
   include ("title.php");

$cid=$_GET["cid"];   
$kind=$_GET["kind"]; 
$ccid=$_GET["ccid"];

$sql="select * from tb_item_kind2 where ccid=$ccid";
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
$standing=$row["standing"];

$sql="SELECT max( standing ) as ms FROM tb_item_kind2 where cid=$cid";
$rs2=mysql_query($sql);
$row2 = mysql_fetch_array($rs2);
$ms=$row2["ms"];

$standing2=$standing-1; //前一個
$standing3=$standing+1; //後一個

if ($standing2==0) $standing2=$ms;
if ($standing3>$ms) $standing3=1;

$sql="select ccid from tb_item_kind2 where cid=$cid and standing=$standing2";
$rs3=mysql_query($sql);
$row3 = mysql_fetch_array($rs3);
$cid2=$row3["ccid"]; //前一個的cid

$sql="select ccid from tb_item_kind2 where cid=$cid and standing=$standing3";
$rs4=mysql_query($sql);
$row4 = mysql_fetch_array($rs4);
$cid3=$row4["ccid"]; //後一個的cid

$sql="select ccid from tb_item_kind2 where cid=$cid and standing=1";
$rs5=mysql_query($sql);
$row5 = mysql_fetch_array($rs5);
$cid_top=$row5["ccid"]; //置頂的cid

$sql="select ccid from tb_item_kind2 where cid=$cid and standing=$ms";
$rs6=mysql_query($sql);
$row6 = mysql_fetch_array($rs6);
$cid_last=$row6["ccid"]; //置底的cid

switch($kind){
  case "1":
        $sql="update tb_item_kind2 set standing=$standing2 where ccid=$ccid";
        mysql_query($sql);

        $sql="update tb_item_kind2 set standing=$standing where ccid=$cid2";
        mysql_query($sql);

        break;
 case "2":
        $sql="update tb_item_kind2 set standing=$standing3 where ccid=$ccid";
        mysql_query($sql);

        $sql="update tb_item_kind2 set standing=$standing where ccid=$cid3";
        mysql_query($sql);

        break;
 case "3":
        $sql="update tb_item_kind2 set standing=1 where ccid=$ccid";
        mysql_query($sql);

        $sql="update tb_item_kind2 set standing=$standing where ccid=$cid_top";
        mysql_query($sql);

        break;
 case "4":
        $sql="update tb_item_kind2 set standing=$ms where ccid=$ccid";
        mysql_query($sql);

        $sql="update tb_item_kind2 set standing=$standing where ccid=$cid_last";
        mysql_query($sql);

        break;
}
?>
    <script language=javascript>
            location.href="item_kind2.php?cid=<?=$cid;?>";
    </script>
