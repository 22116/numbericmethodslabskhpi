<?php

class modelNewtoneSystem extends modelFourthLab
{
	public function __construct(float $x, float $y, float $e, callable $g, callable $f)
	{
		parent::__construct($g, $f);
		$this->result = $this->newtone($x, $y, $e);
	}
	private function newtone(float $x0, float $y0, float $e) : array
	{
		$count = 0;
		$x = $x0 - $this->wx($x0, $y0) / $this->w($x0, $y0);
		$y = $y0 - $this->wy($x0, $y0) / $this->w($x0, $y0);
		while (abs($x - $x0) >= $e || abs($y - $y0) >= $e)
		{
			$count++;
			$x0 = $x;
			$y0 = $y;
			$x = $x0 - $this->wx($x0, $y0) / $this->w($x0, $y0);
			$y = $y0 - $this->wy($x0, $y0) / $this->w($x0, $y0);
		}
		return [$count, $x, $y];
	}
}