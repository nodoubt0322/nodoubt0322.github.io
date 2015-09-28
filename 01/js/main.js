 

 $(function(){
    slick();
    fixCart(); 
    banner();

 })

 function slick(){
    $('#hot-product').slick({
  		centerMode: true,
  		centerPadding: '10px',
  		slidesToShow: 4,
      autoplay:true
	  });
    $('.slick-prev').hide();
    $('.slick-next').hide();
    $('#hot-product').mouseover(function(){
      $('.slick-prev').show();
      $('.slick-next').show();
    })
    $('#hot-product').mouseout(function(){
      $('.slick-prev').hide();
      $('.slick-next').hide();
    })
 }

function banner(){
  $('#banner').slick({
    arrows:false,
    dots:true,
    autoplay:true
  });
}

 function hotProduct(hot){
    var htmlList="";
    var tmpl = $('#tmpl-hot').html();  
    hot.forEach(function(object) {
	   htmlList += tmpl.template(object);		    
	});
    $('#hotContent').html(htmlList);
 }

 function fixCart(){
 	$(window).scroll(function(){            
        $("#cart-shortcut").stop().animate({top:($(window).scrollTop()+300)+"px"}, 300, 'swing');
     });
 }
