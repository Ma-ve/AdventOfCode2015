<?php

$path = explode("\\", __FILE__);
$file = array_pop($path);
$day = substr(explode(".", $file)[0], 3);

$input = file_get_contents("input/day" . $day . ".txt");

/**
First half
 */
echo '<h1>Day ' . $day . ' - First half</h1>';

//Business logic

$result = 0;

function process_array($input, $echo = false) {
	global $result;

	if (is_array($input) || is_object($input)) {
		foreach ($input as $k => $d) {
			process_array($d);
		}
	} elseif (is_numeric($input)) {
		$result += $input;
		if ($echo) {
			echo $result . '<br>';
		}

	}
}

$json = json_decode($input);

process_array($json);

echo '<h4>' . $result . '</h4>';

/**
Second half
 */
echo '<h1>Day ' . $day . ' - Second half</h1>';

//Business logic
