<?php

class modelNewtonCates extends modelFifthLab
{
	public function __construct(float $a, float $b, float $n, callable $func,float $alf = 3.71375)
	{
		parent::__construct($func, $alf);
		$this->result = $this->getNewtonCates($a, $b, $n);
	}
	private function getNewtonCates(float $a,float $b,float $N)
	{
		$result = 0;
		$h = ($b - $a) / $N;

		$H4 = [ 7 / 45, 32 / 45, 12 / 45, 32 / 45, 7 / 45 ];
		$H5 = [ 19 / 144, 75 / 144, 50 / 144, 50 / 144, 75 / 144, 19 / 144 ];

		for ($i = 0; $i <= $N; $i++) if(isset(${'H'.$N})) $result += ${'H'.$N}[$i] * call_user_func($this->myFunction,$a + $i * $h);
		$result *= ($b - $a) / 2;

		return [$N, $result, $this->ARes - $result];
	}
}