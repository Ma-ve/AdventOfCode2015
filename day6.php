<?php

// ini_set('memory_limit', '256M');

if(!isset($_GET['part'])) {
	echo '<h1><a href="?part=1">Part 1</a></h1>';
	echo '<h1><a href="?part=2">Part 2</a></h1>';
	echo '<h1><a href="?part=both">Both (memory intensive)</a></h1>';
} else {
	echo '<h6><a href="?">Return</a></h6>';
}

$_GET['part'] = isset($_GET['part']) ? $_GET['part'] : false;

if($_GET['part'] == 'both') {
	ini_set('memory_limit', '256M');
}

$path = explode("\\", __FILE__);
$file = array_pop($path);
$day = substr(explode(".", $file)[0], 3);

$input = file_get_contents("input/day" . $day . ".txt");

include("test.php");

/*
General use vars, for both parts
*/

preg_match_all('/([0-9,]+)/', $input, $matches);
$matches = reset($matches);

$possibilities = ['on', 'off', 'toggle'];

/**
Reset grid to work with
@param int $size - Size of grid (1000 = 1000*1000 grid)
@param mixed $reset_value (default: false) - Default value of grid
*/
function reset_grid($size, $reset_value = false) {
	$grid = [];
	for($i = 0; $i < $size; $i++) {
		for ($j = 0; $j < $size; $j++) {
			$grid[$i][$j] = $reset_value;
		}
	}

	return $grid;
}


if($_GET['part'] == 1 || $_GET['part'] == 'both') {

	/**
	First half
	*/
	echo '<h1>Day ' . $day . ' - First half</h1>';

	//Business logic

	$time = microtime(true);

	/**
	@param string $type - (on|off|toggle)
	@param array $start - Start positions ([0] = x, [1] = y)
	@param array $end - End positions ([0] = x, [1] = y)
	*/
	function modify_grid_part_1($type, $start, $end) {
		global $grid, $matches;

		for($i = $start[0]; $i <= $end[0]; $i++) {
			for($j = $start[1]; $j <= $end[1]; $j++) {
				$grid[$i][$j] = ($type == 'on' ? true : ($type == 'off' ? false : !$grid[$i][$j]));
			}
		}
	}

	/**
	@param array $grid - Grid of 1000*1000 lights
	*/
	function return_active($grid) {
		$active = 0;
		foreach($grid as $line) {
			foreach($line as $column) {
				if($column) {
					$active++;
				}
			}
		}

		return $active;
	}

	$grid = reset_grid(1000);

	$i = 0;
	foreach(explode("\n", $input) as $line) {
		foreach($possibilities as $p) {
			if(strpos($line, $p) !== false) {
				$start = explode(',', $matches[2 * $i]);
				$end = explode(',', $matches[(2 * $i) + 1]);
				modify_grid_part_1($p, $start, $end);
			}
		}
		$i++;
	}

	echo 'Lights that are on: ' . return_active($grid) . '<br>';
	echo 'Time: ' . round(microtime(true) - $time, 6) . 's';
}




if($_GET['part'] == 2 || $_GET['part'] == 'both') {
	/**
	Second half
	*/
	echo '<h1>Day ' . $day . ' - Second half</h1>';

	//Business logic

	$time = microtime(true);

	/**
	@param string $type - (on|off|toggle)
	@param array $start - Start positions ([0] = x, [1] = y)
	@param array $end - End positions ([0] = x, [1] = y)
	*/
	function modify_grid_part_2($type, $start, $end) {
		global $grid, $matches;

		for($i = $start[0]; $i <= $end[0]; $i++) {
			for($j = $start[1]; $j <= $end[1]; $j++) {
				switch($type) {
					case 'on':
						$grid[$i][$j]++;
						break;
					case 'off':
						$grid[$i][$j] = --$grid[$i][$j] < 0 ? 0 : $grid[$i][$j];
						break;
					case 'toggle':
						$grid[$i][$j] += 2;
						break;
				}
			}
		}
	}

	/**
	@param array $grid - Grid of 1000*1000 lights
	*/
	function return_brightness($grid) {
		$brightness = 0;
		foreach($grid as $line) {
			foreach($line as $column) {
				if($column) {
					$brightness += $column;
				}
			}
		}

		return $brightness;
	}

	$grid = reset_grid(1000, 0); //Brightness mode

	$i = 0;

	foreach(explode("\n", $input) as $line) {
		foreach($possibilities as $p) {
			if(strpos($line, $p) !== false) {
				$start = explode(',', $matches[2 * $i]);
				$end = explode(',', $matches[(2 * $i) + 1]);
				modify_grid_part_2($p, $start, $end);
			}
		}
		$i++;
	}

	echo 'Total brightness of all lights: ' . return_brightness($grid) . '<br>';
	echo 'Time: ' . round(microtime(true) - $time, 6) . 's';
}