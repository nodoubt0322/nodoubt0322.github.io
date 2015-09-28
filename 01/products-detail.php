<? include ("title.php"); ?>
    <div id="container">
      <div class="ind-menu">
        <? include ("menu_prod.php"); ?> 
       <div id="side_bom"></div>
       <? include ("ksdfhsdf.php"); ?> 
      </div>
	   <?
	  
	  $cid=carhow($_GET["cid"]);
	  $ccid=carhow($_GET["ccid"]);
	  
	  $keys=carhow($_GET["keys"]);
	  $pid=carhow($_GET["pid"]);
	  $backkind=carhow($_GET["backkind"]);
	  $page=carhow($_GET["page"]);
	  
	  $sql = "SELECT a.*,b.cname as cn1,c.cname as cn2 FROM tb_prod a left join tb_item_kind b on a.cid=b.cid 
	         left join tb_item_kind2 c on a.ccid=c.ccid 
			 where a.pid=$pid and b.isshow='Y'";
	 
	 $rs=mysql_query($sql);
	 $totnum= mysql_num_rows($rs);
	 
//echo $sql."<BR>";
//echo $totnum;
//exit;			

	 if ($totnum==0)
	 {
?>
		<script language=javascript>
				document.location.href="<?=$backurls;?>";
		</script>
<?
		   exit;	
	 }	
     $row = mysql_fetch_array($rs);
	 
	 
	 ?>
<form name="form1" action="car_add.php" method="post">
<input type=hidden name="pid" value="<?=$pid;?>">   

      <div class="contentpage">
      	<div class="page-title-r inside-page">產品介紹 /</div>
        <div class="word">
        <div class="products-c">
        <div class="products-all">
          <div  id="bigPic" class="leftpic">
<?
		  $sqlw = "SELECT * FROM `tb_product2` where pid=".$pid." order by standing limit 1";
		  $rsw=mysql_query($sqlw);
          
          while ( $roww = mysql_fetch_array($rsw)) 
          {
          ?>		  
		  <img src="pic/prod2/<?=$roww["pic"];?>" alt="" width="400" />
<?        } ?>   		  
		  <!---450px--->  
          </div><!---leftpic--->  
          
          <div class="rightdata">
            <ul class="desc">
              <li class="color-o"><strong><?=$row["subject"];?></strong></li>
<?
$p=$row["price2"];	
$k=explode(",",$p); 

$pp=$row["price"];
$kk=explode(",",$pp);
?>				
                 
              <li class="b6">
			      <div id="showprice1">
				       <span class="tt">售價:</span><span class="color-r" style="text-decoration: line-through"><?=$k[0];?></span><span class="l4">元</span>
				  </div>
			  </li>
			  
              <li class="b12 ">
			      <div id="showprice2">
				       <span class="tt">會員價:</span><span class="color-r"><?=$kk[0];?></span><span class="l4">元</span>
				  </div>
			  </li>
              
			  <li class="b12 "><span class="tt">商品描述:</span></li>
              <li class="b12 "><?=str_replace("\n","<BR>",$row["memo2"]);?></li>
              <li class="b12 ">
                  <span class="tt">規格:</span>
                  <select name="spec" id="spec" onchange="javascript:showprice();">
<?
$kkk=explode(",",$row["spec"]);  

//echo sizeof($kkk);
//exit;
   
