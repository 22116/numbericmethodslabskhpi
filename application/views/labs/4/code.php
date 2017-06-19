<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Data example</h3>
    </div>
    <div class="panel-body">
        <pre class="brush: php;">
        $functionG = create_function('$x, $y', 'return 0.3*sin(0.4*$y)+1-$x;');
		$functionF = create_function('$x, $y', 'return 0.3*cos(0.2*$y)-$y;');

		$x = 1;
		$y = 1;
		$e = 0.00001;
		$newton = new modelNewtoneSystem($x, $y, $e, $functionG, $functionF);
		$iter = new modelterSystem($x, $y, $e, $functionG, $functionF);
		$this->view->generate(self::$pageNum.'/index', [
			'tabNumber' => self::$pageNum,
			'newton' => $newton->getResult(),
			'iter' => $iter->getResult()
		]);
        </pre>
    </div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Help functions</h3>
	</div>
	<div class="panel-body">
        <pre class="brush: php;">
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
        </pre>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Code Newton</h3>
	</div>
	<div class="panel-body">
        <pre class="brush: php;">
        private function newtone(float $x0, float $y0, float $e) : array
        {
            $count = 0;
            $x = $x0 - $this->wx($x0, $y0) / $this->w($x0, $y0);
            $y = $y0 - $this->wy($x0, $y0) / $this->w($x0, $y0);
            while (abs($x - $x0) >= $e && abs($y - $y0) >= $e)
            {
                $count++;
                $x0 = $x;
                $y0 = $y;
                $x = $x0 - $this->wx($x0, $y0) / $this->w($x0, $y0);
                $y = $y0 - $this->wy($x0, $y0) / $this->w($x0, $y0);
            }
            return [$count, $x, $y];
        }
        </pre>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Code Iter</h3>
	</div>
	<div class="panel-body">
        <pre class="brush: php;">
        private function iter(float $x0, float $y0, float $e) : array
        {
            $det = $this->w($x0, $y0);
            $a = -$this->gy($x0, $y0) / $det;
            $b = $this->fy($x0, $y0) / $det;
            $c = $this->gx($x0, $y0) / $det;
            $d = -$this->fy($x0, $y0) / $det;

            $count = 0;
            $x = $y = 0;
            do {
                $x0 = $x;
                $y0 = $y;
                $count++;
                $x = $x0 + $a * call_user_func($this->f, $x0, $y0) + $b * call_user_func($this->g, $x0, $y0);
                $y = $y0 + $c * call_user_func($this->f, $x0, $y0) + $d * call_user_func($this->g, $x0, $y0);
            } while (abs($x - $x0) >= $e || abs($y - $y0) >= $e);
            return [$count, $x, $y];
        }
        </pre>
	</div>
</div>