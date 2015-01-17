<?php
require_once("packages/Slim/Slim.php");
require_once('packages/simplehtmldom_1_5/simple_html_dom.php');
\Slim\Slim::registerAutoloader();
class FCPJobsScrapeMiddleware extends \Slim\Middleware
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
		
		$app->get('/getjoblistings', function () use ($app, $thisclass){
			$thisclass->getscrapefcpjoblistings();
		});
		$app->get('/getjobinfo', function () use ($app, $thisclass){
			//$stmt = $app->db->query("SELECT * FROM jobs");
			//print(json_encode($stmt->fetchAll(PDO::FETCH_CLASS)));
			$thisclass->getscrapefcpjobinfo();
		});
		$app->get('/updatejobdb', function () use ($app, $thisclass){
			$joblistings = $thisclass->getscrapefcpjoblistings();
			$stmt = $app->db->prepare("INSERT INTO jobs (hash, jsondata) VALUES (?,?)");
			$updated = $stmt->execute( array($joblistings["hash"], json_encode($joblistings["jobs"])));
			$res = array("update_successful" => $updated);
			print(json_encode($res));
			//$thisclass->getscrapefcpjobinfo();
		});
		$app->get('/getjobupdateinfofromdb', function () use ($app, $thisclass){
			$stmt = $app->db->query("SELECT created_at AS lastupdated, expires_at AS nextupdate FROM jobs where id = (SELECT MAX(id) FROM jobs)");	
			$arr = $stmt->fetchAll(PDO::FETCH_CLASS);
			$arr[0]->url=$app->scrapeurl;
			
			
			print(json_encode($arr));
		});
		// Gets latest entry from database
		$app->get('/getjobfromdb', function () use ($app, $thisclass){
			$stmt = $app->db->query("SELECT * FROM jobs where id = (SELECT MAX(id) FROM jobs)");	
			$arr = $stmt->fetchAll(PDO::FETCH_CLASS);
			print(json_encode($arr));
		});
		$this->next->call();
    }
	function getscrapefcpjoblistings($request = null){
		
		$html = new simple_html_dom();
		$html->load_file($this->app->scrapeurl);
		$ret = array();
		$hash_string = "";
		foreach($html->find('#jobs_list_table_data > tr') as $article) {
			$item['position_number'] = trim($article->find('td', 0)->plaintext);
			$item['linktodesc'] = "https://talenthire.ceipal.com/".trim($article->find('td > a', 0)->getAttribute("href"));
			$item['title'] = trim($article->find('td', 1)->plaintext);
			$item['employment_type'] = trim($article->find('td', 2)->plaintext);
			$item['city'] = trim($article->find('td', 3)->plaintext);
			$item['state'] = trim($article->find('td', 4)->plaintext);
			$item['detail'] = $this->getscrapefcpjobinfo($item['linktodesc']);
			$hash_string .= $item['position_number'];
		    $ret["jobs"][] = $item;
	    }
		$ret["hash"] = md5($hash_string . $item['detail']['description']);
		$ret["lastupdated_on"] = date("Y-m-d");
		$ret["lastupdated_at"] = time();
		//print(json_encode($ret));
		return $ret;
	}
	function getscrapefcpjobinfo($request = null){
		$html = new simple_html_dom();
		//$html->load_file("https://talenthire.ceipal.com/jobs/jobs_description/d5cfead94f5350c12c322b5b664544c1");
		$html->load_file($request);
		$ret = array();
		$hash_string = "";
		
		$ret["jobnumber"]  = trim($html->find('.search-job-data > .candidate_print > tr > td', 1)->plaintext);
		$ret["postdate"] = trim($html->find('.search-job-data > .candidate_print > tr > td', 3)->plaintext);
		$ret["location"] = trim($html->find('.search-job-data > .candidate_print > tr', 1)->find('td', 1)->plaintext);
		$ret["experience"] = trim($html->find('.search-job-data > .candidate_print > tr', 2)->find('td', 1)->plaintext);
		$ret["requiredskills"] = trim($html->find('.search-job-data > .candidate_print > tr', 3)->find('td', 1)->plaintext);
		$ret["requireddocuments"] = trim($html->find('.search-job-data > .candidate_print > tr', 4)->find('td', 1)->plaintext);
		$ret["description"] = trim($html->find('.search-job-data > .candidate_print > tr', 5)->find('td', 1)->innertext);
		$ret["description"] = strip_tags ( $ret["description"], "<br><p>" );
		$ret["hash"] = md5($hash_string);
		$ret["lastupdated_on"] = date("Y-m-d");
		$ret["lastupdated_at"] = time();
		//print(json_encode($ret));
		return $ret;
	}
	function updatefcpjobinfo($request = null){
		
	}
}
?>