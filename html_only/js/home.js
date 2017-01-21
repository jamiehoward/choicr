$(document).ready(function() {
	$('div.box1').mouseenter(function() {
 		$(this).find('span').fadeOut('slow');
	});
	
	$('div.box1').mouseleave(function() {
  		$(this).find('span').fadeIn('slow');
	});
	
	$("body.home div.logo").hover(function() {
         $(this).find("span").stop(true).animate({ opacity: 1 }, '100');
      }, function () {
         $(this).find("span").animate({ opacity: 0 }, '300');
     });
	 
	 $("a.click-btn").click(function() {
		$(this).parent().toggleClass('active');
  		$('div.login-area').toggle();
	});
	
	$(".checkbox").dgStyle();
});
