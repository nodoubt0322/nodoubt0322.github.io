        <div class="menu-title">
		商品列表
		</div>
        
        <div class="menu-list-p">
        <div class="accondion-menu">
		<ul class="menu-one">
			<?
		  $cid=carhow($_GET["cid"]);
		  $ccid=carhow($_GET["ccid"]);
		  
		  $sqlw="select * from tb_item_kind where isshow='Y' order by standing";
		  
		  $rsw=mysql_query($sqlw);
		  
          $i=0;
		  while ( $roww = mysql_fetch_array($rsw)) 
		  {
		         $cids=$roww["cid"]; 
				 $i++;
				 
				 if ($i==1)
				 {
				 ?>
                     <li class="firstChild">
                 <?	
				 }else{ ?>	
				    <li>
				 <? } ?>
				 
					<div class="header">
						
						<span class="txt"><?=$roww["cname"];?></span>
						<span class="arrow"></span>
					</div>
					
					
						<ul class="menu-two">
						<li class="firstChild"><a href="products-list.php?cid=<?=$cids;?>"><?=$roww["cname"];?>全部</a></li>					
							<?
							$sql2="select * from tb_item_kind2 where cid=$cids and isshow='Y' order by standing";
							$rs2=mysql_query($sql2);
							$findtot=mysql_num_rows($rs2);
							
							if ($findtot>0)
							{				
								$ii=0;   
								while ( $row2 = mysql_fetch_array($rs2)) 
								{
									$ccids=$row2["ccid"];
									$ii++;
									
									 ?>
									<li><a href="products-list.php?cid=<?=$cids;?>&ccid=<?=$ccids;?>"><?=$row2["cname"];?></a></li>					
							<?  } 
							}
						?>	
						</ul>
					
				</li>
		<? } ?>
		</ul>
    
	</div>
        </div> 
       