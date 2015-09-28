<?

//standing1: all
$sql = "SELECT * FROM `tb_prod` order by standing1,write_time DESC";
$rs=mysql_query($sql);		

$i=0;

while ($row= mysql_fetch_array($rs))
{
      $i++; 
      $pidx=$row["pid"];
	  mysql_query("update `tb_prod` set standing1=".$i." where pid=".$pidx);
}

//==================================================================================

//standing2: ccid=-1
$sql = "SELECT cid FROM `tb_prod` where ccid=-1 group by cid";
$rs=mysql_query($sql);		

while ($row= mysql_fetch_array($rs))
{       
	    $i=0;
        $cidx=$row["cid"];
	  
	    $sql2 = "SELECT * FROM `tb_prod` where cid=$cidx and ccid=-1  order by standing2,write_time DESC";
		$rs2=mysql_query($sql2);		

		while ($row2= mysql_fetch_array($rs2))
		{
			  $i++; 
			  $pidx=$row2["pid"];
			  mysql_query("update `tb_prod` set standing2=".$i." where pid=".$pidx);
		}
		mysql_query("update `tb_prod` set standing2=-1 where cid=$cidx and ccid<>-1");
}

//standing3: ccid<>-1
$sql = "SELECT cid FROM `tb_prod` where ccid<>-1 group by cid";
$rs=mysql_query($sql);		

while ($row= mysql_fetch_array($rs))
{       
        $cidx=$row["cid"];
	  
	    $sql2 = "SELECT ccid FROM `tb_prod` where cid=$cidx and ccid<>-1 group by ccid";
		$rs2=mysql_query($sql2);		

		while ($row2= mysql_fetch_array($rs2))
		{
			    $ccidx=$row2["ccid"];
			    $sql3 = "SELECT * FROM `tb_prod` where cid=$cidx and ccid=$ccidx order by standing3,write_time desc";
				$rs3=mysql_query($sql3);
				
                $i=0;
				while ($row3= mysql_fetch_array($rs3))
				{       
					  $i++;
					  $pidx=$row3["pid"];
					  mysql_query("update `tb_prod` set standing3=".$i." where pid=".$pidx);
			    }
		}
		mysql_query("update `tb_prod` set standing3=-1 where cid=$cidx and ccid=-1");
}
?>			  

			  