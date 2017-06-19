<?php

class modelParabol extends modelFifthLab
{
	public function __construct(float $a, float $b, float $n, callable $func,float $alf = 3.71375)
	{
		parent::__construct($func, $alf);
		$this->result = $this->makeParabol($a, $b, $n);
	}
	private function makeParabol(float $a,float $b,float $N)
	{
		$sum = 0;
		$lPart= 0;
		$rPart= 0;

		$h = ($b - $a) / (2 * $N);

		for ($i = 1; $i <= $N; $i++) $lPart += call_user_func($this->myFunction, $a + 2 * $i * $h - $h);
		for ($i = 1; $i <= $N-1; $i++) $rPart += call_user_func($this->myFunction, $a + 2 * $i * $h);

		$lPart = $lPart * 4;
		$rPart = $rPart * 2;
		$sum += call_user_func($this->myFunction, $a) + call_user_func($this->myFunction, $b) + $lPart + $rPart;

		return [$N, $sum * ($h / 3.0), $this->ARes - $sum * ($h / 3.0)];
	}
}