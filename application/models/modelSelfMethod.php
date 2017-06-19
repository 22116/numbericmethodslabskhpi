<?php

class modelSelfMethod extends modelSixthLab
{
	public function __construct($a, $h, $n)
	{
		parent::__construct($a, $h, $n);
		$this->result = $this->selfMethod($a, $h, $n);
	}
	private function selfMethod(float $a, float $h, int $n)
	{
		$x[] = $a;
		$y[] = 1;
		for ($i = 1; $i <= $n; $i++)
		{
			$x[] = $x[0] + $i*$h;
			$y[] = exp(-0.8696*$x[$i])*(0.5458 - 0.5*exp(1.8696*$x[$i]) + 0.9541*exp(2.9393*$x[$i]));
		}
		return [$y[count($y) - 1]];
	}
}