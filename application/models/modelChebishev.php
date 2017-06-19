<?php

class modelChebishev extends modelFifthLab
{
	public function __construct(float $a, float $b, float $n, callable $func, float $alf = 3.71375)
	{
		parent::__construct($func, $alf);
		$this->result = $this->getChebishev($a, $b, $n);
	}
	private function getChebishev(float $a, float $b, float $N)
	{
		$result = 0;

		$x6 = [ -0.866247, -0.422519, -0.266636, 0.266636, 0.422519, 0.866247 ];
		$x5 = [ -0.832498, -0.374541, 0, 0.832498, 0.374541 ];
		$x4 = [ -0.794655, -0.187593, 0.794655, 0.187593 ];

		for ($i = 0; $i < $N; $i++) if(isset(${'x'.$N})) $result += call_user_func($this->myFunction,($a + $b) / 2 + ($b - $a) / 2 * ${'x'.$N}[$i]);
		$result *= ($b - $a) / $N;

		return [$N, $result, $this->ARes - $result];
	}
}