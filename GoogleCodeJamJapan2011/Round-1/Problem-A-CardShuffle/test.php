<?php

$cards = range(1, 10);
echo implode(' ', $cards) . "\n";

$pickedCards = array_slice($cards, 3, 4);
var_dump($pickedCards);
echo implode(' ', $cards) . "\n";

array_splice($cards, 3, 4);
echo implode(' ', $cards) . "\n";

$pickedCards = array_reverse($pickedCards);
foreach($pickedCards as $card){
	array_unshift($cards, $card);
}

echo implode(' ', $cards) . "\n";

