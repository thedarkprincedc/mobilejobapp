<?php
ob_start("ob_gzhandler");
require_once("packages/Slim/Slim.php");
require_once("middleware/AppMiddleware.php");
require_once("middleware/FCPJobsScrapeMiddleware.php");
require_once("middleware/WeatherMiddleware.php");
\Slim\Slim::registerAutoloader();

header('Content-Type: application/json');
$app = new \Slim\Slim();
$app->config('debug', true);
$app->add(new \AppMiddleware());
$app->add(new \FCPJobsScrapeMiddleware());
$app->add(new \WeatherMiddleware());
$app->get('/', function () use ($app){
	$app->redirect('pages/index.php');
});
$app->run();
?>