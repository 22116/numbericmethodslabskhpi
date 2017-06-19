<?php

class modelHord extends modelThirdLab
{
	public function __construct($a, $b, $e, callable $func, callable $func2, callable $func3)
	{
		parent::__construct($a, $b, $e, $func, $func2, $func3);
		$this->result = $this->hord($a, $b, $e);
	}

	public function hord(float $a, float $b, float $e)
	{
		$i = 0;
		if (call_user_func($this->f, $a) * call_user_func($this->f2, $a) > 0)
		{
			$x[0] = $b;
			do
			{
				$i++;
				if ($i == 1) $x[$i] = $x[0] - ($x[0] - $a) * (call_user_func($this->f, $x[0]) / (call_user_func($this->f, $x[0]) - call_user_func($this->f, $a)));
				else $x[$i] = $x[$i - 1] - ($x[$i - 1] - $a) * (call_user_func($this->f, $x[$i - 1]) / (call_user_func($this->f, $x[$i-1]) - call_user_func($this->f, $a)));
			}
			while (abs($x[$i] - $x[$i-1]) > $e);
		}
		else
		{
			$x[0] = $a;
			do
			{
				$i++;
				if($i == 1) $x[$i] = $x[0] - ($b - $x[0]) * (call_user_func($this->f, $x[0]) / (call_user_func($this->f, $b) - call_user_func($this->f, $x[0])));
				else $x[$i] = $x[$i-1] - ($b - $x[$i-1]) * (call_user_func($this->f, $x[$i-1]) / (call_user_func($this->f, $b) - call_user_func($this->f, $x[$i - 1])));
			}
			while (abs($x[$i] - $x[$i-1]) > $e);
		}
		return [$i, $x[$i]];
	}
}