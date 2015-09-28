$(document).ready(function(){
	$('.banner').slick({
		dots: true,
  		infinite: true,
  		arrows: true,
  		autoplay : true
	});
	$('.category_banner').slick({
		dots: true,
  		infinite: true,
  		arrows: true,
  		autoplay : true
	});	

	var header_class = $('.privacy_container header').attr('class');
	$('.privacy_container header').css('background-image','url("images/'+header_class+'-title.jpg")'); 
	$(window).scroll(function() {
	    if ($(this).scrollTop() > 963) {
	        $('.promo + .menu').addClass('fixed');
	        $('.category').css('padding-top','80px');
	    }else{
	    	$('.promo + .menu').removeClass('fixed');
	    	$('.category').css('padding-top','0px');
	    }

	    if ($(this).scrollTop() > 437) {
	        $('.menu:first-child').addClass('fixed');
	        $('.category').css('padding-top','80px');
	    }else{
	    	$('.menu:first-child').removeClass('fixed');
	    	$('.category').css('padding-top','0px');
	    }

	});
	$('.tab div').click(function(){
		$('.tab div').removeClass('active');
		$('.tab_content div').removeClass('active');
		$('.normal_content, .company_content').removeClass('active');
		$('.'+$(this).attr('class')+'_content').addClass('active');
		$(this).addClass('active');

	})
	$('.thumb img').click(function(){
		$('.main_image img').attr('src', $(this).attr('src') );
	})

    $('.promote_container .tab li').click(function(){
    	$('.promote_container .tab li').removeClass('active');
    	$(this).addClass('active');
    	var i;
    	$.map($('.promote_container .tab li'),function(value,index){
    		if($(value).hasClass('active')){
    			i = index;
    		}
    	})
    	$('.promote_container .promo_content').removeClass('active');
    	$('.promote_container .promo_content').eq(i).addClass('active');
    })

	var step = 1,
		page = $('.page'),
		pay_method = $('#pay_method_container'),
		buyer_info = $('#buyer_info_container'),
		order_completed = $('#order_completed_container');

	
	buyer_info.hide();
	order_completed.hide();

	$('.step .next').click(function(){
		switch (step) {
			case 1:
				page.hide();
				buyer_info.show();
				$('.order_process > div').removeClass('active');
				$('.buyer_info').addClass('active');
				$('.step .prev').text('上一步');
				step++;
				break;
			case 2:
				page.hide();
				order_completed.show();
				$('.order_process > div').removeClass('active');
				$('.order_completed').addClass('active');
				$('.step .next').text('確認');
				step++;
				break;
			case 3:
				alert('訂單送出');
				break;				
		}
	})
	$('.step .prev').click(function(){
		switch (step) {
			case 1:
				location.href = 'index.html';
				break;
			case 2:
				page.hide();
				pay_method.show();
				$('.order_process > div').removeClass('active');
				$('.pay_method').addClass('active');
				$('.step .next').text('下一步');
				$('.step .prev').text('繼續選購');
				step--;
				break;
			case 3:
				page.hide();
				buyer_info.show();
				$('.order_process > div').removeClass('active');
				$('.buyer_info').addClass('active');
				$('.step .next').text('下一步');
				$('.step .prev').text('上一步');
				step--;
				break;				
		}
	})
	$('.del_button').click(function(){
		$(this).parents('.order_cell').remove();
	})
	$('.num select').on('change',function(){
		var price = $(this).parents('.order_cell').find('.price').text();
		var num = $(this).val();
		var total = price * num;
		var sum = 0;
		$(this).parents('.order_cell').find('.total').text(total);
		$('.order_cell .total').map(function(){
			sum = sum + Number($(this).text());
		})
		sum = sum + Number($('.transport_fee').text());
		$('#sum').text(sum);
	})
	

	
})

	var Date_time = 1439359320000;
	clock();
	$('#confirm').click(function(){
	  Date_time = $('#date')[0].valueAsNumber + $('#time')[0].valueAsNumber - (8*60*60*1000);
	  console.log(Date_time);
	  clock()
	});
	var DIFFERENCE_HOUR, DIFFERENCE_MINUTE, DIFFERENCE_SEC =1; 
	    var hoursms = 60 * 60 * 1000;    
	    var Secondms = 60 * 1000;      
	    var microsecond = 100;

	function clock(){
	      var Expiration_time = new Date(Date_time);
	      var time = new Date();
	      var mill = time.getMilliseconds();
	      var minute = time.getMinutes();
	      var second = time.getSeconds();
	      var convertHour = DIFFERENCE_HOUR;
	      var convertMinute = DIFFERENCE_MINUTE;
	      var convertSecond = DIFFERENCE_SEC;
	      var Diffms = Expiration_time.getTime() - time.getTime();
	      DIFFERENCE_MINUTE = Math.floor(Diffms / hoursms);
	      Diffms -= DIFFERENCE_MINUTE * hoursms;
	      DIFFERENCE_SEC = Math.floor(Diffms / Secondms);
	      Diffms -= DIFFERENCE_SEC * Secondms  ;

	      if(convertMinute != DIFFERENCE_MINUTE){
	        $('.ho').text(DIFFERENCE_MINUTE+"小時");
	      }
	      if(convertSecond != DIFFERENCE_SEC){
	         $('.min').text(DIFFERENCE_SEC+"分");
	        }
	      var dSecs = Math.floor(Diffms / microsecond);
	      dSec = (dSecs/10).toFixed(1);
	      $('.sec').text(dSec+"秒");  
	      setTimeout("clock()",100);
	}	