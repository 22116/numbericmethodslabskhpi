<?php

class modelRungeKute extends modelSixthLab
{
	public function __construct(float $a, float $h, float $n)
	{
		parent::__construct($a, $h, $n);
		$this->result = $this->eylerRusch($a, $h, $n);
	}
	private function eylerRusch(float $a, float $h, int $n)
	{
		$x[0] = $a;
		$y[0] = 1.0;
		$z[0] = 1.0;
		for ($i = 1; $i <= $n; $i++)
		{
			$x[$i] = $x[0] + $i*$h;
			$r1 = $h*$z[$i - 1];
			$d1 = $h*$this->fz($z[$i - 1], $y[$i - 1], $x[$i - 1]);
			$r2 = $h*($z[$i - 1] + ($d1 / 2.0));
			$d2 = $h*$this->fz($z[$i - 1] + ($d1 / 2.0), $y[$i - 1] + ($r1 / 2.0), $x[$i - 1] + ($h / 2.0));
			$r3 = $h*($z[$i - 1] + ($d2 / 2.0));
			$d3 = $h*$this->fz($z[$i - 1] + ($d2 / 2.0), $y[$i - 1] + ($r2 / 2.0), $x[$i - 1] + ($h / 2.0));
			$r4 = $h*($z[$i - 1] + $d3);
			$d4 = $h*$this->fz($z[$i-1] + $d3,$y[$i-1] + $r3,$x[$i-1] + $h);
			$y[$i] = $y[$i - 1] + (1 / 6.0)*($r1 + 2 * $r2 + 2 * $r3 + $r4);
			$z[$i] = $z[$i - 1] + (1 / 6.0)*($d1 + 2 * $d2 + 2 * $d3 + $d4);
		}
		return [$y[count($y) - 1]];
	}
}