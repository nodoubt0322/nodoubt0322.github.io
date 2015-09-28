

<!--//-----------------toTop---------------------------->
		$(document).ready(function() {
			/*
			var defaults = {
	  			containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
	 		};
			*/
			
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});

<!--//---------------toTop------------------------------>



<!--//-----------MENU---------------------------------->
	$(document).ready(function () {
		var aMenuOneLi = $(".menu-one > li");
		var aMenuTwo = $(".menu-two");
		$(".menu-one > li > .header").each(function (i) {
			$(this).click(function () {
				if ($(aMenuTwo[i]).css("display") == "block") {
					$(aMenuTwo[i]).slideUp(300);
					$(aMenuOneLi[i]).removeClass("menu-show")
				} else {
					for (var j = 0; j < aMenuTwo.length; j++) {
						$(aMenuTwo[j]).slideUp(300);
						$(aMenuOneLi[j]).removeClass("menu-show");
					}
					$(aMenuTwo[i]).slideDown(300);
					$(aMenuOneLi[i]).addClass("menu-show")
				}
			});
		});
	});
<!--//-----------MENUR---------------------------------->



	
<!-----------Q&A---------------->
	$(function(){
		// 幫 #qaContent 的 ul 子元素加上 .accordionPart
		// 接著再找出 li 中的第一個 div 子元素加上 .qa_title
		// 並幫其加上 hover 及 click 事件
		// 同時把兄弟元素加上 .qa_content 並隱藏起來
		$('#qaContent ul').addClass('accordionPart').find('li div:nth-child(1)').addClass('qa_title').hover(function(){
			$(this).addClass('qa_title_on');
		}, function(){
			$(this).removeClass('qa_title_on');
		}).click(function(){
			// 當點到標題時，若答案是隱藏時則顯示它，同時隱藏其它已經展開的項目
			// 反之則隱藏
			var $qa_content = $(this).next('div.qa_content');
			if(!$qa_content.is(':visible')){
				$('#qaContent ul li div.qa_content:visible').slideUp();
			}
			$qa_content.slideToggle();
		}).siblings().addClass('qa_content').hide();
	});
<!-----------Q&A---------------->
