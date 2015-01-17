<?php
require_once("packages/Slim/Slim.php");
\Slim\Slim::registerAutoloader();
class WeatherMiddleware extends \Slim\Middleware
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
		$thisclass = &$this;
		$app->get('/getweather', function () use ($app, $thisclass){
			$query = "SELECT * FROM weather";
			$stmt = $app->db->query($query);
			$arr = $stmt->fetchAll(PDO::FETCH_CLASS);
			print(json_encode($arr));
		});
		$app->get('/updateweatherdb', function () use ($app, $thisclass){
			$url = "http://api.wunderground.com/api/69ca9d7ace9be5b9/conditions/q/NY/Rochester.json";
			$weatherjson = file_get_contents($url);
			$query = "INSERT INTO weather (jsondata,hash) VALUES (?,?)";
			$stmt = $app->db->prepare($query);
			$updated = $stmt->execute( array($weatherjson, md5($weatherjson)));
			print(json_encode(array("update_successful" => $updated)));	
		});
		$this->next->call();
    }

	function getWeatherInfoFromWeb(){
		$url = "http://api.wunderground.com/api/69ca9d7ace9be5b9/conditions/q/NY/Rochester.json";
		$jsonData = json_decode(file_get_contents($url));
		return $jsonData;
	}
}
?>