<?php 

	include '../Libs/Curl.php';
	include '../Libs/Token.php';

	$url = 'https://api.weixin.qq.com/cgi-bin/user/tag/get?access_token='.Token::getToken();

	$data = '{
	  "tagid" : 102,
	}';

	$res = Curl::post($url, $data);

	echo $res;

 ?>