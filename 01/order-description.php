<?
   include ("title.php");
   ?>
            <div id="container">
                <div class="ind-menu">
                    <? include ("menu_prod.php"); ?> 
                    <div id="side_bom"></div>
                    <? include ("ksdfhsdf.php"); ?> 
                </div>

<?
$sql = "SELECT * FROM `tb_word` ".
			   "where kind='1'";

$rs=mysql_query($sql);
$row = mysql_fetch_array($rs);

$memo=$row["memo"];
?>
                <div class="contentpage">
                    <div class="page-title-r inside-page">訂購說明 /</div>
                    <div class="word"><?=$memo;?></div>
                </div>
            </div>
        </div>
    </div>



    </div>
    <div id="footer">
        <div class="menu">
            <ul>
                <li>
                    <a href="about.php" class="sss01">
                        <p>關於我們</p>
                    </a>
                </li>
                <li>
                    <a href="shopping.php">
                        <p>線上購物</p>
                    </a>
                </li>
                <li>
                    <a href="member.php">
                        <p>會員系統</p>
                    </a>
                </li>
                <li>
                    <a href="news.php">
                        <p>最新消息</p>
                    </a>
                </li>
                <li>
                    <a href="order-description.php">
                        <p>訂購說明</p>
                    </a>
                </li>
                <li>
                    <a href="contacts.php">
                        <p>聯絡我們</p>
                    </a>
                </li>
            </ul>
        </div>
        <p class="copy">Copyright &copy; 2014 LKK 版權所有 | 電話：06-3317711, 0926613579 傳真：06-3313051 </p>
    </div>

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
