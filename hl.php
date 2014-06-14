<?php
require_once('workflows.php');
$wf = new Workflows();
date_default_timezone_set('Asia/Tokyo');

function trimAll($str) {
	return str_replace(array("\r\n","\n","\r"), " ", $str);
}

function get_userinfo() {
	$filename = "~/.hatebulist";
	$str = exec('cat '.$filename, $output);
	$userinfo_array = explode(" ", $output[0]);
	return array(
		'user_name' => $userinfo_array[0],
		'api_key' => $userinfo_array[1]
	);
}

$user = get_userinfo();
$user_name = $user['user_name'];
$api_key = $user['api_key'];

#http://d.hatena.ne.jp/i_ogi/20100214/wsse
$url = "http://b.hatena.ne.jp/".$user_name."/search/json?q=".$query."&sort=date&limit=20";
$nonce = md5(mt_rand());
$created = date(DATE_ISO8601);
$x_wsse = sprintf('UsernameToken Username="%s", PasswordDigest="%s", Nonce="%s", Created="%s"',
	  $user_name,
	  base64_encode(sha1($nonce . $created . $api_key, true)),
	  base64_encode($nonce),
	  $created);
$context = stream_context_create(
	     array('http' => array('header' => "X-WSSE: $x_wsse"))
	   );
$file = file_get_contents($url, 0, $context);
$json = json_decode($file);
$dataList = $json;

foreach($dataList->bookmarks as $data) {
	$entry = $data->entry;
	$title = $entry->title;
	$count = $entry->count;
	$snippet = trimAll($entry->snippet);
	$wf_url = $entry->url;
	$wf_title = $title;
	$wf_description = $snippet;
	$wf->result(
		time(),
		$wf_url,
		$wf_title,
		$wf_description,
		'icon.png'
	);
}

echo $wf->toxml();
?>
