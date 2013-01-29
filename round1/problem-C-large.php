<?php

// Google Code Jam Japan 2011 予選問題C
// http://code.google.com/codejam/contest/889487/dashboard#s=p2

$fp = fopen('C-large.in', 'r');
$answer = fopen('C-answer.txt', 'w');
$loopLimit = trim(fgets($fp));
$loopCounter = 1;

while($loopLimit >= $loopCounter){

	$n = trim(fgets($fp));

	$pow = 0;
	while(pow(2, $pow+1)-1 <= $n){
		$pow++;
	}

	$result =  $pow +  substr_count(decbin($n-(pow(2, $pow)-1)), '1');

	$finalAnswer =  "Case #" . $loopCounter . ": " . $result . "\n";
	fwrite($answer, $finalAnswer);

	$loopCounter++;
}
