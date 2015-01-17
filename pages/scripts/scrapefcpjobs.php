<?php
error_reporting(E_ALL);
include_once('libs/simplehtmldom_1_5/simple_html_dom.php');

class ScrapeFcpJobs{
	function __construct(){
		$html = new simple_html_dom();
		$html->load_file();
		$ret = array();
		$hash_string = "";
		foreach($html->find('#jobs_list_table_data > tr') as $article) {
			$item['position_number'] = trim($article->find('td', 0)->plaintext);
			$item['linktodesc'] = "http://talenthire.ceipal.com/".trim($article->find('td > a', 0)->getAttribute("href"));
			$item['title'] = trim($article->find('td', 1)->plaintext);
			$item['employment_type'] = trim($article->find('td', 2)->plaintext);
			$item['city'] = trim($article->find('td', 3)->plaintext);
			$item['state'] = trim($article->find('td', 4)->plaintext);
			
			$item['hash'] = md5($item['position_number'] . $item['title'] . $item['city'] . $item['state']);
	      	$hash_string .= $item['hash'];
		    $ret["jobs"][] = $item;
	    }
		$ret["hash"] = md5($hash_string);
		$ret["lastupdated_on"] = date("Y-m-d");
		$ret["lastupdated_at"] = time();
		print(json_encode($ret));
		//$element = $html->find("p"));
		//$html = file_get_html('https://talenthire.ceipal.com/Jobs/career/8f14e45fceea167a5a36dedd4bea2543');
		//echo $html->save();
	}
	function scrape(){
		
	}
}
?>