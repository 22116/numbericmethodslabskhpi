<?php

class modelIteracion extends modelThirdLab
{
	public function __construct($a, $b, $e, callable $func, callable $func2, callable $func3)
	{
		parent::__construct($a, $b, $e, $func, $func2, $func3);
		$this->result = $this->iter($a, $b, $e);
	}

	public function iter(float $a, float $b, float $e)
	{
		$k = 0;
		$y0 =$a;
		$y1 = $this->g($y0,$a,$b);
		while (abs($y1 - $y0) > $e)
		{
			$y0 = $y1;
			$y1 = $this->g($y0,$a,$b);
			$k++;
		}
		return [$k, $y1];
	}

	function findGran(float $a, float $b, bool $isMax)
	{
		while (abs($b - $a) > 0.0001) {
			if (!$isMax ? (call_user_func($this->f1, $b) >= call_user_func($this->f1, $a)) : call_user_func($this->f1, $b) <= call_user_func($this->f1, $a)) $a = $b;
			else $b = $a;
		}
		return ($a + $b) / 2;
	}

	function g(float $x, float $a, float $b)
	{
		$x1 = $this->findGran($a, $b, false);
		$x2 = $this->findGran($a, $b, true);
		$m1 = call_user_func($this->f1, $x1);
		$m2 = call_user_func($this->f1, $x2);
		$l = -2 / ($m1 + $m2);
		return $x + $l * call_user_func($this->f, $x);
	}
}