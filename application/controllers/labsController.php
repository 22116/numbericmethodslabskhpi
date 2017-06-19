<?php

class labsController extends Controller
{
	static $pageNum;
	public function behaviorBefore()
	{
		$num = explode('/', $_SERVER['REQUEST_URI']);
		self::$pageNum = isset($num[2]) && !empty($num[2]) && is_numeric($num[2]) ? $num[2] : 1;
		if (isset($_GET['code']))
		{
			$this->view->generate(self::$pageNum.'/code', [
				'isCode' => '/labs/'.self::$pageNum.'/',
				'tabNumber' => self::$pageNum
			]);
			die();
		}
	}

	function actionIndex()
	{
		$this->action1();
	}
	function action1()
	{
		$data = isset($_REQUEST['x']) && isset($_REQUEST['y']) && isset($_REQUEST['p'])? [
			'x' => $_REQUEST['x'],
			'y' => $_REQUEST['y'],
			'p' => $_REQUEST['p']
		] : [
			'x' => [ 0, 10.4/4, 10.4/2, 0.75*10.4, 10.4],
			'y' => [ 10.7, -13.7, -5.5, -1.8, 9.5],
			'p' => [ 10.4/8, 10.4/4 + 10.4/8, 10.4/2 + 10.4/8, 0.75*10.4 + 10.4/8, 10.4 + 10.4/8]
		];

		$lagrange = (new modelLagrange($data))->getResult();
		$gauss = (new modelGauss($data))->getResult();
		$newton = (new modelNewton($data))->getResult();

		$this->view->generate(self::$pageNum.'/index', [
			'lagrange' => $lagrange,
			'gauss' => $gauss,
			'newton' => $newton,
			'params' => $data,
			'tabNumber' => self::$pageNum
		]);
	}
	function action2()
	{
		$data = [
			[ 18.1,29.2 ],
			[ 15.1,36.0 ],
			[ 15.5,33.3 ],
			[ 17.9,16.6 ],
			[ 29.3,35.1 ],
			[ 38.4,44.2 ],
			[ 16.8, 9.4 ],
			[ 34.1,35.7 ],
			[ 10.0,24.2 ],
			[ 23.6,24.8 ]
		];

		$this->view->generate(self::$pageNum.'/index', [
			'tabNumber' => self::$pageNum,
			'dataBefore' => json_encode($data),
			'dataAfter' => json_encode((new modelAproximal($data))->Calculate())
		]);
	}
	function action3()
	{
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

		$c = -1;
		$d = 0;

		$halfDiv1 = new modelHalfDiv($c, $d, $e, $function1, $function2, $function3);
		$hord1 = new modelHord($c, $d, $e, $function1, $function2, $function3);
		$kas1 = new modelKasatel($c, $d, $e, $function1, $function2, $function3);
		$komb1 = new modelKombinational($c, $d, $e, $function1, $function2, $function3);
		$iter1 = new modelIteracion($c, $d, $e, $function1, $function2, $function3);

		$this->view->generate(self::$pageNum.'/index', [
			'tabNumber' => self::$pageNum,
			'halfDiv' => array_merge($halfDiv->getResult(), $halfDiv1->getResult()),
			'hord' => array_merge($hord->getResult(),$hord1->getResult()),
			'kas' => array_merge($kas->getResult(),$kas1->getResult()),
			'komb' => array_merge($komb->getResult(),$komb1->getResult()),
			'iter' => array_merge($iter->getResult(), $iter1->getResult())
		]);
	}
	function action4()
	{
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
	}
	function action5()
	{
		$N = 5000;
		$a = 1;
		$b = 2;
		$analitic = 3.71375;
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
			'analitic' => $analitic,
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
	}
	function action6()
	{
		$a = 0;
		$b = 1;
		$n = 1000;
		$h = ($b - $a) / $n;
		$ruch = new modelSelfMethod($a, $h, $n);
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
	}
	function action7()
	{
		$N = 10000;
		$a = 0;
		$b = M_PI;
		$function1 = $this->createIdzFunc(0.3);
		$function2 = $this->createIdzFunc(1.2);
		$analitics = [ 0, 1.14556 ];
		$this->view->generate(self::$pageNum.'/index', [
			'tabNumber' => self::$pageNum,
			'fRes' => [
				0 => (new modelCentralRectangle($a, $b, $N, $function1, $analitics[0]))->getResult()[1],
				1 => (new modelTrapeciya($a, $b, $N, $function1, $analitics[0]))->getResult()[1],
				2 => (new modelParabol($a, $b, $N, $function1, $analitics[0]))->getResult()[1]
			],
			'sRes' => [
				0 => (new modelCentralRectangle($a, $b, $N, $function2, $analitics[1]))->getResult()[1],
				1 => (new modelTrapeciya($a, $b, $N, $function2, $analitics[1]))->getResult()[1],
				2 => (new modelParabol($a, $b, $N, $function2, $analitics[1]))->getResult()[1]
			],
			'fInfelicity' => [
				0 => (new modelCentralRectangle($a, $b, $N, $function1, $analitics[0]))->getResult()[2],
				1 => (new modelTrapeciya($a, $b, $N, $function1, $analitics[0]))->getResult()[2],
				2 => (new modelParabol($a, $b, $N, $function1, $analitics[0]))->getResult()[2]
			],
			'sInfelicity' => [
				0 => (new modelCentralRectangle($a, $b, $N, $function2, $analitics[1]))->getResult()[2],
				1 => (new modelTrapeciya($a, $b, $N, $function2, $analitics[1]))->getResult()[2],
				2 => (new modelParabol($a, $b, $N, $function2, $analitics[1]))->getResult()[2]
			],
		]);
	}
	function action8()
	{
		$data = [
			'p' => [2]
		];

		$a = -2;
		$b = 2;
		$N = 7;
		$function = create_function('$x', 'return exp(-pow($x,2))-2;');

		$N -= 1;
		for($i=0, $inter=$a; $i < $N; $i++, $inter += (abs($a) + abs($b)) / $N)
		{
			$data['x'][] = $inter;
			$data['y'][] = call_user_func($function, $inter);
		}
		$data['x'][] = $b;
		$data['y'][] = call_user_func($function, $b);

		$N = 1000;
		$a = -0.5;
		$b = -2;
		$function1 = create_function('$x', 'return (1-pow($x,2))*pow((1+pow($x,2)),-1);');
		$analitics = [ 0.212998 ];
		$this->view->generate(self::$pageNum.'/index', [
			'tabNumber' => self::$pageNum,
			'fRes' => [
				0 => (new modelCentralRectangle($a, $b, $N, $function1, $analitics[0]))->getResult()[1],
				2 => (new modelParabol($a, $b, $N, $function1, $analitics[0]))->getResult()[1]
			],
			'fInfelicity' => [
				0 => (new modelCentralRectangle($a, $b, $N, $function1, $analitics[0]))->getResult()[2],
				2 => (new modelParabol($a, $b, $N, $function1, $analitics[0]))->getResult()[2]
			],
			'polinom' => (new modelLagrange($data))->getResult(),
			'polinomString' => modelLagrange::getStringPolinom($data),
			'params' => $data
		]);
	}
	function createIdzFunc(float $alf) : callable
	{
		return create_function('$x', "return (log(1 - (2 * {$alf} * cos(\$x)) + pow({$alf}, 2)));");
	}
}