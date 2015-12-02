<?php

class Present {
	public $l, $w, $h, $paper_needed = 0;

	public function __construct() {
	}

	public function wrappingNeeded() {
		$lw = $this->l * $this->w;
		$lh = $this->l * $this->h;
		$wh = $this->w * $this->h;

		$this->paper_needed += 2 * $lw;
		$this->paper_needed += 2 * $lh;
		$this->paper_needed += 2 * $wh;
		$this->paper_needed += min([$lw, $lh, $wh]);
	}

}


$total_paper_needed = 0;

$file = file_get_contents("input/day2.txt");
$lines = explode("\n", $file);

foreach($lines as $line) {

	$dimensions = explode("x", $line);
	$l = $dimensions[0];
	$w = $dimensions[1];
	$h = $dimensions[2];
	$present = new Present();
	$present->l = $l;
	$present->w = $w;
	$present->h = $h;

	$present->wrappingNeeded();

	$total_paper_needed += $present->paper_needed;
}

echo $total_paper_needed;