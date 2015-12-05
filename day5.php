<?php

$path = explode("\\", __FILE__);
$file = array_pop($path);
$day = substr(explode(".", $file)[0], 3);


$input = file_get_contents("input/day" . $day . ".txt");

include("test.php");

/**
First half
*/
echo '<h1>Day ' . $day . ' - First half</h1>';

function contains($haystack, $needles = []) {
	if(preg_match('/(' . implode('|', $needles) . ')/', $haystack)) {
		return true;
	}

	return false;
}

function vowels($haystack, $vowels = []) {
	$regex = '[' . implode('', $vowels) . ']';
	if(preg_match('/' . $regex . '.*' . $regex .'.*' . $regex . '/', $haystack)) {
		return true;
	}

	return false;
}

function part_1($line) {
	global $not_contains, $vowels;

	if(contains($line, $not_contains)) {
		return false;
	}

	if(!vowels($line, $vowels)) {
		return false;
	}

	if(!preg_match('/([a-z])\1{1,}/', $line)) {
		return false;
	}

	return true;
}

$nice = $naughty = 0;

$not_contains = [
	'ab',
	'cd',
	'pq',
	'xy'
];

$vowels = [
	'a',
	'e',
	'i',
	'o',
	'u'
];

$time = microtime(true);

foreach(explode("\n", $input) as $line) {
	if(part_1($line)) {
		$nice++;
		continue;
	}

	$naughty++;
}

echo 'Nice: ' . $nice . '<br>';
echo 'Naughty: ' . $naughty . '<br>';
echo 'Time: ' . round(microtime(true) - $time, 6) . 's';

$part1_tests = [
	'ugknbfddgicrmopn' => true,
	'aaa' => true,
	'jchzalrnumimnmhp' => false,
	'haegwjzuvuyypxyu' => false,
	'dvszwmarrgswjxmb' => false,
];

echo '<h2>Tests:</h2>';
foreach($part1_tests as $k => $v) {
	echo test_input(part_1($k), $v, $k);
}


/**
Second half
*/
echo '<h1>Day ' . $day . ' - First half</h1>';

function part_2($line) {
	/**
	Check for repeating letter with exactly one letter in between them (xyx, acdefeghi (efe), aaa)
	*/
	$potential_nice = 0;

	for($i = 2; $i < strlen($line); $i++) {
		if($line[$i] === $line[$i - 2]) {
			$potential_nice++;
		}
	}

	if($potential_nice === 0) {
		return false;
	}

	/**
	Pair of any two letters (xyxy, aabcdefgaa) without overlap, so no (aaa)
	*/
	$potential_nice = 0;

	for($i = 1; $i < strlen($line); $i++) {
		if(substr_count($line, $line[$i-1] . $line[$i]) > 1) {
			$potential_nice++;
		}
	}

	if($potential_nice === 0) {
		return false;
	}

	return true;
}


$nice = $naughty = 0;

foreach(explode("\n", $input) as $line) {
	if(part_2($line)) {
		$nice++;
		continue;
	}

	$naughty++;
}


echo 'Nice: ' . $nice . '<br>';
echo 'Naughty: ' . $naughty . '<br>';
echo 'Time: ' . round(microtime(true) - $time, 6) . 's';

$part2_tests = [
	'qjhvhtzxzqqjkmpb' => true,
	'xxyxx' => true,
	'uurcxstgmygtbstg' => false,
	'ieodomkazucvgmuy' => false,
	'aaa' => false,
	'aaaa' => true,
];

echo '<h2>Tests:</h2>';
foreach($part2_tests as $k => $v) {
	echo test_input(part_2($k), $v, $k);
}