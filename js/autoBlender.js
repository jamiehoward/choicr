function showNumberPosts(postCount) {
	$('#autoBlendPostCount').slideUp('slow');//slide it up if it's there already
	$('#autoBlendPostCount').remove();//get rid of it if it's there already
	var showNumElement = "\
	<div class=\"listing\" id=\"autoBlendPostCount\" style=\"display: none; text-align: center; padding: 16px;\"> \
		<div class=\"text\"> \
			<p>"+postCount+" new posts have been added since you have last time you refreshed - <a href='#' class='loadNewPostsLink'>click here</a> to load them</p> \
		</div> \
		<div class=\"clear\"></div> \
	</div>";
	
	$('.listing').first().before(showNumElement);//Insert before the first listing in the DOM
	$('#autoBlendPostCount').slideDown('slow');//slide it down
}

function loadUpNewPosts(newPosts) {
	$('#autoBlendPostCount').slideUp('slow');//slide it up if it's there already
	$('#autoBlendPostCount').remove();//get rid of it if it's there already
	
	$('.listing').first().before(newPosts);//Insert before the first listing in the DOM
	$('.autoloadBlenderPosts').first().hide().slideDown('slow');//slide it down
}
		
function autoBlend() {
	
	$.ajax({
		type: "POST",
		url: "/home/index.php",
		data: "ajax=1&countOnly=1&sort="+sortIs+"&lastLoad="+autoBlendLastLoad,
		success: function(msg) {
			var msgResults = msg.split('|');
			if(msgResults[0]>0 && msgResults[0]!=autoBlendLastAmount) {//Only do something if the count is greater than 0
				showNumberPosts(msgResults[0]);
				//autoBlendLastLoad = msgResults[1];//reset autoBlendLastLoad with the new PHP $nowForAutoBlender value on AJAX success
				autoBlendLastAmount = msgResults[0];
			}//end if
		blenderCheck();
		}
	});

}

function blenderCheck() {

	setTimeout(function() {
		autoBlend();
	},timeUntilAutoBlender);

}

$(function() {		
		blenderCheck();
		$('a.loadNewPostsLink').live('click', function() {
		
			$.ajax({
				type: "POST",
				url: "/home/index.php",
				data: "ajax=1&getNewPosts=1&sort="+sortIs+"&lastLoad="+autoBlendLastLoad,
				success: function(msg) {
					var msgResults = msg.split('|||');
					loadUpNewPosts(msgResults[0]);
					autoBlendLastLoad = msgResults[1];//reset autoBlendLastLoad with the new PHP $nowForAutoBlender value on AJAX success
				}
			});
			
			return false;
			
		});
});