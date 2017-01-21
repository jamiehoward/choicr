<?php 
	$hourstamp = mktime(0,0,0);	
	$timecount = 0;
	$seconds = -900;
	while ($i < 96)
		{
		$seconds = $seconds + 900;
		$hourMark[$i] = $hourstamp + $seconds;
		$hourChoice[$i] = date("g:i A", $hourMark[$i]);
		echo $hourChoice[$i] . "<br />";
		$timecount = $timecount + 1;		
		}	
?>