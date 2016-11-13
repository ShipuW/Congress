<?php 
	header('Access-Control-Allow-Origin:*');
	define('MY_KEY','&apikey=f50631fa532e41608c78662065118da7');
	define('SERVER','http://congress.api.sunlightfoundation.com/');
	define('CLONE_SERVER','http://104.198.0.197:8080/');

	function _get($str){
		$val = isset($_GET[$str]) ? $_GET[$str] : null;
		return $val;
	}
	$url = "";
	$main_url = "";
	if(_get("page") == "legislators"){
		if(_get("bill_id")){
			$main_url = SERVER."bills?bill_id="._get("bill_id")."&per_page=1&page=1".MY_KEY;
			$url = CLONE_SERVER."bills?bill_id="._get("bill_id")."&per_page=1&page=1".MY_KEY;
		}else if(_get("bioguide_id")){
			switch (_get('content')) {
				case 'detail':
					$main_url = SERVER."legislators?bioguide_id="._get("bioguide_id").MY_KEY;
					$url = CLONE_SERVER."legislators?bioguide_id="._get("bioguide_id").MY_KEY;
					break;
				case 'bills':
					$main_url = SERVER."bills?sponsor_id="._get("bioguide_id")."&per_page=5&page=1".MY_oKEY;
					$url = CLONE_SERVER."bills?sponsor_id="._get("bioguide_id")."&per_page=5&page=1".MY_oKEY;
					break;
				case 'committees':
					$main_url = SERVER."committees?member_ids="._get("bioguide_id")."&per_page=5&page=1".MY_KEY;
					$url = CLONE_SERVER."committees?member_ids="._get("bioguide_id")."&per_page=5&page=1".MY_KEY;
					break;
				default:
					break;
			}
		}else{
			$main_url = SERVER."legislators?per_page=all".MY_KEY;
			$url = CLONE_SERVER."legislators?per_page=all".MY_KEY;
		}
	}else if(_get("page") == "bills"){
		if(_get("active")=="true"){
			$main_url = SERVER."bills?history.active=true&per_page=50&page=1&last_version.urls.pdf__exists=true".MY_KEY;
			$url = CLONE_SERVER."bills?history.active=true&per_page=50&page=1&last_version.urls.pdf__exists=true".MY_KEY;
		}else if(_get("active")=="false"){
			$main_url = SERVER."bills?history.active=false&per_page=50&page=1&last_version.urls.pdf__exists=true".MY_KEY;
			$url = CLONE_SERVER."bills?history.active=false&per_page=50&page=1&last_version.urls.pdf__exists=true".MY_KEY;
		}else if(_get("bill_id")){
			$main_url = SERVER."bills?bill_id="._get("bill_id")."&per_page=1&page=1".MY_KEY;
			$url = CLONE_SERVER."bills?bill_id="._get("bill_id")."&per_page=1&page=1".MY_KEY;
		}	
	}else if(_get("page") == "committees"){
		if(_get("chamber")=="house"){
			$main_url = SERVER."committees?chamber=house&per_page=all".MY_KEY;
			$url = CLONE_SERVER."committees?chamber=house&per_page=all".MY_KEY;
		}else if(_get("chamber")=="senate"){
			$main_url = SERVER."committees?chamber=senate&per_page=all".MY_KEY;
			$url = CLONE_SERVER."committees?chamber=senate&per_page=all".MY_KEY;
		}else if(_get("chamber")=="joint"){
			$main_url = SERVER."committees?chamber=joint&per_page=all".MY_KEY;
			$url = CLONE_SERVER."committees?chamber=joint&per_page=all".MY_KEY;
		}	
	}else if(_get("page") == "favorites"){
		if(_get("action")=="display"){
			switch (_get('list')) {
				case 'legislators':
					$main_url = SERVER."legislators?bioguide_id="._get("bioguide_id").MY_KEY;
					$url = CLONE_SERVER."legislators?bioguide_id="._get("bioguide_id").MY_KEY;
					break;
				case 'bills':
					$main_url = SERVER."bills?bill_id="._get("bill_id")."&per_page=1&page=1".MY_KEY;
					$url = CLONE_SERVER."bills?bill_id="._get("bill_id")."&per_page=1&page=1".MY_KEY;
					break;
				case 'committees':
					$main_url = SERVER."committees?committee_id="._get("committee_id")."&per_page=5&page=1".MY_KEY;
					$url = CLONE_SERVER."committees?committee_id="._get("committee_id")."&per_page=5&page=1".MY_KEY;
					break;
				default:
					break;
			}
		}else if(_get("action")=="legislator_detail"){
			if(_get("bioguide_id")){
				switch (_get('content')) {
					case 'detail':
						$main_url = SERVER."legislators?bioguide_id="._get("bioguide_id").MY_KEY;
						$url = CLONE_SERVER."legislators?bioguide_id="._get("bioguide_id").MY_KEY;
						break;
					case 'bills':
						$main_url = SERVER."bills?sponsor_id="._get("bioguide_id")."&per_page=5&page=1".MY_oKEY;
						$url = CLONE_SERVER."bills?sponsor_id="._get("bioguide_id")."&per_page=5&page=1".MY_oKEY;
						break;
					case 'committees':
						$main_url = SERVER."committees?member_ids="._get("bioguide_id")."&per_page=5&page=1".MY_KEY;
						$url = CLONE_SERVER."committees?member_ids="._get("bioguide_id")."&per_page=5&page=1".MY_KEY;
						break;
					default:
						break;
				}
			}
		}else if(_get("action")=="bill_detail"){
			$main_url = SERVER."bills?bill_id="._get("bill_id")."&per_page=1&page=1".MY_KEY;
			$url = CLONE_SERVER."bills?bill_id="._get("bill_id")."&per_page=1&page=1".MY_KEY;
		}	
	}
	if($url!=""||$main_url!=""){
		// $json = file_get_contents("http://fdajwog.coiw.com");
		// if(is_null($json)||$json==""){
		$json = file_get_contents($url);
		// }
		echo $json;
	}
	
?>


