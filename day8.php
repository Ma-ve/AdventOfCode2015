<?php

$path = explode("\\", __FILE__);
$file = array_pop($path);
$day = substr(explode(".", $file)[0], 3);


$input = file("input/day" . $day . ".txt");

/**
First half
*/
echo '<h1>Day ' . $day . ' - First half</h1>';

//Business logic

$total_length = 0;
$memory_length = 0;

foreach($input as $line) {
	$line = preg_replace("/\s/", "", $line);

	$total_length += strlen($line);

	$line2 = $line;
	$line2 = str_replace("\\\"", "\"", $line2); //order works for input, not sure if works for all input
	$line2 = str_replace("\\\\", "\\", $line2);
	$line2 = substr($line2, 1);
	$line2 = substr($line2, 0, -1);
	$line2 = preg_replace("/(\\\\x)([a-f0-9]{2}+)/imsx", "U", $line2);

	$memory_length += strlen($line2);
}

echo 'Total length: ' . $total_length . '<br>';
echo 'Memory length: ' . $memory_length. '<br>';
echo 'Answer: ' .($total_length - $memory_length). '<br>';


/**
Second half
*/
echo '<h1>Day ' . $day . ' - Second half</h1>';

//Business logic

$total_length = 0; //6489 
$encoded_length = 0;

foreach($input as $line) {
	$line = preg_replace("/\s/", "", $line); //damn those white spaces

	$encoded_length += 2; //starting and end double quote

	$total_length += strlen($line);

	for($i = 0; $i < strlen($line); $i++) {
		if($line[$i] === '\\' || $line[$i] === '"') { //extra count to escape \ and "
			$encoded_length++;
		}
		$encoded_length++;
	}

}

echo 'Total length: ' . $total_length . '<br>';
echo 'Encoded length: ' . $encoded_length. '<br>';
echo 'Answer: ' .($encoded_length - $total_length). '<br>';