<?php

$floor = 0;

$string = file_get_contents("input/day1.txt");

for($i = 0; $i < strlen($string); $i++) {
	if($string[$i] === "(") {
		$floor++;
	} else {
		$floor--;
	}

	if($floor === -1) {
		echo 'Entered basement at ' . $i + 1 . '<br>'; //i starts at 0, but the first entry is 1
	}
}

echo 'Ended up at floor ' . $floor;