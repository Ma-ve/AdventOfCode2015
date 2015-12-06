<?php

//Copy this file, rename it to day{int}.php

$path = explode("\\", __FILE__);
$file = array_pop($path);
$day = substr(explode(".", $file)[0], 3);


$input = file_get_contents("input/day" . $day . ".txt");

include("test.php");

/**
First half
*/
echo '<h1>Day ' . $day . ' - First half</h1>';

//Business logic

$part1_tests = [
	'aaaa' => true,
];

echo '<h2>Tests:</h2>';
foreach($part1_tests as $k => $v) {
	echo test_input($v, $v, $k);
}


/**
Second half
*/
echo '<h1>Day ' . $day . ' - Second half</h1>';

//Business logic

$part2_tests = [
	'aaaa' => true,
];

echo '<h2>Tests:</h2>';
foreach($part2_tests as $k => $v) {
	echo test_input($v, $v, $k);
}