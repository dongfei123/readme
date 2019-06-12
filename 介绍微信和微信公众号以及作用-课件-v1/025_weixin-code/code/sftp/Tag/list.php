<?php 
	
	//标签的获取
	include '../Libs/Curl.php';
	include '../Libs/Token.php';

	$url = 'https://api.weixin.qq.com/cgi-bin/tags/get?access_token='.Token::getToken();

	$res = Curl::get($url);

	echo $res;

 ?>