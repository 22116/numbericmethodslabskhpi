<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Data example</h3>
	</div>
	<div class="panel-body">
        <pre class="brush: php;">
        $N = 5000;
		$a = 1;
		$b = 2;
		$function = create_function('$x', 'return 0.5 * exp(sqrt(1 + 2 * $x));');
		$lRec = new modelLeftRectangle($a, $b, $N, $function);
		$rRec = new modelRightRectangle($a, $b, $N, $function);
		$cRec = new modelCentralRectangle($a, $b, $N, $function);
		$newton = [
			(new modelNewtonCates($a, $b, 4, $function))->getResult(),
			(new modelNewtonCates($a, $b, 5, $function))->getResult(),
		];
		$gauss = [
			(new modelGaussIntegral($a, $b, 4, $function))->getResult(),
			(new modelGaussIntegral($a, $b, 5, $function))->getResult(),
			(new modelGaussIntegral($a, $b, 6, $function))->getResult()
		];
		$chebish = [
			(new modelChebishev($a, $b, 4, $function))->getResult(),
			(new modelChebishev($a, $b, 5, $function))->getResult(),
			(new modelChebishev($a, $b, 6, $function))->getResult()
		];
		$trap = new modelTrapeciya($a, $b, $N, $function);
		$parab = new modelParabol($a, $b, $N, $function);
		$this->view->generate(self::$pageNum.'/index', [
			'tabNumber' => self::$pageNum,
			'lRec' => $lRec->getResult(),
			'rRec' => $rRec->getResult(),
			'cRec' => $cRec->getResult(),
			'newton' => $newton,
			'gauss' => $gauss,
			'trap' => $trap->getResult(),
			'parab' => $parab->getResult(),
			'chebish' => $chebish
		]);
        </pre>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Code left rectangles</h3>
	</div>
	<div class="panel-body">
        <pre class="brush: php;">
        $sum = 0;
		$h = ($b - $a) / $N;
		for ($i = $a; $i < $b ; $i += $h) $sum += call_user_func($this->myFunction, $i);

		return [$N, $sum * $h];
        </pre>
	</div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Code right rectangles</h3>
    </div>
    <div class="panel-body">
        <pre class="brush: php;">
        $h = ($b - $a) / $N;
		$sum = 0;
		for ($i = 1; $i<=$N; $i++) $sum += call_user_func($this->myFunction, $a + $i * $h);

		return [$N, $sum * $h];
        </pre>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Code center rectangles</h3>
    </div>
    <div class="panel-body">
        <pre class="brush: php;">
        $sum = 0;
		$h = ($b - $a) / $N;
		for ($i = $a; $i < $b ; $i += $h) $sum += call_user_func($this->myFunction, $i + $h / 2);

		return [$N, $sum * $h];
        </pre>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Code trapeciya</h3>
    </div>
    <div class="panel-body">
        <pre class="brush: php;">
        $sum = 0;
		$h = ($b - $a) / $N;
		for ($i = $a; $i < $b ; $i += $h) $sum += (call_user_func($this->myFunction, $i) + call_user_func($this->myFunction, $i + $h)) * $h / 2;

		return [$N, $sum];
        </pre>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Code parabola</h3>
    </div>
    <div class="panel-body">
        <pre class="brush: php;">
        $sum = 0;
		$lPart= 0;
		$rPart= 0;

		$h = ($b - $a) / (2 * $N);

		for ($i = 1; $i <= $N; $i++) $lPart += call_user_func($this->myFunction, $a + 2 * $i * $h - $h);
		for ($i = 1; $i <= $N-1; $i++) $rPart += call_user_func($this->myFunction, $a + 2 * $i * $h);

		$lPart = $lPart * 4;
		$rPart = $rPart * 2;
		$sum += call_user_func($this->myFunction, $a) + call_user_func($this->myFunction, $b) + $lPart + $rPart;

		return [$N, abs($sum * ($h / 3.0))];
        </pre>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Code Newton Cates</h3>
    </div>
    <div class="panel-body">
        <pre class="brush: php;">
        $result = 0;
		$h = ($b - $a) / $N;

        $H4 = [ 7 / 45, 32 / 45, 12 / 45, 32 / 45, 7 / 45 ];
		$H5 = [ 19 / 144, 75 / 144.0, 50 / 144, 50 / 144, 75 / 144, 19 / 144 ];

		for ($i = 0; $i <= $N; $i++) $result += ${'H'.$N}[$i] * call_user_func($this->myFunction,$a + $i * $h);

		$result *= ($b - $a) / 2;

		return [$N, $result];
        </pre>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Code Chebishev</h3>
    </div>
    <div class="panel-body">
        <pre class="brush: php;">
        $result = 0;

		$x6 = [ -0.866247, -0.422519, -0.266636, 0.266636, 0.422519, 0.866247 ];
		$x5 = [ -0.832498, -0.374541, 0, 0.832498, 0.374541 ];
		$x4 = [ -0.794655, -0.187593, 0.794655, 0.187593 ];

        for ($i = 0; $i < $N; $i++) $result += call_user_func($this->myFunction,($a + $b) / 2 + ($b - $a) / 2 * ${'x'.$N}[$i]);

		$result *= ($b - $a) / $N;

		return [$N, $result];
        </pre>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Code Gauss</h3>
    </div>
    <div class="panel-body">
        <pre class="brush: php;">
        $c4 = [ 0.3478548, 0.6521452, 0.6521452, 0.3478548 ];
		$x4 = [ -0.8611363, -0.3399810, 0.3399810, 0.8611363 ];

		$c5 = [ 0.2369269, 0.4786287, 0.5688888, 0.4786287, 0.2369269 ];
		$x5 = [ -0.9061798, -0.5384693, 0, 0.5384693, 0.9061798 ];

		$c6 = [ 0.1713245, 0.3607616, 0.4679131, 0.4679131, 0.3607616, 0.171345 ];
		$x6 = [ -0.9324695, -0.6612093, -0.2386192, 0.2386192, 0.6612093, 0.9324695 ];
		$result = 0;

		for ($i = 0; $i < $N; $i++) $result += ${'c'.$N}[$i] * call_user_func($this->myFunction, ($a + $b) / 2 + ($b - $a) / 2 * ${'x'.$N}[$i]);

		$result *= ($b - $a) / 2;

		return [$N, $result];
        </pre>
    </div>
</div>
