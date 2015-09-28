       <div style="float: left;height: 5px; width: 176px;margin-top: 0px; padding-top: 0px; padding-left: 15px;"></div>
	   <?//<div id="foodss">
           //             <input name="" type="text" size="12" />
             //           <div id="bottt">搜尋</div>
               //     </div>
        
		$sql="select * from tb_ad order by standing";
		$rs=mysql_query($sql);
		$totnum= mysql_num_rows($rs); 

        if ($totnum>0) 
		{   		
		?>
			<ul class="sdfsxfvlist">
			 
			<?
			 while ( $row = mysql_fetch_array($rs)) 
             { 
			?>
			         <li>
					 <? if ($row["url"]!=""){?>
							<a href="<?=$row["url"];?>" target="_blank">
					  <? } ?>
					  
					  <img src="pic/sdfsxfv/<?=$row["pic"];?>" width=191 border=0></img>
					  
					  <? if ($row["url"]!=""){?>
							 </a>
					  <? } ?>
					 </li>
			<? } ?>  
			</ul>
		<? } ?>