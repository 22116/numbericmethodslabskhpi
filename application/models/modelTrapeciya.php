<?php

class modelTrapeciya extends modelFifthLab
{
	public function __construct(float $a, float $b, float $n, callable $func,float $alf = 3.71375)
	{
		parent::__construct($func, $alf);
		$this->result = $this->centralRec($a, $b, $n);
	}
	private function centralRec(float $a,float $b,float $N)
	{
		$sum = 0;
		$h = ($b - $a) / $N;
		for ($i = $a; $i < $b ; $i += $h) $sum += (call_user_func($this->myFunction, $i) + call_user_func($this->myFunction, $i + $h))*$h / 2;

		return [$N, $sum, $this->ARes - $sum];
	}
}