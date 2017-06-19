<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Data example</h3>
	</div>
	<div class="panel-body">
        <pre class="brush: php;">
        $a = 0;
		$b = 1;
		$n = 16;
		$h = ($b - $a) / $n;
		$ruch = new modelRuch($a, $h, $n);
		$eyler = new modelEyler($a, $h, $n);
		$eylerKoshi = new modelEylerKoshi($a, $h, $n);
		$rungeKute = new modelRungeKute($a, $h, $n);
		$this->view->generate(self::$pageNum.'/index', [
			'tabNumber' => self::$pageNum,
			'ruch' => $ruch->getResult(),
			'eyler' => $eyler->getResult(),
			'eylerKoshi' => $eylerKoshi->getResult(),
			'rungeKute' => $rungeKute->getResult()
		]);
        </pre>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Code Selfmethod</h3>
	</div>
	<div class="panel-body">
        <pre class="brush: php;">
        $x[] = $a;
		$y[] = 1;
		for ($i = 1; $i <= $n; $i++)
		{
			$x[] = $x[0] + $i*$h;
			$y[] = exp(-0.8696*$x[$i])*(0.5458 - 0.5*exp(1.8696*$x[$i]) + 0.9541*exp(2.9393*$x[$i]));
		}
		return [$x, $y];
        </pre>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Code Eyler</h3>
	</div>
	<div class="panel-body">
        <pre class="brush: php;">
        $x[] = $a;
		$y[] = 1.0;
		$z[] = 1.0;
		for ($i = 1; $i <= $n; $i++)
		{
			$x[] = $x[0] + $i*$h;
			$y[] = $y[$i - 1] + $h * $z[$i - 1];
			$z[] = $z[$i - 1] + $h * $this->fz($z[$i - 1], $y[$i - 1], $x[$i - 1]);
		}
		return [$x, $y];
        </pre>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Code EylerKoshi</h3>
	</div>
	<div class="panel-body">
        <pre class="brush: php;">
        $x[] = $a;
		$y[] = 1.0;
		$z[] = 1.0;
		for ($i = 1; $i <= $n; $i++)
		{
			$x[$i] = $x[0] + $i*$h;
			$y1[$i-1] = $y[$i - 1] + $h*$z[$i - 1];
			$z1[$i-1] = $z[$i - 1] + $h*$this->fz($z[$i - 1], $y[$i - 1], $x[$i - 1]);
			$y[$i] = $y[$i - 1]+($h/2.0)*($z[$i - 1]+$z1[$i-1]);
			$z[$i] = $z[$i - 1]+($h/2.0)*($this->fz($z[$i-1],$y[$i-1],$x[$i-1])+$this->fz($z1[$i - 1], $y1[$i - 1], $x[$i - 1]));
		}
		return [$x, $y];
        </pre>
	</div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Code RungeKute</h3>
    </div>
    <div class="panel-body">
        <pre class="brush: php;">
        $x[0] = $a;
		$y[0] = 1.0;
		$z[0] = 1.0;
		for ($i = 1; $i <= $n; $i++)
		{
			$x[$i] = $x[0] + $i*$h;
			$r1 = $h*$z[$i - 1];
			$d1 = $h*$this->fz($z[$i - 1], $y[$i - 1], $x[$i - 1]);
			$r2 = $h*($z[$i - 1] + ($d1 / 2.0));
			$d2 = $h*$this->fz($z[$i - 1] + ($d1 / 2.0), $y[$i - 1] + ($r1 / 2.0), $x[$i - 1] + ($h / 2.0));
			$r3 = $h*($z[$i - 1] + ($d2 / 2.0));
			$d3 = $h*$this->fz($z[$i - 1] + ($d2 / 2.0), $y[$i - 1] + ($r2 / 2.0), $x[$i - 1] + ($h / 2.0));
			$r4 = $h*($z[$i - 1] + $d3);
			$d4 = $h*$this->fz($z[$i-1] + $d3,$y[$i-1] + $r3,$x[$i-1] + $h);
			$y[$i] = $y[$i - 1] + (1 / 6.0)*($r1 + 2 * $r2 + 2 * $r3 + $r4);
			$z[$i] = $z[$i - 1] + (1 / 6.0)*($d1 + 2 * $d2 + 2 * $d3 + $d4);
		}
		return [$x, $y];
        </pre>
    </div>
</div>
