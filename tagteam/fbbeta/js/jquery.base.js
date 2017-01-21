function base(){
	
	$('div.circle').css("behavior","url('./style/PIE.htc')");
	$('div.content').css("behavior","url('./style/PIE.htc')");
	$('input.text').css("behavior","url('../style/PIE.htc')");
	$('div.top-right ul li a').live('click',function(){
		$('div.top-right ul li a').removeClass('active');
		$(this).addClass('active');
	});
	
	if ($.browser.msie && $.browser.version.substr(0,1)<8) {
  // search for selectors you want to add hover behavior to
	  $('div.content').css("behavior","none");
	}
	
	//drop down
	$('div.drop').hide();
	$('div.drop').slideDown();
	$('div.drop a.close').live('click',function(){
		$('div.drop').slideUp();
	});
	
	//colorbox
	$("a.colorbox").colorbox({width:"625px", height:"587px", iframe:true, scrolling: false});

}

function check(){
	$("div.check").click(function(){
		if( $('div.check').hasClass('checked') == true ){
			$('div.check').removeClass('checked');
		}
		else{
			$('div.check').addClass("checked");
			$('div.check input').attr('value', 'yes');
		}
	});
}

function ajax(){
	$("a#about").addClass("int-nav-active");
	$("a#staff").click(function(){
		$("ul.int-nav li a").removeClass("int-nav-active");						 
		$("div.right").hide();
		$("div#staff").fadeIn(500);
		$(this).addClass("int-nav-active");
	});
	$("a#press").click(function(){
		$("ul.int-nav li a").removeClass("int-nav-active");		
		$("div.right").hide();
		$("div#press").fadeIn(500);
		$(this).addClass("int-nav-active");
	});
	$("a#advertising").click(function(){
		$("ul.int-nav li a").removeClass("int-nav-active");		
		$("div.right").hide();
		$("div#advertising").fadeIn(500);
		$(this).addClass("int-nav-active");
	});
	$("a#about").click(function(){
		$("ul.int-nav li a").removeClass("int-nav-active");		
		$("div.right").hide();
		$("div#about").fadeIn(500);
		$(this).addClass("int-nav-active");
	});
}
