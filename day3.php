<?php

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

function cmp($a, $b) {
    if ($a == $b) {
        return 0;
    }
    return ($a < $b) ? 1 : -1;
}


echo 'Unique houses visited: ' . count($visited_houses) . '<br>';
echo 'Houses visited, by most visited:<br>';
uasort($visited_houses, 'cmp');
echo '<pre>';
print_r($visited_houses);
