<?php

$path = explode("\\", __FILE__);
$file = array_pop($path);
$day = substr(explode(".", $file)[0], 3);

$input = file("input/day" . $day . ".txt");

/**
@param array $input - Array of strings, to see who gains what by sitting next to a certain person
 */
function processInput($input) {
	foreach ($input as $line) {
		preg_match("/([a-zA-Z]+) would ([a-z]+) ([0-9]+) happiness units by sitting next to ([a-zA-Z]+)/", $line, $matches);
		list(, $one, $change, $happiness, $two) = $matches;
		$table[substr($one, 0, 1)][substr($two, 0, 1)] = ($change == 'gain' ? '+' : '-') . $happiness;
	}

	return $table;
}

/**
@param int $happiness - Happiness until then
@param string $input - A string in the format of: +20, or -40
 */
function happiness($happiness, $input) {
	if (strpos($input, '+') !== false) {
		return $happiness + (int) substr($input, 1);
	} else {
		return $happiness - (int) substr($input, 1);
	}
}

/**
@param array $array - Array of all possible combinations
 */
function permute($array) {
	if (1 === count($array)) {
		return $array;
	}

	$result = array();
	foreach ($array as $key => $item) {
		foreach (permute(array_diff_key($array, array($key => $item))) as $p) {
			$result[] = $item . $p;
		}
	}

	return $result;
}

function returnHappiness($input) {
	$table = processInput($input);
	$results = [];
	$combinations = permute(array_keys($table));

	foreach ($combinations as $c) {
		$happiness = 0;
		for ($i = 0; $i < strlen($c); $i++) {
			$personA = $c[$i];
			$personB = ($i === strlen($c) - 1 ? $c[0] : $c[$i + 1]);
			$happiness = happiness($happiness, $table[$personA][$personB]);
			$happiness = happiness($happiness, $table[$personB][$personA]);
		}

		// echo $c . ': ' . $happiness . '<br>';
		$results[] = $happiness;
	}

	return $results;
}

/**
First half
 */
echo '<h1>Day ' . $day . ' - First half</h1>';

$time = microtime(true);

$results = returnHappiness($input);

echo '<h4>' . max($results) . '</h4>';
echo round(microtime(true) - $time, 6) . 's';

/**
Second half
 */
echo '<h1>Day ' . $day . ' - Second half</h1>';

$time = microtime(true);

$new_input = $input;

$table = processInput($new_input);

foreach (array_keys($table) as $t) {
	$new_input[] = $t . ' would gain 0 happiness units by sitting next to Wesley.';
	$new_input[] = 'Wesley would gain 0 happiness units by sitting next to ' . $t . '.';
}

$results = returnHappiness($new_input);

echo '<h4>' . max($results) . '</h4>';
echo round(microtime(true) - $time, 6) . 's';
