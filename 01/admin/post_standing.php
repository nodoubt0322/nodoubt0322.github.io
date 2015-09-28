<?include ("session.php"); 
   include ("../connect.php");

$pid=$_GET["pid"];   
$kind=$_GET["kind"]; 

$sql="select * from tb_post where pid=$pid";
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

$sql="SELECT max( standing ) as ms FROM tb_post";
$rs2=mysql_query($sql);
$row2 = mysql_fetch_array($rs2);
$ms=$row2["ms"];

$standing2=$standing-1; //前一個
$standing3=$standing+1; //後一個

if ($standing2==0) $standing2=$ms;
if ($standing3>$ms) $standing3=1;

$sql="select pid from tb_post where standing=$standing2";
$rs3=mysql_query($sql);
$row3 = mysql_fetch_array($rs3);
$pid2=$row3["pid"]; //前一個的pid

$sql="select pid from tb_post where standing=$standing3";
$rs4=mysql_query($sql);
$row4 = mysql_fetch_array($rs4);
$pid3=$row4["pid"]; //後一個的pid

$sql="select pid from tb_post where standing=1";
$rs5=mysql_query($sql);
$row5 = mysql_fetch_array($rs5);
$pid_top=$row5["pid"]; //置頂的pid

$sql="select pid from tb_post where standing=$ms";
$rs6=mysql_query($sql);
$row6 = mysql_fetch_array($rs6);
$pid_last=$row6["pid"]; //置底的pid

switch($kind){
  case "1":
        $sql="update tb_post set standing=$standing2 where pid=$pid";
        mysql_query($sql);

        $sql="update tb_post set standing=$standing where pid=$pid2";
        mysql_query($sql);

        break;
 case "2":
        $sql="update tb_post set standing=$standing3 where pid=$pid";
        mysql_query($sql);

        $sql="update tb_post set standing=$standing where pid=$pid3";
        mysql_query($sql);

        break;
 case "3":
        $sql="update tb_post set standing=1 where pid=$pid";
        mysql_query($sql);

        $sql="update tb_post set standing=$standing where pid=$pid_top";
        mysql_query($sql);

        break;
 case "4":
        $sql="update tb_post set standing=$ms where pid=$pid";
        mysql_query($sql);

        $sql="update tb_post set standing=$standing where pid=$pid_last";
        mysql_query($sql);

        break;
}
?>
    <script language=javascript>
            location.href="post.php";
    </script>
