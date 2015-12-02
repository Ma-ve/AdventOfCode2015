<?php

class Present {
	public 	$l = 0,
			$w = 0,
			$h = 0,
			$paper_needed = 0,
			$ribbon_needed = 0;

	public function wrappingNeeded() {
		$lw = $this->l * $this->w;
		$lh = $this->l * $this->h;
		$wh = $this->w * $this->h;

		$this->paper_needed += 2 * $lw;
		$this->paper_needed += 2 * $lh;
		$this->paper_needed += 2 * $wh;
		$this->paper_needed += min([$lw, $lh, $wh]);
	}

	public function ribbonNeeded() {
		$sizes = [$this->l, $this->w, $this->h];
		sort($sizes, SORT_NUMERIC);
		array_pop($sizes);


		$this->ribbon_needed += $sizes[0] + $sizes[0] + $sizes[1] + $sizes[1];
		$this->ribbon_needed += $this->l * $this->w * $this->h;
	}
}


$total_paper_needed = $total_ribbon_needed = 0;

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
	$present->ribbonNeeded();

	$total_paper_needed += $present->paper_needed;
	$total_ribbon_needed += $present->ribbon_needed;

}

echo 'Total amount of paper needed: ' . $total_paper_needed . '<br>';
echo 'Total amount of ribbon needed: ' . $total_ribbon_needed . '<br>';