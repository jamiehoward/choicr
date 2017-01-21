$(document).ready(function() {

	$('#decision-summary-counter').textCounter({
				target: '#decision-summary', 
				count: 45, 
				alertAt: 20, 
				warnAt: 10, 
				stopAtLimit: false 
		});
		
	$('#decision-title-counter').textCounter({
				target: '#decision-title', 
				count: 45, 
				alertAt: 20, 
				warnAt: 10, 
				stopAtLimit: false 
		});
		
		$('#decision-description-counter').textCounter({
				target: '#decision-description', 
				count: 45, 
				alertAt: 20, 
				warnAt: 10, 
				stopAtLimit: false 
		});		
});
