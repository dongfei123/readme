<?php 
	
	include '../Libs/Curl.php';
	include '../Libs/Token.php';


	$url = 'https://api.weixin.qq.com/cgi-bin/tags/update?access_token='.Token::getToken();


	$data = '{
	  "tag" : {
	    "id" : 122,
	    "name" : "广州"
	  }
	}';

	$res = Curl::post($url, $data);

	echo $res;




 ?>