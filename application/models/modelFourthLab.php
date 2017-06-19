<?php

class modelFourthLab
{
	protected $result;
	protected $g;
	protected $f;
	public function __construct(callable $g, callable $f)
	{
		$this->f = $f;
		$this->g = $g;
	}
	public function getResult()
	{
		return $this->result;
	}
	protected function fx(float $x, float $y)
	{
		return 0;
	}
	protected function fy(float $x, float $y)
	{
		return -0.06*sin(0.2*$y)-1;
	}
	protected function gx(float $x, float $y)
	{
		return -1;
	}
	protected function gy(float $x, float $y)
	{
		return 0.12*cos(0.4*$x);
	}
	protected function w(float $x, float $y)
	{
		return $this->fx($x, $y)*$this->gy($x, $y) - $this->fy($x, $y)*$this->gx($x, $y);
	}
	protected function wx(float $x, float $y)
	{
		return call_user_func($this->f, $x, $y)*$this->gy($x, $y) - call_user_func($this->g, $x, $y) * $this->fy($x, $y);
	}
	protected function wy(float $x, float $y)
	{
		return $this->fx($x, $y)*call_user_func($this->g, $x, $y) - $this->gx($x, $y)*call_user_func($this->f, $x, $y);
	}
}