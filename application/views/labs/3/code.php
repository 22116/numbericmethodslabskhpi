<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Data example</h3>
    </div>
    <div class="panel-body">
        <pre class="brush: php;">
        $function1 = create_function('$x', 'return pow($x,4) - 3 * $x - 3;');
		$function2 = create_function('$x', 'return 4 * pow($x, 3) - 3;');
		$function3 = create_function('$x', 'return 12 * pow($x, 2);');
		$a = 1;
		$b = 2;
		$e = 0.00001;

		$halfDiv = new modelHalfDiv($a, $b, $e, $function1, $function2, $function3);
		$hord = new modelHord($a, $b, $e, $function1, $function2, $function3);
		$kas = new modelKasatel($a, $b, $e, $function1, $function2, $function3);
		$komb = new modelKombinational($a, $b, $e, $function1, $function2, $function3);
		$iter = new modelIteracion($a, $b, $e, $function1, $function2, $function3);

		$this->view->generate(self::$pageNum.'/index', [
			'tabNumber' => self::$pageNum,
			'halfDiv' => $halfDiv->getResult(),
			'hord' => $hord->getResult(),
			'kas' => $kas->getResult(),
			'komb' => $komb->getResult(),
			'iter' => $iter->getResult()
		]);
        </pre>
    </div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Code Hord</h3>
	</div>
	<div class="panel-body">
        <pre class="brush: php;">
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
        </pre>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Code HalfDiv</h3>
	</div>
	<div class="panel-body">
        <pre class="brush: php;">
        $counter = 0;
		while (abs($b - $a) > $e)
		{
			$c = ($a + $b) / 2;

			if (call_user_func($this->f, $b) * call_user_func($this->f, $c) < 0)
				$a = $c;
			else
				$b = $c;

			$counter++;
		}
		return [$counter, ($a + $b) / 2];
        </pre>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Code Kasatel</h3>
	</div>
	<div class="panel-body">
        <pre class="brush: php;">
        if (call_user_func($this->f, $a) * call_user_func($this->f2, $a) > 0)
			$c = $a;
		else $c = $b;
		$niter = 0;
		$d = $c - call_user_func($this->f, $c) / call_user_func($this->f1, $c);
		while (abs($d - $c) > $e)
		{
			$c = $d;
			$d = $c - call_user_func($this->f, $c) / call_user_func($this->f1, $c);
			$niter++;
		}

		return [$niter, $d];
        </pre>
	</div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Code Combination</h3>
    </div>
    <div class="panel-body">
        <pre class="brush: php;">
        $niter = 0;
		$a0 = $a;
		$b0 = $b;
		while (abs($b - $a) > $e)
		{
			if (call_user_func($this->f1, $a)*call_user_func($this->f2, $a) > 0)
			{
				$a = $a0 - call_user_func($this->f, $a0) * ($b0 - $a0) / (call_user_func($this->f, $b0) - call_user_func($this->f, $a0));
				$b = $b0 - call_user_func($this->f, $b0) / call_user_func($this->f1, $b0);
			}
			else
			{
				$a = $a0 - call_user_func($this->f, $a0) / call_user_func($this->f1, $a0);
				$b = $b0 - call_user_func($this->f, $b0) * ($b0 - $a0) / (call_user_func($this->f, $b0) - call_user_func($this->f, $a0));
			}
			$a0 = $a;
			$b0 = $b;
			$niter++;
		}
		return [$niter, ($a + $b) / 2.0];
        </pre>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Code Iteration</h3>
    </div>
    <div class="panel-body">
        <pre class="brush: php;">
        class modelIteracion extends modelThirdLab
        {
            private static $GR;
            public function __construct($a, $b, $e, callable $func, callable $func2, callable $func3)
            {
                modelIteracion::$GR = (1 + sqrt(5)) / 2;
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
                while (abs($b - $a) > 0.0001)
                {
                    if (!$isMax ? (call_user_func($this->f1, $b) >= call_user_func($this->f1, $a)) :
                        call_user_func($this->f1, $b) <= call_user_func($this->f1, $a)) $a = $b;
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
        </pre>
    </div>
</div>