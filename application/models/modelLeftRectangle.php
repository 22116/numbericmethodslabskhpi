<?php

class modelLeftRectangle extends modelFifthLab
{
	public function __construct(float $a, float $b, float $n, callable $func,float $alf = 3.71375)
	{
		parent::__construct($func);
		$this->result = $this->leftRec($a, $b, $n);
	}
	private function leftRec(float $a,float $b,float $N)
	{
		$sum = 0;
		$h = ($b - $a) / $N;
		for ($i = $a; $i < $b ; $i += $h) $sum += call_user_func($this->myFunction, $i);

		return [$N, $sum * $h, $this->ARes - ($sum * $h)];
	}
}