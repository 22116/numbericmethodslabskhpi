<?php

class modelRightRectangle extends modelFifthLab
{
	public function __construct(float $a, float $b, float $n, callable $func,float $alf = 3.71375)
	{
		parent::__construct($func, $alf);
		$this->result = $this->rightRec($a, $b, $n);
	}
	private function rightRec(float $a,float $b,float $N)
	{
		$h = ($b - $a) / $N;
		$sum = 0;
		for ($i = 1; $i<=$N; $i++) $sum += call_user_func($this->myFunction, $a + $i * $h);

		return [$N, $sum * $h, $this->ARes -  $sum * $h];
	}
}