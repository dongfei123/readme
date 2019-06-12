<?php 
	

	include '../Libs/Curl.php';
	include '../Libs/Token.php';	

	$url = 'https://api.weixin.qq.com/customservice/kfaccount/add?access_token='.Token::getToken();

	$data = '{
	     "kf_account" : "111@111",
	     "nickname" : "111",
	     "password" : "111"
	}';

	$res = Curl::post($url, $data);

	var_dump($res);

 ?>