<?php

// Google Code Jam 2011 練習問題A
// http://code.google.com/codejam/contest/1343486/dashboard#s=p0

$fp = fopen('case-large.in', 'r');
$answer = fopen('answer-large.txt', 'w');
$loopLimit = trim(fgets($fp));
$loopCounter = 1;

while($loopLimit >= $loopCounter){
	$case = explode(' ', fgets($fp));
	$n = (int)$case[0];
	$k = (int)$case[1];

	// k = x * 2^n - 1であれば光る
	// ➡　(k + 1) / 2^nの結果が整数なら光る
	$status = (is_int(($k+1) / pow(2, $n))) ? 'ON' : 'OFF';
	$result = 'Case #' . $loopCounter . ': ' . $status . "\n";
	fwrite($answer, $result);

	$loopCounter++;
}