for ($i=0;$i<=sizeof($kkk);$i++) {
if ($kkk[$i]!="") {
?>				  
                    <option value="<?=$i;?>"><?=$kkk[$i];?></option>
<? }
}
?>                    
                  </select>
              </li>
              <li class="b12 lineh20"><span class="tt">數量:</span>
                <select id="qty" name="qty" class="sl1">
				  <? 
				     $ii=10;
					 
				     for ($i=1;$i<=$ii;$i++) { ?>
                          <option value="<?=$i;?>"><?=$i;?></option>
				  <? } ?>
                  </select>
              </li>
            </ul>
            <a href="javascript:check();" class="btt2 bttleft"><img src="images/empty_shopping_cart.png" width="147" height="45" /></a>
            
          </div><!---rightdata--->
          <div style="clear:both"></div>
          <div class="small_pic" style="padding-left:25px;">
 <?
		  $sqlw = "SELECT * FROM `tb_product2` where pid=".$pid." order by standing limit 4";
		  $rsw=mysql_query($sqlw);
          $q=0;
          while ( $roww = mysql_fetch_array($rsw)) 
          {
		          $q++;
?>				  
            <span><img src="pic/prod2/<?=$roww["pic"];?>" style="width:80px;" alt=""></span>
            <? } ?>	
          </div>  
        </div>
        
        <div class="products-all products-allbg">
            
            <div id="yui_3_11_0_1_1392644023425_991">
              <div id="yui_3_11_0_1_1392644023425_990">
                <div id="yui_3_11_0_1_1392644023425_989">
                  <table width="100%" id="yui_3_11_0_1_1392644023425_987">
                    <tbody id="yui_3_11_0_1_1392644023425_986">
                      <tr id="yui_3_11_0_1_1392644023425_985">
                        <td valign="top" id="yui_3_11_0_1_1392644023425_984">
						<?=$row["memo"];?>
						</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

            </div>
            
            <p>&nbsp;</p>
            <p>&nbsp;</p>
<script language="javascript">     
function showprice()
{
         g=document.getElementById("spec").value;
		 
		 <?
		 for ($i=0;$i<=sizeof($kkk);$i++) {
             if ($kkk[$i]!="") 
			 {
         ?>
				 if (g=="<?=$i;?>")
				 {
					 
					 document.getElementById("showprice1").innerHTML="<span class=\"tt\">售價:</span><span class=\"color-r\" style=\"text-decoration: line-through\"><?=$k[$i];?></span><span class=\"l4\">元</span>";					 
					 document.getElementById("showprice2").innerHTML="<span class=\"tt\">會員價:</span><span class=\"color-r\"><?=$kk[$i];?></span><span class=\"l4\">元</span>";
					 
				 }
		 <? } 
		 }
		 ?>
} 
function check()
{         
         b=document.form1.qty.value;
         if (b==""){
            alert ("請選擇數量.");
            return;
         } 
		  document.form1.submit();  
}
</script>	  
</form> 	
            
            <div class="guestbook">
             <?
			$sql = "SELECT * FROM `tb_prod_ask` where pid=$pid and memo_reply<>'' order by write_time DESC";
			//echo $sql;
			//exit;
			$rs=mysql_query($sql);
			$totnum= mysql_num_rows($rs);
					
			if ($totnum>0) {			
			?>
              <div class="titlestyle88">訪客留言</div>
            	<table width="100%" border="0" align="left" cellspacing="10">
				<tbody>
				<?
			      while ($row= mysql_fetch_array($rs))
	              {
                ?>
					<tr>
					  <td width="68" align="center" valign="top"><?=$row["cname"];?></td>
					  <td width="622" valign="middle">
						<p><?=$row["subject"];?>              </p>
						<p><?=$row["memo"];?> </p>
						<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="aa">
						  <tr>
							<td width="16%" bgcolor="#EBECDF" valign=top>管理者回覆：</td>
							<td width="84%" bgcolor="#EBECDF"><?=$row["memo_reply"];?></td>
							</tr>
						  </table>
						<hr />
						</td>
					</tr>
				<? } ?>
				
				
			  </tbody>
			  </table>
        <? } ?>
        
        
        <div class="titlestyle88">留言</div>
        <div class="contactus">
          <div class="formBox"><!--formBox-->
          <form method="post" action="products_ask.php" name="form2">
