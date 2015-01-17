<?php
require_once("packages/Slim/Slim.php");
\Slim\Slim::registerAutoloader();
class AppMiddleware extends \Slim\Middleware
{
    public function call()
    {
        //The Slim application
        $app = $this->app;

        //The Environment object
        $env = &$app->environment;

        //The Request object
        $req = $app->request;

        //The Response object
        $res = $app->response;
		$iniinfo = parse_ini_file("configuration.ini");
		$app->scrapeurl = $iniinfo["scrapeurl"];
		$app->container->singleton('db', function () use ($app) {
    		return new PDO("sqlite:db.jobapp.sdb");
		});
		$this->next->call();
    }
}
?>