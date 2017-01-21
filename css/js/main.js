$(document).ready(function() {
	var col1Height = $(document).height() -63 ;
	$('div#sidebar').css("min-height", col1Height );
	$('div.comments').hide();
	
	$('div.user').click(function() {
		$('div.user div.child').slideToggle("fast");
		$('div.live div.action div.category div.child, div.live div.action div.sort div.child').slideUp();
		return false;
	});
	
	$('div.live div.action div.category').click(function() {
		$(this).find('div.child').slideToggle("fast");
		$('div.user div.child , div.live div.action div.sort div.child').slideUp();
		return false;
	});
	
	$('div.live div.action div.sort').click(function() {
		$(this).find('div.child').slideToggle("fast");
		$('div.user div.child, div.live div.action div.category div.child').slideUp();
		return false;
	});
	
	$('div#content div.games p a.readmore').click(function() {
		$(this).parents().find('div.more').slideDown("1000");
		$(this).hide();
		return false;
	});
	
	$('ul.list1 li a').click(function() {
		$(this).parent().find('a.button1').addClass("active");
		$('div#content div.comments').load('<?=base_url()?>index.php/vote/submit_vote/<?=$post?>/1/1');
        $("div#content div.comments").fadeIn('slow');
		var col1Height = $("div#left-pannel").height() -63 ;
		$('div#sidebar').css("min-height", col1Height );
		return false;
	});
	
	$('div#content div.stats div.inner li a').click(function() {
		$("div#content div.stats div.inner li").removeClass('active');
		$(this).parent().addClass('active');
		$('div#content div.stats .stats-content .stats-inner').removeClass('active');
		$('div#' + $(this).prop("rel")).addClass('active');
		$('div#' + $(this).prop("rel")).slideDown("fast");
		var col1Height =  $('div#' + $(this).prop("rel")).height() + 350; 
		$('div#sidebar').css("min-height", col1Height);
		return false;
	});
	
	$('div#content div.stats ul.list3 li a.arrow').click(function() {
		$("div#content div.stats ul.list3 li").css("z-index", 10);
		$(this).parents("div#content div.stats ul.list3 li").css("z-index", 1000);
		$(this).parents("div#content div.stats ul.list3 li").find("div.readmore").slideToggle("fast");
		var col1Height = $(document).height() -63 ;
		$('div#sidebar').css("min-height", col1Height );
		return false;
	});
	
	$("a.previous-btn").hover(function () {
	    $('a.previous-btn span.name').fadeIn();
  	}, function () {
    	$('a.previous-btn span.name').fadeOut();
  	});
	
	$("a.next-btn").hover(function () {
	    $('a.next-btn span.name').fadeIn('fast');
  	}, function () {
    	$('a.next-btn span.name').fadeOut('fast');
  	});
	
	$(".checkbox").dgStyle();
	
	$('div.comments ul li div.entry a.reply').click(function() {
		$(this).parents('div.comments ul li').find('ul').append('<li class="clearfix"><img src="images/avatar2.gif" alt="avatar" class="css3" /><div class="entry"><span class="textarea css3"><span class="arrow">&nbsp;</span><span class="inner css3"><textarea title="textarea" rows="1" cols="1" class="expand">&nbsp;</textarea></span></span></div></li>');
		$("textarea[class*=expand]").TextAreaExpander();
		var sidebarheight = $("#sidebar").height() +160;
		$("#sidebar").css("min-height" , sidebarheight);
		return false;
	});	
	
	$("a.refresh img").rotate({ 
	   bind: 
    		 { 
        		click: function(){
            		$(this).rotate({ angle:0,animateTo:720,easing: $.easing.easeInOutExpo });
        	}} 
   	  });

});

function leftArrowPressed() {
   alert("Left Arrow Pressed");
}

function rightArrowPressed() {
   alert("Right Arrow Pressed");
}

document.onkeydown = function(evt) {
    evt = evt || window.event;
    switch (evt.keyCode) {
        case 37:
            leftArrowPressed();
            break;
        case 39:
            rightArrowPressed();
            break;
    }
};


