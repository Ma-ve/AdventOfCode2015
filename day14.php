<?php

//Copy this file, rename it to day{int}.php

$path = explode("\\", __FILE__);
$file = array_pop($path);
$day = substr(explode(".", $file)[0], 3);

$input = file("input/day" . $day . ".txt");

$race_duration = 2503; //in seconds

/**
First half
 */
echo '<h1>Day ' . $day . ' - First half</h1>';

$reindeers = [];
foreach ($input as $line) {
	preg_match("/([a-zA-Z]+) can fly ([0-9]+) km\/s for ([0-9]+) seconds, but then must rest for ([0-9]+) seconds./", $line, $matches);
	list(, $reindeer, $speed, $duration, $rest) = $matches;
	$reindeers[$reindeer] = ['speed' => $speed, 'duration' => $duration, 'rest' => $rest];
}

foreach ($reindeers as $name => $r) {
	$travelled = 0;
	$round = $r['duration'] + $r['rest'];
	echo $name . '<br>';

	$j = 0;
	for ($i = $round; $i < $race_duration; $i += $round) {
		$j++;
		$travelled += $r['duration'] * $r['speed'];
		echo 'After ' . $i . ' seconds: travelled ' . $travelled . ' km (' . $j * $r['duration'] . 's of flying, ' . $j * $r['rest'] . 's of resting)<br>';

	}
	if ($race_duration % $round > 0) {
		echo 'Remainder : ' . $race_duration % $round . '<br>';
		$remainder = $race_duration % $round > $r['duration'] ? $r['duration'] : $race_duration % $round;
		$travelled += $remainder * $r['speed'];
		echo $travelled;
	}

	$result[$name] = $travelled;
	echo '<br>';
}

echo '<pre>';
print_r($result);
print_r($reindeers);

/**
Second half
 */
echo '<h1>Day ' . $day . ' - Second half</h1>';

//Business logic
