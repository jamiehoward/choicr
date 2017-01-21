<?php
	function GetTimeDiff ($timestamp)
	{
		$now = time();
		$then = strtotime($timestamp); 
		$diff = $then - $now;
		
		//$weeks = floor($diff / (60*60*24*7)); 
		//$diff = $diff - ($weeks * (60*60*24*7)); 
		$days = floor($diff / (60*60*24)); 
		$diff = $diff - ($days * (60*60*24)); 
		$hours = floor($diff / (60*60)); 
		$diff = $diff - ($hours * (60*60)); 
		$minutes = floor($diff / 60); 
		$diff = $diff - ($minutes * 60); 
		$secs = $diff; 

		$out = ''; 
		//if($weeks > 0) 
		//$out .= $weeks . 'w'; 
		if($days > 0) 
			$out .= $days . 'd'; 
		if($hours > 0) 
			$out .= $hours . 'h'; 
		if($minutes > 0) 
			$out .= $minutes . 'm'; 
		//if($secs > 0) 
		//$out .= $secs . 's'; 
		
		if ($then < $now)
			{
			$out = "EXPIRED";
			}
		return $out; 	
	}
	
?>