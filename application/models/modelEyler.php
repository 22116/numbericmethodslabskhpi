<?php

class modelEyler extends modelSixthLab
{
	public function __construct(float $a, float $h, float $n)
	{
		parent::__construct($a, $h, $n);
		$this->result = $this->getEyler($a, $h, $n);
	}
	private function getEyler(float $a, float $h, int $n)
	{
		$x[] = $a;
		$y[] = 1.0;
		$z[] = 1.0;
		for ($i = 1; $i <= $n; $i++)
		{
			$x[] = $x[0] + $i * $h;
			$y[] = $y[$i - 1] + $h * $z[$i - 1];
			$z[] = $z[$i - 1] + $h * $this->fz($z[$i - 1], $y[$i - 1], $x[$i - 1]);
		}
		return [ $y[count($y) - 1] ];
	}
}