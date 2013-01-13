<?php

// 問題
//

$fp = fopen('Robot-small.in', 'r');
$answer = fopen('Robot-answer.txt', 'w');
$loopLimit = trim(fgets($fp));
$loopCounter = 1;

while($loopLimit >= $loopCounter){

	$case = trim(fgets($fp), "\n");
	$orderList = array();

	$orderData = explode(' ', $case);
	array_shift($orderData);	// 最初の命令回数は必要ないので削除
	$turnList = array();			// ボタンを押すロボットの順番を格納
	$orangePosList = array();	// オレンジが押すボタンの位置のリスト
	$bluePosList = array();						// ブルーが押すボタンの位置のリスト

	for($i=0, $limit=count($orderData); $i<$limit; $i+=2){
		$turnList[] = $orderData[$i];
		if($orderData[$i] === 'O') $orangePosList[] = (int)$orderData[$i+1];
		if($orderData[$i] === 'B') $bluePosList[] = (int)$orderData[$i+1];
	}

	$time = 0;
	$orangePos = 1;
	$bluePos = 1;
	$orangeNextPos = array_shift($orangePosList);
	$blueNextPos = array_shift($bluePosList);
	$turn = array_shift($turnList);

	while($turn !== NULL){

		// Aがボタンを押した時に、Bが既に次のボタンの位置にいて、Aと同じタイミングでボタンを押してしまわないためのフラグ
		$isPushed = false;

		if($orangePos !== $orangeNextPos){
			if($orangePos < $orangeNextPos) $orangePos++;
			if($orangePos > $orangeNextPos) $orangePos--;
		}else{
			if($turn === 'O'){
				$turn = array_shift($turnList);
				$orangeNextPos = array_shift($orangePosList);
				$isPushed = true;
			}
		}

		if($bluePos !== $blueNextPos){
			if($bluePos < $blueNextPos) $bluePos++;
			if($bluePos > $blueNextPos) $bluePos--;
		}else{
			if($turn === 'B' && $isPushed === false){
				$turn = array_shift($turnList);
				$blueNextPos = array_shift($bluePosList);
			}
		}

	//	echo implode(' ', $turnList) . "\n";
		$time++;
	}

	echo "Case #" . $loopCounter . ": " . $time . "\n";

	$loopCounter++;
}
