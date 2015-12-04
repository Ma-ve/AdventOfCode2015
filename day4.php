<?php

$input = file_get_contents("input/day4.txt");

function find_leading_zeroes($input, $zeroes = 5) {
	$time = microtime(true);
	$match_zeroes = "";
	for($i = 0; $i < $zeroes; $i++) {
		$match_zeroes .= "0";
	}

	$i = 0;
	while(true) {
		$i++;
		if(strpos(md5($input . $i), $match_zeroes) === 0) {
			return ['time' => round(microtime(true) - $time, 6), 'i' => $i];
		}
	}
}

/**
First half
*/
echo '<h1>Day 4 - First half</h1>';
$output = find_leading_zeroes($input);
echo 'Starting with 5 zeroes: ' . $output['i'] . ' (' . $output['time'] . 's)';

/**
Second half
*/
echo '<h1>Day 4 - Second half</h1>';
$output = find_leading_zeroes($input, 6);
echo 'Starting with 6 zeroes: ' . $output['i'] . ' (' . $output['time'] . 's)';