<?php 
	
	include './Libs/Curl.php';
	include './Libs/Token.php';

	//接口地址
	$url = 'https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token='.Token::getToken();

	$data = '{
	   "filter":{
	      "is_to_all":true
	   },
	   "text":{
	      "content":"哈喽  你们都在干什么呢!!!?"
	   },
	    "msgtype":"text"
	}';

	$res = Curl::post($url, $data);

	echo $res;

 ?>