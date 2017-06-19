<?php

class modelGaussIntegral extends modelFifthLab
{
	public function __construct(float $a, float $b, float $n, callable $func,float $alf = 3.71375)
	{
		parent::__construct($func, $alf);
		$this->result = $this->getGauss($a, $b, $n);
	}
	private function getGauss(float $a, float $b, float $N)
	{
		$result = 0;

		$c4 = [ 0.3478548, 0.6521452, 0.6521452, 0.3478548 ]; // коэфициенты
		$x4 = [ -0.8611363, -0.3399810, 0.3399810, 0.8611363 ]; // узлы

		$c5 = [ 0.2369269, 0.4786287, 0.5688888, 0.4786287, 0.2369269 ];
		$x5 = [ -0.9061798, -0.5384693, 0, 0.5384693, 0.9061798 ];

		$c6 = [ 0.1713245, 0.3607616, 0.4679131, 0.4679131, 0.3607616, 0.171345 ];
		$x6 = [ -0.9324695, -0.6612093, -0.2386192, 0.2386192, 0.6612093, 0.9324695 ];

		for ($i = 0; $i < $N; $i++) if(isset(${'c'.$N}) && isset(${'x'.$N})) $result += ${'c'.$N}[$i] * call_user_func($this->myFunction, ($a + $b) / 2 + ($b - $a) / 2 * ${'x'.$N}[$i]);

		$result *= ($b - $a) / 2;

		return [$N, $result, $this->ARes - $result];
	}
}