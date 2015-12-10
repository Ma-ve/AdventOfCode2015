<?php

//Copy this file, rename it to day{int}.php

$path = explode("\\", __FILE__);
$file = array_pop($path);
$day = substr(explode(".", $file)[0], 3);

$input = file_get_contents("input/day" . $day . ".txt");

function lookAndSay($str) {
	return preg_replace_callback('#(.)\1*#', function ($matches) {
		return strlen($matches[0]) . $matches[1];
	}, $str);

}

function doManyTimes($input, $times) {
	echo '00: ' . $input . ' - ' . strlen($input) . '<br>';
	foreach (range(1, $times) as $i) {
		$input = lookAndSay($input);
		echo ($i < 10 ? '0' . $i : $i) . ': ' . substr($input, -100) . (strlen($input) > 100 ? '&hellip;' : '') . ' - ' . strlen($input) . '<br>';
	}

	if ($i === $times) {
		echo '<h4>string length: ' . strlen($input) . '</h4>';
	}
}

/**
First half
 */
echo '<h1>Day ' . $day . ' - First half</h1>';

doManyTimes($input, 40);

/**
Second half
 */
echo '<h1>Day ' . $day . ' - Second half</h1>';

doManyTimes($input, 50);