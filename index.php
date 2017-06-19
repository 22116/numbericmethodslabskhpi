<?php
define('debug', true);
define('APP_PATH', __DIR__. DIRECTORY_SEPARATOR);

if(defined('debug')) ini_set('display_errors', true);
require_once 'application/bootstrap.php';

App::setParams([
	'template' => 'numericalDefault',
	'defaultController' => 'labs',
	'defaultAction' => 'index',
	'title' => 'Numerical Method'
]);

Route::start();