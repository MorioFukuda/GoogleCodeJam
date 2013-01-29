<?php

// Google Code Jam Japan 2011 予選問題A
// http://code.google.com/codejam/contest/889487/dashboard

$fp = fopen('A-large.in', 'r');
$answer = fopen('A-answer.txt', 'w');
$loopLimit = trim(fgets($fp));
$loopCounter = 1;
//$loopLimit = 1;

while($loopLimit >= $loopCounter){

	$case = explode(' ', fgets($fp));
	$m = (int)$case[0];
	$c = (int)$case[1];
	$v = (int)$case[2];

	// 1からM枚のカードを作成する。
	$cards = range(1, $m);
	for($i=0; $i<$c; $i++){
		$shufflePattern = explode(' ', fgets($fp));
		$a = (int)$shufflePattern[0];
		$b = (int)$shufflePattern[1];

		// $a枚目のカードから$b枚のカードをひく
		$pickedCards = array_slice($cards, $a-1, $b);
		// $a枚目のカードから$b枚のカードを削除する
		array_splice($cards, $a-1, $b);
		
		// 取り出したカードを先頭に追加
		$pickedCards = array_reverse($pickedCards);
		foreach($pickedCards as $pickedCard){
			array_unshift($cards, $pickedCard);
		}
	}

	$result = "Case #" . $loopCounter . ": " . $cards[$v-1] . "\n";
	echo $result;
	fwrite($answer, $result);
	$loopCounter++;
}
