<?php 

	include '../Libs/Curl.php';
	include '../Libs/Token.php';

	$url = 'https://api.weixin.qq.com/cgi-bin/tags/delete?access_token='.Token::getToken();

	$data = '{
	  "tag":{
	       "id" : 124
	  }
	}';

	$res = Curl::post($url, $data);

	echo $res;

 ?>