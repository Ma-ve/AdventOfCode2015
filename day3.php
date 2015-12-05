<?php

//Compare function for array sorting
function cmp($a, $b) {
    if ($a == $b) {
        return 0;
    }
    return ($a < $b) ? 1 : -1;
}

/**
First half
*/
echo '<h1>Day 3 - First half</h1>';
$directions = [
	'^' => 0,
	'>' => 0,
];

$visited_houses = ['0,0' => 1];

$file = file_get_contents("input/day3.txt");

for($i = 0; $i < strlen($file); $i++) {
	$content = $file[$i];
	switch($content) {
		case "^": $directions['^']++; break;
		case ">": $directions['>']++; break;
		case "v": $directions['^']--; break;
		case "<": $directions['>']--; break;
	}

	$coords = implode(',', $directions);
	$visited_houses[$coords] = isset($visited_houses[$coords]) ? $visited_houses[$coords] + 1 : 1;
}


echo 'Unique houses visited: ' . count($visited_houses) . '<br>';
echo 'Top 30 houses visited, by most visited:<br>';
uasort($visited_houses, 'cmp');
echo '<pre>';
print_r(array_slice($visited_houses, 0, 30));
echo '</pre>';

/**
Second half
*/

echo '<h1>Day 3 - Second half</h1>';
$directions['santa'] = $directions['robo_santa'] = [
	'^' => 0,
	'>' => 0,
];

$visited_houses = ['0,0' => 1];

$file = file_get_contents("input/day3.txt");

for($i = 0; $i < strlen($file); $i++) {
	switch($i % 2) {
		case 0: $person = 'santa'; break;
		case 1: $person = 'robo_santa'; break;
	}

	$content = $file[$i];
	switch($content) {
		case "^": $directions[$person]['^']++; break;
		case ">": $directions[$person]['>']++; break;
		case "v": $directions[$person]['^']--; break;
		case "<": $directions[$person]['>']--; break;
	}

	$coords = implode(',', $directions[$person]);
	$visited_houses[$coords] = isset($visited_houses[$coords]) ? $visited_houses[$coords] + 1 : 1;
}


echo 'Unique houses visited: ' . count($visited_houses) . '<br>';
echo 'Top 30 houses visited, by most visited:<br>';
uasort($visited_houses, 'cmp');
echo '<pre>';
print_r(array_slice($visited_houses, 0, 30));
echo '</pre>';