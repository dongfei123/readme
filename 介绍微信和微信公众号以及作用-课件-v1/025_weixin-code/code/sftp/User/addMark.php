<?php 	

	include '../Libs/Curl.php';
	include '../Libs/Token.php';

	$url = 'https://api.weixin.qq.com/cgi-bin/user/info/updateremark?access_token='.Token::getToken();

	$data = '{
		"openid":"oJAi9wtxmOSP2KUnrBE19td9j81Q",
		"remark":"小坤"
	}';

	$res = Curl::post($url, $data);

	echo $res;



 ?>