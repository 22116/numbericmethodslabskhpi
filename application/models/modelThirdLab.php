<?php

class modelThirdLab
{
	protected $result;
	protected $f;
	protected $f1;
	protected $f2;

	public function __construct($a, $b, $e, callable $func, callable $func2, callable $func3)
	{
		$this->f = $func;
		$this->f1 = $func2;
		$this->f2 = $func3;
	}
	public function getResult() : array
	{
		return $this->result;
	}
}