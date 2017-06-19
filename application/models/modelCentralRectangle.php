<?php

class modelCentralRectangle extends modelFifthLab
{
	public function __construct(float $a, float $b, float $n, callable $func, float $alf = 3.71375)
	{
		parent::__construct($func, $alf);
		$this->result = $this->centralRec($a, $b, $n);
	}
	private function centralRec(float $a,float $b,float $N)
	{
		$sum = 0;
		$h = abs($b - $a) / $N;
		list($min, $max) = [min($a, $b), max($a, $b)];
		for ($i = $min; $i < $max ; $i += $h) {
			$sum += call_user_func($this->myFunction, $i + $h / 2);
		}
		return [$N, abs($sum * $h), $this->ARes - abs($sum * $h)];
	}
}