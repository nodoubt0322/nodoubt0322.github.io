<?include ("session.php"); 
   include ("title.php");

$aid=$_GET["aid"];   
$kind=$_GET["kind"]; 

$sql="select * from tb_ad where aid=$aid";
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

$sql="SELECT max( standing ) as ms FROM tb_ad";
$rs2=mysql_query($sql);
$row2 = mysql_fetch_array($rs2);
$ms=$row2["ms"];

$standing2=$standing-1; //前一個
$standing3=$standing+1; //後一個

if ($standing2==0) $standing2=$ms;
if ($standing3>$ms) $standing3=1;

$sql="select aid from tb_ad where standing=$standing2";
$rs3=mysql_query($sql);
$row3 = mysql_fetch_array($rs3);
$aid2=$row3["aid"]; //前一個的aid

$sql="select aid from tb_ad where standing=$standing3";
$rs4=mysql_query($sql);
$row4 = mysql_fetch_array($rs4);
$aid3=$row4["aid"]; //後一個的aid

$sql="select aid from tb_ad where standing=1";
$rs5=mysql_query($sql);
$row5 = mysql_fetch_array($rs5);
$aid_top=$row5["aid"]; //置頂的aid

$sql="select aid from tb_ad where standing=$ms";
$rs6=mysql_query($sql);
$row6 = mysql_fetch_array($rs6);
$aid_last=$row6["aid"]; //置底的aid

switch($kind){
  case "1":
        $sql="update tb_ad set standing=$standing2 where aid=$aid";
        mysql_query($sql);

        $sql="update tb_ad set standing=$standing where aid=$aid2";
        mysql_query($sql);

        break;
 case "2":
        $sql="update tb_ad set standing=$standing3 where aid=$aid";
        mysql_query($sql);

        $sql="update tb_ad set standing=$standing where aid=$aid3";
        mysql_query($sql);

        break;
 case "3":
        $sql="update tb_ad set standing=1 where aid=$aid";
        mysql_query($sql);

        $sql="update tb_ad set standing=$standing where aid=$aid_top";
        mysql_query($sql);

        break;
 case "4":
        $sql="update tb_ad set standing=$ms where aid=$aid";
        mysql_query($sql);

        $sql="update tb_ad set standing=$standing where aid=$aid_last";
        mysql_query($sql);

        break;
}
?>
    <script language=javascript>
            location.href="ad.php";
    </script>
