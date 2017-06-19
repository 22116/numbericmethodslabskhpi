<?php

class modelEylerKoshi extends modelSixthLab
{
	public function __construct(float $a, float $h, float $n)
	{
		parent::__construct($a, $h, $n);
		$this->result = $this->eylerRusch($a, $h, $n);
	}
	private function eylerRusch(float $a, float $h, int $n)
	{
		$x[] = $a;
		$y[] = 1.0;
		$z[] = 1.0;
		for ($i = 1; $i <= $n; $i++)
		{
			$x[$i] = $x[0] + $i*$h;
			$y1[$i-1] = $y[$i - 1] + $h*$z[$i - 1];
			$z1[$i-1] = $z[$i - 1] + $h*$this->fz($z[$i - 1], $y[$i - 1], $x[$i - 1]);
			$y[$i] = $y[$i - 1]+($h/2.0)*($z[$i - 1]+$z1[$i-1]);
			$z[$i] = $z[$i - 1]+($h/2.0)*($this->fz($z[$i-1],$y[$i-1],$x[$i-1])+$this->fz($z1[$i - 1], $y1[$i - 1], $x[$i - 1]));
		}
		return [$y[count($y) - 1]];
	}
}