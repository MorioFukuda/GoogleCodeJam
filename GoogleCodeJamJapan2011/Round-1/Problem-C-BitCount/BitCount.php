<?php

$fp = fopen('case-small.in', 'r');
$answer = fopen('answer-small.txt', 'w');
$loopLimit = trim(fgets($fp));
$loopCounter = 1;
$loopLimit = 32;

while($loopLimit >= $loopCounter){

	$n = $loopCounter;
	$patterns = array();

	for($i=0; $i<=$n/2; $i++){
		$patterns[] = array($i, $n-$i);
	}

	$maxValue = 0;

	foreach($patterns as $pattern){
		$result = substr_count(decbin($pattern[0]), '1') + substr_count(decbin($pattern[1]), '1');
		$val1 = decbin($pattern[0]);
		$val2 = decbin($pattern[1]);
		if($result > $maxValue){
			$maxValue = $result;
		}
	}

	echo "Case #" . $loopCounter . ": " . $maxValue . "\n";
//	echo "{$pattern[0]}({$val1}),{$pattern[1]}({$val2}) : {$result}\n";
	$loopCounter++;
}
