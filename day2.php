<?php

class Present {
	public $l, $w, $h, $paper_needed = 0;

	public function __construct() {
	}

	public function wrappingNeeded() {
		$this->paper_needed += (2 * ($this->l * $this->w));
		$this->paper_needed += (2 * ($this->w * $this->h));
		$this->paper_needed += (2 * ($this->l * $this->h));
		$this->paper_needed += min([$this->l, $this->w, $this->h]);
	}

}


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
	
	echo $present->paper_needed; exit();
}