<?php 	
		
	include '../Libs/Curl.php';
	include '../Libs/Token.php';

	$url = 'https://api.weixin.qq.com/cgi-bin/tags/members/batchuntagging?access_token='.Token::getToken();

	$data = '{
	  "openid_list" : [
	    "oJAi9wmc2kCqf8Y_MVpm5suEx2K8"
	  ],
	  "tagid" : 102
	}';

	$res = Curl::post($url, $data);

	echo $res;





 ?>