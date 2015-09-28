//背景位移
function bg()
{
	var minImgW = 1920 ;
	var minImgH = 1080 ;
	winW  = $(window).width() ;
	winH  = $(window).height() ;
	ratio = minImgH / minImgW ;
	if( (winH / winW) > ratio )
	{
		$('#bg img').attr('height', winH ) ;
		$('#bg img').attr('width', winH / ratio ) ;
		bgwidth  = winH / ratio ;
		bgheight = winH ;
	}
	else
	{
		$('#bg img').attr('height', winW * ratio ) ;
		$('#bg img').attr('width', winW ) ;
		bgwidth  = winW ;
		bgheight = winW * ratio ;
	}
	$('#bg img').css('left', ( winW - bgwidth )/2 );
	$('#bg img').css('top',  ( winH - bgheight)/2 );
}
//背景輪播
function bgImg()
{
	$('#bg img').each(function(){
		$total = $('#bg img').size() ;
		if($(this).is(':visible'))
		{
			$nextImg = parseInt($(this).index())+1 ;
			if( parseInt($nextImg) > (parseInt($total)-1) )
			{
				$nextImg = 0 ;
			}
		}
	}) ;
	$('#bg img').each(function(){
		if( parseInt($(this).index()) == $nextImg )
		{
			$(this).fadeIn(3000) ;
		}
		else
		{
			$(this).fadeOut(3000) ;
		}
	}) ;
}



$(window).resize(function() {
	bg() ;
}) ;



$(window).load(function(){
	bg() ;
	$("#bg img:not(:first)").css('display','none');
	var time = 1000 ; 
	var sec = 5 ;
	setInterval("bgImg()",sec*time) ;




	nvH = $(window).height() - 210 ;
	$('.nView .viewport').css({height:nvH}) ;
	


	aboutH = $(window).height() - 410 ;
	$('#Aboutcontenu .viewport').css({height:aboutH}) ;
	
	memberH = $(window).height() - 260 ;
	$('#memberContenu .viewport').css({height:memberH}) ;
	
	

	orderH = $(window).height() - 300 ;
	$('#order .viewport').css({height:orderH}) ;

	
	roomW = $('#roomList .overview li').size() * 300;
	$('#roomList .overview').css({width:roomW}) ;
	
	nvH2 = $(window).height() - 210 ;
	$('.nView2 .viewport').css({height:nvH2}) ;
	
	$('#Newscontenu').tinyscrollbar({
		invertscroll:true 
	});
	$('#Aboutcontenu').tinyscrollbar({
		invertscroll:true 
	});
	$('#roomList').tinyscrollbar({
		invertscroll:true ,
		axis: 'x'
	});
	$('#memberContenu').tinyscrollbar({
		invertscroll:true 
	});
	$('#order').tinyscrollbar({
		invertscroll:true 
	});
	
	
	
}) ;

