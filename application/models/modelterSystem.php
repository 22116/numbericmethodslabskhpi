<?php

class modelterSystem extends modelFourthLab
{
	public function __construct(float $x, float $y, float $e, callable $g, callable $f)
	{
		parent::__construct($g, $f);
		$this->result = $this->iter($x, $y, $e);
	}
	private function iter(float $x0, float $y0, float $e) : array
	{
		$det = $this->w($x0, $y0);
		$a = -$this->gy($x0, $y0) / $det;
		$b = $this->fy($x0, $y0) / $det;
		$c = $this->gx($x0, $y0) / $det;
		$d = -$this->fy($x0, $y0) / $det;

		$count = 0;
		$x = $y = 0;
		do {
			$x0 = $x;
			$y0 = $y;
			$count++;
			$x = $x0 + $a * call_user_func($this->f, $x0, $y0) + $b * call_user_func($this->g, $x0, $y0);
			$y = $y0 + $c * call_user_func($this->f, $x0, $y0) + $d * call_user_func($this->g, $x0, $y0);
		} while (abs($x - $x0) >= $e || abs($y - $y0) >= $e);
		return [$count, $x, $y];
	}
}