<?
   include ("title.php");
   ?>
                <div class="contentpage-c">
                    <h2 class="titlestyle">常見問題 <span class="font12px color-br">/ Q&amp;A</span></h2>
                    <div class="word">
                        <div class="products-all">
                            <div id="qaContent">
                                <h3 class="qa_group_1">訂購相關問題1</h3>
                                <ul>
                                    <li>
                                        <div>是否有提供送貨到離島的服務？</div>
                                        <div>
                                            因航運成本較高，本站提供免運費服務的範圍只限台灣本島。
                                            <br /> 若送貨地點是在離島等地時，目前暫不提供寄送服務。
                                        </div>
                                    </li>
                                    <li>
                                        <div>是否有提供送貨到離島的服務？</div>
                                        <div>
                                            因航運成本較高，本站提供免運費服務的範圍只限台灣本島。
                                            <br /> 若送貨地點是在離島等地時，目前暫不提供寄送服務。
                                        </div>
                                    </li>
                                    <li>
                                        <div>是否有提供送貨到離島的服務？</div>
                                        <div>
                                            因航運成本較高，本站提供免運費服務的範圍只限台灣本島。
                                            <br /> 若送貨地點是在離島等地時，目前暫不提供寄送服務。
                                        </div>
                                    </li>
                                    <li>
                                        <div>是否有提供送貨到離島的服務？</div>
                                        <div>
                                            因航運成本較高，本站提供免運費服務的範圍只限台灣本島。
                                            <br /> 若送貨地點是在離島等地時，目前暫不提供寄送服務。
                                        </div>
                                    </li>
                                    <li>
                                        <div>是否有提供送貨到離島的服務？</div>
                                        <div>
                                            因航運成本較高，本站提供免運費服務的範圍只限台灣本島。
                                            <br /> 若送貨地點是在離島等地時，目前暫不提供寄送服務。
                                        </div>
                                    </li>
                                </ul>

                                <h3 class="qa_group_1">訂購相關問題2</h3>
                                <ul>
                                    <li>
                                        <div>是否有提供送貨到離島的服務？</div>
                                        <div>
                                            因航運成本較高，本站提供免運費服務的範圍只限台灣本島。
                                            <br /> 若送貨地點是在離島等地時，目前暫不提供寄送服務。
                                        </div>
                                    </li>
                                    <li>
                                        <div>是否有提供送貨到離島的服務？</div>
                                        <div>
                                            因航運成本較高，本站提供免運費服務的範圍只限台灣本島。
                                            <br /> 若送貨地點是在離島等地時，目前暫不提供寄送服務。
                                        </div>
                                    </li>
                                    <li>
                                        <div>是否有提供送貨到離島的服務？</div>
                                        <div>
                                            因航運成本較高，本站提供免運費服務的範圍只限台灣本島。
                                            <br /> 若送貨地點是在離島等地時，目前暫不提供寄送服務。
                                        </div>
                                    </li>
                                    <li>
                                        <div>是否有提供送貨到離島的服務？</div>
                                        <div>
                                            因航運成本較高，本站提供免運費服務的範圍只限台灣本島。
                                            <br /> 若送貨地點是在離島等地時，目前暫不提供寄送服務。
                                        </div>
                                    </li>
                                    <li>
                                        <div>是否有提供送貨到離島的服務？</div>
                                        <div>
                                            因航運成本較高，本站提供免運費服務的範圍只限台灣本島。
                                            <br /> 若送貨地點是在離島等地時，目前暫不提供寄送服務。
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div style="clear:both"></div>
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



<script type="text/javascript">
<!-----------Q&A---------------->
$(function() {
    // 幫 #qaContent 的 ul 子元素加上 .accordionPart
    // 接著再找出 li 中的第一個 div 子元素加上 .qa_title
    // 並幫其加上 hover 及 click 事件
    // 同時把兄弟元素加上 .qa_content 並隱藏起來
    $('#qaContent ul').addClass('accordionPart').find('li div:nth-child(1)').addClass('qa_title').hover(function() {
        $(this).addClass('qa_title_on');
    }, function() {
        $(this).removeClass('qa_title_on');
    }).click(function() {
        // 當點到標題時，若答案是隱藏時則顯示它，同時隱藏其它已經展開的項目
        // 反之則隱藏
        var $qa_content = $(this).next('div.qa_content');
        if (!$qa_content.is(':visible')) {
            $('#qaContent ul li div.qa_content:visible').slideUp();
        }
        $qa_content.slideToggle();
    }).siblings().addClass('qa_content').hide();
});
<!-----------Q&A---------------->
</script>

</html>
