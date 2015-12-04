<?php

$input = file_get_contents("input/day4.txt");

function find_leading_zeroes($input, $zeroes = 5) {
	$match_zeroes = "";
	for($i = 0; $i < $zeroes; $i++) {
		$match_zeroes .= "0";
	}

	$i = 0;
	while(true) {
		$i++;
		if(strpos(md5($input . $i), $match_zeroes) === 0) {
			return $i;
		}
	}
}

/**
First half
*/
echo '<h1>Day 4 - First half</h1>';
echo 'Starting with 5 zeroes: ' . find_leading_zeroes($input);

/**
Second half
*/
echo '<h1>Day 4 - Second half</h1>';
echo 'Starting with 6 zeroes: ' . find_leading_zeroes($input, 6);