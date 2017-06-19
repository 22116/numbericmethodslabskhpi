<?php

class modelSixthLab
{
	protected $result;
	protected $a;
	protected $h;
	protected $n;

	public function __construct($a, $h, $n)
	{
		//TODO: smth...
	}
	public function getResult()
	{
		return $this->result;
	}
	protected function fz(float $z, float $y, float $x)
	{
		return 1.2 * $z + 1.8 * $y + exp($x);
	}
}