<?
   include ("title.php");
   ?>
            <div id="container">
      <div class="contentpage-c">
      	<h2 class="titlestyle">會員中心 /</h2>
        <div class="word">
        <div id="member">
		
		<form name="loginforms" action="forgetpass_ok.php" method="post">		
	  <div class="login">
        <div class="forgetpass">
          <div class="titlestyle-s">
            <span class="title">忘記密碼 / <span class="titleE"> Forget Password</span></span>
          </div>
          <div class=" titlestyle02 b6">請輸入您註冊時的帳號和Email信箱</div>
          <div class="block">註冊信箱: 
            <input name="email" type="text" class="text01" id="email" />
        </div>
          <div class="block t8"> 
            <input type="button" class="btt2" value="送出" onclick="javascript:checkqq();" />
        </div>
        </div>
	  </div>
      <div style="clear:both"></div>
    </div>
      </div>
      <div style="clear:both"></div>
      </div>
      <script language="javascript">
		function checkqq()
		{
					 
					 if (document.getElementById("email").value==""){
						alert ("請輸入Email信箱.");
						document.loginforms.email.focus();
						return;
					}		  

                    if (confirm("是否確定送出?"))
                    {					
					    document.forms['loginforms'].submit();
					}
		}
		</script>
		</form>



            </div>
        </div>
    </div>



    </div>
    <?
   include ("bottom.php");
   ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script> -->
    <script src="js/totop/js/jquery.ui.totop.js" type="text/javascript"></script>
    <!-- <script src="js/totop/js/easing.js" type="text/javascript" ></script> -->
    <script src="js/goodchange.js" type="text/javascript"></script>
    <!-- 選單js -->
    <script src="js/jqbanner/rotatingbanner.js" type="text/javascript"></script>
    <!-- banner輪轉js -->
    <script src="js/slick.min.js" type="text/javascript"></script>
    <!-- 熱門商品js -->
    <script src="js/main.js"></script>
</body>

</html>