<input type=hidden name="pid" value="<?=$pid;?>">
            <div class="form">
              <label for="subject" class="leftside"><em>※</em>標題</label>
              <input type="text" id="subject" name="subject">
              </div>
            
            <div class="form"><label for="cname" class="leftside"><em>※</em>尊姓大名</label>
              <input type="text" id="cname" name="cname">
              </div>
            <div class="form">
              <label for="mobile" class="leftside"><em>※</em>行動電話</label>
              <input type="text" id="mobile" name="mobile">
              </div>                    
            
            <div class="form">
              <label for="email" class="leftside"><em>※</em>電子信箱</label>
              <input type="text" id="email" name="email">
              </div>
            <div class="form">
              <label for="memo" class="leftside"><em>※</em>內容說明</label>
              <textarea id="memo" name="memo" cols="45" rows="7"></textarea>
              </div>
            
    <div class="form">
 <label for="CAPTCHA" class="leftside"><em>※</em>驗證碼</label>
 <?
		  srand((double)microtime()*10000);
		   while(($authnum=rand()%10000)<1000);   
           $_SESSION["nod_prodask_code"]=$authnum;		   
		   ?>
 <input name="CAPTCHA" type="text" id="CAPTCHA" style="width:80px;" />
	<img src="submit_check.php?authnum=<?=$authnum;?>" />
 </div>
            <!--驗證區-->
           
           
                           
            <!--送出按鈕--> 
            <div class="btn">
              <a style="cursor:pointer" href="javascript:checksss();">確認送出</a>
              <a style="cursor:pointer" href="javascript:document.form2.reset();">清除重填</a>
              </div>
            <script language=javascript>
function checksss(){
         if (document.form2.subject.value==""){
            alert ("請輸入標題.");
            document.form2.subject.focus();
            return;
         } 
		 if (document.form2.cname.value==""){
            alert ("請輸入尊姓大名.");
            document.form2.cname.focus();
            return;
         } 
          if (document.getElementById("mobile").value==""){
		alert ("請輸入行動電話...");
				document.form2.mobile.focus();
				return;
         }
         if (document.form2.email.value==""){
            alert ("請輸入電子信箱.");
            document.form2.email.focus();
            return;
         }
		 
		 if ((document.form2.email.value.length<=5) || (document.form2.email.value.indexOf("@")<0) || (document.form2.email.value.indexOf(".")<0)){
            alert ("請輸入正確的電子信箱.");
            document.form2.email.focus();
            return;
         }
		
       if (document.form2.memo.value==""){
            alert ("請輸入需求說明.");
            document.form2.memo.focus();
            return;
         } 			 
		 if (document.form2.memo.value.length>500){
            alert ("需求說明限制為500字.");
            document.form2.memo.focus();
            return;
         } 
		if (document.form2.CAPTCHA.value==""){
				alert ("請輸入驗證碼.");
				document.form2.CAPTCHA.focus();
				return;
			 } 		 		 
			 
			 if (document.form2.CAPTCHA.value!="<?=$authnum;?>"){
				alert ("驗證碼輸入錯誤.");
				document.form2.CAPTCHA.focus();
				return;
			 }
         if (confirm("是否確定送出?")){
            document.form2.submit();		 
         }
    		 			 
}
</script>     


 </form>
          </div>
        </div>
        
            </div>
        </div>
        <div class="digg">
		<? if ($backkind=="888") { ?>
		      <a href="search.php?keys=<?=$keys;?>&page=<?=$page;?>">
		<? } 
		
		   if ($backkind=="1") { ?>
		      <a href="index.php">
		<?  } 
		
		    if ($backkind=="2") { ?>
		      <a href="products.php">
		<?  }
		
		if ($backkind=="3") { ?>
		      <a href="products-list.php?cid=<?=$cid;?>&ccid=<?=$ccid;?>&page=<?=$page;?>">
		<? } ?>
		
		回上一頁</a></div>
        </div>
      </div>
      </div>
    </div> 
  </div>
</div>



</div>
<? include ("bottom.php"); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/totop/js/jquery.ui.totop.js" type="text/javascript"></script>
    <script src="js/goodchange.js" type="text/javascript"></script>
    <!-- 選單js -->
    <script src="js/slick.min.js" type="text/javascript"></script>
    <!-- 熱門商品js -->
    <script src="js/main.js"></script>
    <script>
        $('.small_pic span img').click(function(){
          var pic_url = $(this).attr('src');
          var img = $('.leftpic img');
            img.attr('src', pic_url);
        })
    </script>
</body>

</html>